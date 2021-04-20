<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

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
        try {
            if (User::assurence($id)->first() == null)
                return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

            $this->validate($request, User::validUpdate($id));
            $user = User::findOrFail($id);
            $user->fill($request->all());

            DB::beginTransaction();
            $user->update();
            User::assurence($id)->first()->update(['name' => $request->name]);
            DB::commit();
            return $this->showOne($user);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return $this->errorResponse('some error occur' , 404);
        }
    }



}
