<?php

namespace App\Http\Controllers\API\Regesiter;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|Digits:11|unique:users',
                'password' => 'required|confirmed',
                'image' => 'mimes:jpg,jpeg,png'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 404);
            }

            DB::beginTransaction();
            $input = $request->all();
            $input['password_confirmation'] = bcrypt($request->password_confirmation);
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $user['token'] = $user->createToken($user->name)->plainTextToken;
            DB::commit();
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $this->sendSmsToMobile($user);
            }
            return response()->json($user, 202);


        }
        catch(\Exception $exception)
        {
            return $this->errorResponse($exception->getMessage(), 404);

        }
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $user['token'] =  $user->createToken($user->name)->plainTextToken;
        return $this->successResponse($user , 202);
    }

    public function registerWith(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'Digits:11|unique:users',
                'token' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 404);
            }
            $user = User::where('email', $request->email)->first();


            DB::beginTransaction();
            if ($user === null) {

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'token' => $request->id,
                    'status' => 1
                ]);
                $user['token'] = $user->createToken($user->name)->plainTextToken;
            }
            DB::commit();
            return $this->successResponse($user, 202);
        }
        catch(\Exception $exception)
        {
            return $this->errorResponse('some error occur', 404);

        }
    }
    public function loginWith(Request $request)
    {
        $user = User::where('email',$request->email)->where('token',$request->token)->first();
        if (! $user || $request->token != $user->token) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $success['token'] =  $user->createToken($user->name)->plainTextToken;
        $success['name'] =  $user->name;
        return $this->successResponse($success , 202);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return $this->showMessage("you are logout",200);
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
