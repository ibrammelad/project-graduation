<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{

    public function index()
    {
        User::all();
        $users = User::simplePaginate(15);
        return $this->showAll(collect($users));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->showOne($user);
    }

    public function update(Request $request)
    {
        try {
                $rules = [
                    'phone' => ['numeric'],
                    'email' => ['email'],
                    'name' =>['string'],
                ];
                $this ->validate($request , $rules);

            $user = auth()->user();

            if ($request->has('phone'))
            {
                if($request->name!= null)
                    $user->update([
                        'name' =>$request->name
                    ]);

                if($request->email!= null)
                    $user->update([
                        'email' =>$request->email
                    ]);
                $user->update([
                    'phone'=>$request->phone,
                    'status' => 0,
                ]);
                $this->sendSmsToMobile($user);
            }
            else {
                $user->fill($request->all());
                $user->update();
            }

            $auth = auth()->user();
            return $this->showOne($auth);

        }
        catch (\Exception $e)
        {
            return $this->errorResponse(["message"=>'some error occur' ,"status"=> 404], 404);
        }
    }

    public function upload(Request $request)
    {
        $rules = [
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ];
        $this->validate($request , $rules);
        $user = auth()->user();
        if ($user->image != null)
        {
            $image = $user->image;
            $image = public_path('images/'.$image);  // get the path of basic app
            unlink($image);              // delete photo from directory
        }
        $image = $request->file('image');
        $new_name = $image->getClientOriginalName();
        $input['image'] = $new_name;
         $user->update($input);
         $image->move(public_path("images"), $new_name);

         return response()->json(['message' => "update_message" ,'data' => $user->image, 'status' => 200] , 200);

    }

    public function sendSmsToMobile($user)
    {
        $code= rand('1000' , '9999');
        $user->update([
            'code' => $code]);
        $basic  = new \Vonage\Client\Credentials\Basic("abfc9078", "EqgqIwFt21UKweqm");
        $client = new \Vonage\Client($basic);
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("2".$user->phone, '7asb', 'Verification Code : '.$code)
        );

        return $code;

    }
}
