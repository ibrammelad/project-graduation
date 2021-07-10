<?php

namespace App\Http\Controllers\API\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function allNotification()
    {
        $not = Notification::where('user_id', auth()->user()->id)->with('user')->simplePaginate(15);

        return response()->json([$not] , 200 );

    }
}
