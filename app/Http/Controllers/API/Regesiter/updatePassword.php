<?php

namespace App\Http\Controllers\API\Regesiter;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class updatePassword extends Controller
{
    public function updatePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [

                'current_password' => ['required', new MatchOldPassword],

                'new_password' => ['required'],

                'new_confirm_password' => ['same:new_password'],

            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors(), 'status'=>404] , 404);
            }


            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            return response()->json(['message' => "successfully " , 'status' => 200] , 200);
        }
        catch (\Exception $exception)
        {
            return response()->json(['error' => "some error occur" , 'status' => 404] , 404);

        }

    }
}
