<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index(Post $post)
    {
        $posts = DB::table('posts')
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->selectRaw('posts.*, count(comments.post_id) as commentCount , users.image as userImage, users.name as userName ')

            ->groupBy('posts.id')
            ->simplePaginate(15);
        return $this->showAll(collect($posts));
    }

    public function store(Request $request)
    {
        $rules =[
            'text' => 'required|string',
            'user_id' => 'exists:users,id',
        ];
        $this->validate($request , $rules);
        $input = $request->all();
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $new_name = $image->getClientOriginalName();
            $input['image'] = $new_name;
            $image->move(public_path("images"), $new_name);
        }
        $input['user_id'] = auth()->user()->id;
        $post = Post::create($input);
        return $this->showOne($post);
    }

    public function show($id)
    {
        $post = DB::table('posts')
            ->where('post_id' , $id)
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->selectRaw('posts.*, count(comments.post_id) as commentCount')
            ->get();
        return response()->json(collect($post));
    }

    public function update(Request $request, $id)
    {

        $post = Post::findOrFail($id);
        if ($post->user_id != auth()->user()->id)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

        $rules =[
            'text' => 'string',
            'user_id' => 'exists:users,id',
        ];
        $this->validate($request,$rules);
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $post->update($input);

        return $this->showOne($post);

    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id != auth()->user()->id)
            return $this->errorResponse('unauthenticated you try to delete post of another user you do not have permission ', 404);
        $post->delete();
        return $this->successResponse("post is delete" , 200);

    }
}
