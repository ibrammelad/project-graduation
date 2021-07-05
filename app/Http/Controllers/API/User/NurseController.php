<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class NurseController extends Controller
{
    public function allNurses()
    {
        $nurses = Nurse::active()->with('user')->simplePaginate(15);

        return response()->json($nurses , 200);
    }

    public function makeMeNurse(Request $request)
    {
        try {
            $id = auth()->user()->id;
            if (User::assurence($id)->first() == null)
                return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

            if (Doctor::where('user_id', $id)->exists())
                return $this->errorResponse('you are doctor  ', 400);
            if (Nurse::where('user_id', $id)->exists())
                return $this->errorResponse('you are nurse  ', 400);

            $this->validate($request, Nurse::validNurse());
            $input = $request->all();
            $input['user_id']= $id;
            $input['review'] = 1;
            $nurse = Nurse::create($input);
            $data= $nurse->with('user')->where('id' , $nurse->id)->first();
            return response()->json(['data' =>$data , 'status' => 202], 202);
        }
        catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
