<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\apiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    use apiResponse;

    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->showOne($user);
    }

    public function update(Request $request, $id)
    {

        if ($this->assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ' , 404);
        $this->validate($request, $this->validUpdate($id));
        $user = User::findOrFail($id);
        $user->fill($request->all());
        $user->update();
        return $this->showOne($user);
    }

    public function validUpdate($id)
    {
        return  [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|'.Rule::unique('users', 'email')->ignore($id),
            'phone' => 'required|'.Rule::unique('users', 'phone')->ignore($id),
        ];
    }

    private function assurence($id)
    {
        return PersonalAccessToken::where( 'name' ,'LIKE', auth()->user()->name )->
        Where('tokenable_id','LIKE',$id)->
        where('tokenable_type' , 'App\Models\User')->
        get();
    }

}
