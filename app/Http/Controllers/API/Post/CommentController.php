<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{


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

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
         return $this->showOne($comment , 200);
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
