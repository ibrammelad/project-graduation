<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{


    public function showAllComment($id)
    {

        $comments = DB::table('comments')
            ->where('post_id' , $id)
            ->leftJoin('users', 'users.id', '=', 'comments.user_id')
            ->selectRaw('comments.*,   users.image as userImage, users.name as userName ')
            ->groupBy( 'comments.id','comments.text' , 'comments.post_id'  ,'comments.user_id', 'comments.created_at' , 'comments.updated_at' , 'users.id', 'users.image' , 'users.name')

            ->orderBy('created_at' , 'ASC')
            ->simplePaginate(15);

        return $this->showAll(collect($comments));
    }


    public function store(Request $request)
    {
        $rules = [
            'text' =>'required|string',
            'post_id' => 'required|exists:posts,id'
        ];
        $vaild=$this->validate($request , $rules);
        $data = $request->all();
        $user_id = auth()->user()->id;
        $data['user_id'] =$user_id;
        $comment= Comment::create($data);
        return $this->showOne($comment, 202);
    }


    public function update(Request $request, $id)
    {
        $rules= [
        'text' =>'required|string',];
        $this->validate($request , $rules);
        $comment = Comment::find($id);

        $comment->update($request->all());
        return $this->showOne($comment , 202);

    }


    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return $this->errorResponse('comment deletes' , 200);
    }
}
