<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\apiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $rules = [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|'.Rule::unique('users', 'email')->ignore($id),
            'phone' => 'required|'.Rule::unique('users', 'phone')->ignore($id),
        ];
        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->fill($request->all());
        $user->update();
        return $this->showOne($user);
    }


}
