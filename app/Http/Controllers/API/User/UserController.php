<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            $ids= auth()->user()->id;
            $token=PersonalAccessToken::where('tokenable_id', $ids)->get();
            $r = ! Hash::check($token->first()->token);
            return response()->json($r->get());

        }
        catch (\Exception $e)
        {
            return $e->getMessage();
            return $this->errorResponse(["message"=>'some error occur' ,"status"=> 404], 404);
        }
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
