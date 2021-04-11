<?php

namespace App\Http\Controllers\API\Regesiter;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\apiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    use apiResponse;
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
            $input['showMail'] = User::showMAIL;
            $input['showName'] = User::showName;
            $input['showNearly'] = User::showNearly;
            $input['HaveCovid19'] = User::HaveCovid19;
            $user = User::create($input);
            $success['token'] = $user->createToken($user->name)->plainTextToken;
            $success['name'] = $user->name;
            DB::commit();
            return response()->json($success, 202);
        }
        catch(\Exception $exception)
        {
            return $this->errorResponse('some error occur', 404);

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
        $success['token'] =  $user->createToken($user->name)->plainTextToken;
        $success['name'] =  $user->name;
        return $this->successResponse($success , 202);
    }

    public function registerWith(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'phone' => 'Digits:11|unique:users',
                'token' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 404);
            }

            DB::beginTransaction();
            $input = $request->all();
            $input['showMail'] = User::showMAIL;
            $input['showName'] = User::showName;
            $input['showNearly'] = User::showNearly;
            $input['HaveCovid19'] = User::HaveCovid19;
            $user = User::create($input);
            $success['token'] = $user->createToken($user->name)->plainTextToken;
            $success['name'] = $user->name;
            DB::commit();
            return $this->successResponse($success, 202);
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



}
