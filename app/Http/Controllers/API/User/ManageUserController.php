<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\LocationPersonInteract;
use App\Models\Notification;
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

        $id = auth()->user()->id;

        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);



        if ($request->file('image_cro')) {
            $image = $request->file('image_cro');
            $new_name = rand().$image->getClientOriginalName();
            $input['image_cro'] = $new_name;
            $image->move(public_path("images"), $new_name);

        }
        $input['user_id'] = $id;
        if($request->image_cro != null) {
            $data = OrderCorona::create($input);
            return response()->json(["data"=>$data , "status" => 200 , "message" => "your request send to admins"] , 200);

        }
        else
        {
             auth()->user()->update([
                'HaveCovid19' => 0 ,
            ]);
        }

        $data = auth()->user();
        return response()->json(["data"=>$data , "status" => 200 , "message" => "your request send to admins"] , 200);
    }
    public function susbected19(Request $request)
    {

        $id = auth()->user()->id;

        if (User::assurence($id)->first() == null)
            return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);


            if ($request->file('image_susb')) {
                $image = $request->file('image_susb');
                $new_name = rand().$image->getClientOriginalName();
                $input['image_susb'] = $new_name;
                $image->move(public_path("images"), $new_name);

            }
        $input['user_id'] = $id;
        if($request->image_susb != null) {
            $data = OrderCorona::create($input);
            return response()->json(["data"=>$data , "status" => 200 , "message" => "your request send to admins"] , 200);

        }
        else
        {
             auth()->user()->update([
                'susbected19' => 0 ,
            ]);
        }

        $data = auth()->user();
        return response()->json(["data"=>$data , "status" => 200 , "message" => "your request send to admins"] , 200);

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
        $allInteract = LocationPersonInteract::where('user_1', $user->id)->orWhere('user_2', $user->id)->get();
        $persons = [];
        foreach($allInteract as $index => $interactor) {
            $persons[$index] = User::where('id', $interactor->user_1)->orWhere('id', $interactor->user_2)->get();
        }
        $persons= collect($persons);
        $persons = $persons->collapse()->unique('id')->values();
        $i = 0;
        $persons = $persons->reject($user);
        foreach($persons as $person)
        {
            if ($user->showName == 1)
            {
                $name = $user->name;
            }else
                $name = "x";
            $message = "Sorry to tell you have interact with". $name."he has a symptoms of covid19 now ";
            $this->push_notification_android($person->FCMToken, $message);

            Notification::create([
                'lang'=>  $allInteract[$i]->lang,
                'lat'=>  $allInteract[$i]->lat,
                'time_interaction' => $allInteract[$i]->created_at,
                'user_id' => $person->id,
            ]);
        }
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
    public function nearlyPeoples()
    {
        $users = User::where('HaveCovid19' , 1)
            ->orWhere('susbected19' , 1)
            -> orWhere('symptoms19' , 1)
            ->with('location')->get();
        return response()->json(['data' =>$users , "status" =>200] , 200);
    }

    public function push_notification_android($device_id,$message){

        //API URL of FCM
        $url = 'https://fcm.googleapis.com/fcm/send';

        /*api_key available in:
        Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/
        $api_key = 'AAAAbGUTi2E:APA91bGcQ6Ikeni02tRP9--VW9O2B3iNowiAfe0TK9bGgXNkubj9MLztBzVbMxGvgo8F4kAN9MtZ_J6rPCpg_YoaGSnOEEBGIDubtNQEM3bh9im3bOQ3_4nHNbkgN-nxXEKrNiAGsW__';

        $fields = array (
            'registration_ids' => array (
                $device_id
            ),
            'notification' => array (
                "title"=> "hasb",
                "body" => $message
            ),
            'data' => array (
                "type"=> "notification",
            )
        );

        //header includes Content type and api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$api_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

}
