<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function showEmail(Request $request ,$id)
    {
        $rules = [
            'showMail' => 'required|in:0,1'
        ];
        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);
        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->update(['showMail' => $request->showMail]);
        return $this->showOne($user);
    }
    public function showName(Request $request ,$id)
    {
        $rules = [
            'showName' => 'required|in:0,1'
        ];
        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->update(['showName' => $request->showName]);
        return $this->showOne($user);
    }
    public function showNearly(Request $request ,$id)
    {
        $rules = [
            'showNearly' => 'required|in:0,1'
        ];
        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->update(['showNearly' => $request->showNearly]);
        return $this->showOne($user);
    }
    public function HaveCovid19(Request $request ,$id)
    {
        $rules = [
            'HaveCovid19' => 'required|in:0,1'
        ];
        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->update(['HaveCovid19' => $request->HaveCovid19]);
        return $this->showOne($user);
    }
    public function HelpUsers(Request $request ,$id)
    {
        $rules = [
            'HelpUsers' => 'required|in:0,1'
        ];
        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->update(['HelpUsers' => $request->HelpUsers]);
        return $this->showOne($user);
    }
}
