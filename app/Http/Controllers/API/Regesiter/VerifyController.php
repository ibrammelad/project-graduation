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
<<<<<<< HEAD
                return response()->json(['message' => 'successfully' , 'status' => 200]);
            }
            else
                return response()->json(['message' => 'some error occur' , 'status' => 404]);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage() ,'status' => 404] );
=======
                return $this->successResponse('email verify successfully', 200);
            }
            else
                return $this->errorResponse('some error occur', 400);

        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 400);
>>>>>>> a1e024c81ec4842abde9f28a6ceed308c4d4f47c
        }
    }

}
