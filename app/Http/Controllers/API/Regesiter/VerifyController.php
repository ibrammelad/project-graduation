<?php

namespace App\Http\Controllers\API\Regesiter;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify(Request $request)
    {
        try {
            $rules = [
                'code' => 'required|max:4|min:4'
            ];
            $this->validate($request, $rules);
            $code= auth()->user()->code;
            if ($code == $request->code) {
                auth()->user()->update(
                    [
                        'status' => '1',
                        'code' => null,
                        'email_verified_at' => Carbon::now(),
                    ]);
                return response()->json(['message' => 'successfully' , 'status' => 200]);
            }
            else
                return response()->json(['message' => 'some error occur' , 'status' => 404]);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage() ,'status' => 404] );
        }
    }

}
