<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LocationPersonInteract;
use App\Models\Notification;
use App\Models\OrderCorona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HaveCovid extends Controller
{

    public function index()
    {
        $users = OrderCorona::where('image_cro' , '!=' , null)->get();
        return view('admin/i-have-covid-review' , compact('users'));
    }

    public function accept($id)
    {
        $order = OrderCorona::findOrFail($id);
        $user =  $order->user ;
        $user->update([
            'HaveCovid19' => 1 ,
        ]);
        if($order->image_cro != null)
        {
            $image = $order->image_cro;
            $image = public_path('images/'.$image);  // get the path of basic app
            unlink($image);              // delete photo from directory
        }
        $order->delete();
        return back()->with(['success' => "notification has been pushed"]);
    }

    public function refuse($id)
    {
        $order = OrderCorona::findOrFail($id);
        if ($order->image_cro != null)
        {
            $image = $order->image_cro;
            $image = public_path('images/'.$image);  // get the path of basic app
            unlink($image);              // delete photo from directory
        }
        $order->delete() ;
        return back()->with(['success' => "order is refused"]);
    }

    public function indexSusb()
    {
        $users = OrderCorona::where('image_susb' , '!=' , null)->get();
        return view('admin/iam-susbected-review' , compact('users'));
    }

    public function acceptSusb($id)
    {
        try {
        DB::beginTransaction();
        $order = OrderCorona::findOrFail($id);
        $user = $order->user;
        $allInteract = LocationPersonInteract::where('user_1', $user->id)->orWhere('user_2', $user->id)->get();
        $persons = [];
        foreach($allInteract as $index => $interactor) {
            $persons[$index] = User::where('id', $interactor->user_1)->orWhere('id', $interactor->user_2)->get();
        }
        $persons= collect($persons);
        $persons = $persons->collapse()->unique('id')->values();
        $i = 0;
        foreach($persons as $person)
         {
             if ($person->showName == 1)
             {
                 $name = $person->name;
             }else
                 $name = "x";
             $message = "soory to tell you have interact with". $name."he has a susbected of covid19 now ";
             $this->push_notification_android($person->FCMToken, $message);

             Notification::create([
                 'lang'=>  $allInteract[$i]->lang,
                 'lat'=>  $allInteract[$i]->lat,
                 'time_interaction' => $allInteract[$i]->created_at,
                 'user_id' => $user->id,
             ]);
         }

        $user->update([
            'susbected19' => 1 ,
        ]);
        if ($order->image_susb != null)
        {
            $image = $order->image_susb;
            $image = public_path('images/'.$image);  // get the path of basic app
            unlink($image);              // delete photo from directory
        }
        $order->delete();
        DB::commit();
        return back()->with(['success' => "notification has been pushed"]);
    }catch (\Exception $exception)
        {
            return $exception->getMessage();
            return back()->with(['success' => "notification has been pushed"]);

        }

    }

    public function refuseSusb($id)
    {
        $order = OrderCorona::findOrFail($id);
        if ($order->image_susb != null)
        {
            $image = $order->image_susb;
            $image = public_path('images/'.$image);  // get the path of basic app
            unlink($image);              // delete photo from directory
        }
        $order->delete() ;
        return back()->with(['success' => "order is refused"]);
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
            'data' => array (
                "message" => $message
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
