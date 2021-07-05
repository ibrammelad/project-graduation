<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Saved;
use App\Models\User;
use Illuminate\Http\Request;

class SavedController extends Controller
{
    public function mySaved()
    {
        $user = auth() ->user()->id;
        /////////// return  saved id
        $numbers = Saved::Active()->where('user_id' , $user)->pluck('post_id');
        $arr = [];
        $res = [];
        foreach ($numbers as $index =>$item)
        {
            $arr[$index] = Post::findOrFail($item);
            $res[$index] =  $arr[$index]->with('user')->where('id' , $item)->first();

        }


        $res = $this->paginate(collect($res) , 15);
        return response()->json(['data' => $res ]  ,200);
    }

    public function savePost(Request $request , $id)
    {

        $user = auth() ->user();
        $postSave = Saved::where('post_id' , $id) ->get();
        if(!$postSave->isEmpty())
        {
            return response()->json(["message" => "post is already saved" , 'status' => 400], 400);
        }
        $save = Saved::create(
            [
                'user_id' => $user->id ,
                'post_id' => $id ,
                'saved' => 1
            ]
        );

        return  response()->json(['message' =>'saved' , 'status' => 200] , 200);

    }

    public function destroy($id)
    {
        $post = Saved::where('post_id' ,$id ) ->get();
        if($post->isEmpty())
        {
            return response()->json(["message" => "post is already not found" , 'status' => 400], 400);
        }
        $post->first()->delete();
        return response()->json(['message' =>'unsaved' , 'status' => 200], 200);
    }
}
