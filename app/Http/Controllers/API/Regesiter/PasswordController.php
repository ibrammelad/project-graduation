<?php

namespace App\Http\Controllers\API\Regesiter;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class PasswordController extends Controller
{
    public function forgot_password(Request $request)
    {
        $rules = [
            'phone' => "required"
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first() ,  400);
        }

        $user = User::where('phone' , $request->phone)->first();
<<<<<<< HEAD
        if (!$user)
=======
        if ($user->count() == 0)
>>>>>>> a1e024c81ec4842abde9f28a6ceed308c4d4f47c
        {
            return $this->errorResponse( "this phone do'nt have account",  404);
        }

<<<<<<< HEAD
        $this->sendSmsToMobile($user);
        $user['tokenKey'] = $user->createToken($user->name)->plainTextToken;

        return response()->json(["data" =>$user , "status"=> 200 ] , 200);
=======
//        $this->sendSmsToMobile($user);
        $user['tokenAPi'] = $user->createToken($user->name)->plainTextToken;

        return $this->successResponse([ $user , "message"=>'send message' ], 200);
>>>>>>> a1e024c81ec4842abde9f28a6ceed308c4d4f47c
    }
    public function verify_pass(Request $request)
    {
        try {
            $rules = [
                'code' => 'required|max:4|min:4'
            ];
            $this->validate($request, $rules);
            $code= auth()->user()->code;
            if ($code == $request->code) {
                auth()->user()->update(
                    [
                        'status' => '1',
                        'code' => null,
                        'email_verified_at' => Carbon::now(),
                    ]);
<<<<<<< HEAD
                return response()->json(['message' => 'successfully' , 'status' => 200]);
            }
            else
                return response()->json(['message' => 'some error occur' , 'status' => 404]);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage() ,'status' => 404] );
=======
                return $this->successResponse('successfully', 200);
            }
            else
                return $this->errorResponse('some error occur', 400);

        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 400);
>>>>>>> a1e024c81ec4842abde9f28a6ceed308c4d4f47c
        }
    }
    public function changePass(Request $request)
    {
<<<<<<< HEAD
        try {
            $rules = [
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|same:new_password',
            ];
            $this->validate($request, $rules);
            $user = auth()->user();
            $data['password'] = bcrypt($request->new_password);
            if ($user->code == null && $user->status == 1) {
                $user->update($data);
                return response()->json(['message' => 'successfully password is updated', 'status' => 200]);
            }
            else
                return response()->json(['message' => 'account not Verify ' , 'status' => 404]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage(), 'status' => 404]);
        }
=======
        $rules =[
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ];
        $this->validate($request,$rules);
        $user = auth()->user();
        $data['password'] = bcrypt($request->new_password);
        if ($user->code == null && $user->status == 1) {
            $user->update($data);
        }
        return $this->successResponse('update password' , 200);

>>>>>>> a1e024c81ec4842abde9f28a6ceed308c4d4f47c
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
