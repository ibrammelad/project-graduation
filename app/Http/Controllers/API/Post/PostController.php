<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::orderByDesc('created_at')->get();
        return $this->showAll($posts);
    }

    public function store(Request $request)
    {
        $rules =[
            'text' => 'required|string',
            'user_id' => 'exists:users,id',
        ];
        $this->validate($request , $rules);
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $post = Post::create($input);
        return $this->showOne($post);
    }

    public function show($id)
    {
        return $this->showOne(Post::find($id));

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
