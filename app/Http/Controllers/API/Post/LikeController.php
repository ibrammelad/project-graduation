<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $rules = [
            'post_id' => 'required',
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $user = auth()->user()->id;
        $data['user_id'] = $user;
        $data['liked'] = 1;
        $exist_like = Like::where('user_id', $user)
            ->where('post_id', $request->post_id)
            ->get();
        if ($exist_like->isEmpty()) {
            Like::create($data);
        }
        return response()->json(['status' => 200], 200);

    }

    public function dislike(Request $request)
    {
        $rules = [
            'post_id' => 'required',
        ];
        $this->validate($request, $rules);
        $user = auth()->user()->id;
        $exist_like = Like::where('user_id', $user)
            ->where('post_id', $request->post_id)
            ->get();
        if (!$exist_like->isEmpty())
            $exist_like->first()->delete();
        return response()->json(['status' => 200], 200);

    }
    public function isLikedByMe($id)
    {
        $post = Post::findOrFail($id)->first();
        if (Like::whereUserId(Auth::id())->wherePostId($post->id)->exists()){
            return response()->json(['status' => 200] , 200);
        }
        else
           return response()->json(['status' => 404] , 404);

    }


}
