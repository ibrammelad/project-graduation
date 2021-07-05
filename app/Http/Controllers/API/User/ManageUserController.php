<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\OrderCorona;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function showEmail(Request $request )
    {
        $rules = [
            'showMail' => 'required|in:0,1'
        ];
        $id = auth()->user()->id;
        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);
        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->update(['showMail' => $request->showMail]);
        return $this->showOne($user,200);
    }
    public function showName(Request $request)
    {
        $rules = [
            'showName' => 'required|in:0,1'
        ];
        $id = auth()->user()->id;
        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->update(['showName' => $request->showName]);
        return $this->showOne($user,200);
    }
    public function showNearly(Request $request )
    {
        $rules = [
            'showNearly' => 'required|in:0,1'
        ];
        $id = auth()->user()->id;
        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->update(['showNearly' => $request->showNearly]);
        return $this->showOne($user,200);
    }
    public function HaveCovid19(Request $request)
    {
        $rules = [
            'image_cro' => 'required|image|mimes:jpeg,png,jpg',

        ];
        $id = auth()->user()->id;

        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

        $this->validate($request, $rules);
        $this->validate($request, $rules);

        if ($request->file('image_cro')) {
            $image = $request->file('image_cro');
            $new_name = rand().$image->getClientOriginalName();
            $input['image_cro'] = $new_name;
            $image->move(public_path("images"), $new_name);

        }
        $input['user_id'] = $id;
        if($request->image_cro != null) {
            $data = OrderCorona::create($input);
            return $this->showOne($data,200);

        }
        else
        {
            auth()->user()->update([
                'HaveCovid19' => 0 ,
            ]);
        }

        $data = auth()->user();
        return $this->showOne($data,200);
    }
    public function susbected19(Request $request)
    {
        $rules = [
            'image_susb' => 'image|mimes:jpeg,png,jpg',
        ];
        $id = auth()->user()->id;

        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

        $this->validate($request, $rules);

            if ($request->file('image_susb')) {
                $image = $request->file('image_susb');
                $new_name = rand().$image->getClientOriginalName();
                $input['image_susb'] = $new_name;
                $image->move(public_path("images"), $new_name);

            }
        $input['user_id'] = $id;
        if($request->image_susb != null) {
            $data = OrderCorona::create($input);
            return $this->showOne($data,200);

        }
        else
        {
             auth()->user()->update([
                'susbected19' => 0 ,
            ]);
        }

        $data = auth()->user();
        return $this->showOne($data,200);

    }
    public function symptoms19(Request $request)
    {
        $rules = [
            'symptoms19' => 'required|in:1,0',

        ];
        $id = auth()->user()->id;

        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->update(['symptoms19' => $request->symptoms19]);
        return $this->showOne($user ,200);
    }
    public function HelpUsers(Request $request)
    {
        $rules = [
            'HelpUsers' => 'required|in:0,1'
        ];

        $id = auth()->user()->id;

        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->update(['HelpUsers' => $request->HelpUsers]);
        return $this->showOne($user);
    }
    public function allHelper()
    {
        $users = User::ActiveHelp()->simplePaginate(15);
        $users = $users->except(auth()->user()->id);
        return response()->json($this->paginate($users , 200 ),200) ;
    }
    public function postToken(Request $request)
    {
        $rules = [
            'FCMToken' => 'required' ,
        ];
        $this->validate($request, $rules);

        $user = auth()->user() ;
        $user->update([
            'FCMToken' => $request->FCMToken
        ]);

        return response()->json(['status' => 200] , 200);
    }

    public function settings()
    {
        $user = auth()->user();

        $data['showMail']= $user->showMail;
        $data['showName']= $user->showName;
        $data['showNearly']= $user->showNearly;
        $data['HaveCovid19']= $user->HaveCovid19;
        $data['susbected19']= $user->susbected19;
        $data['symptoms19']= $user->symptoms19;
        $data['HelpUsers']= $user->HelpUsers;

        $doctor =$user->doctor;
        if ($doctor == null) {
            $data['isDoctor'] = 0;
            $data['review_doctor'] = 0;
        } else {
            if ($doctor->status == 1)
                $data['isDoctor'] = 1;
            else{
                $data['isDoctor'] = 0;

            }
            if ($doctor->review == 1)
                $data['review_doctor'] = 1;
            else
            {
                $data['review_doctor'] = 1;
            }
        }



        $nurse =$user->nurse;
        if ($nurse==null)
        {
             $data['isNurse']= 0;
             $data['review_nurse']= 0;

        }else {
            if ($nurse->status == 1)
                $data['isNurse'] = 1;
            else{
                $data['isNurse'] = 0;

            }
            if ($nurse->review == 1)
                $data['review_nurse'] = 1;
            else
            {
                $data['review_nurse'] = 1;
            }
        }

        return response()->json(['data' => $data , 'status' => 200],200);
    }
}
