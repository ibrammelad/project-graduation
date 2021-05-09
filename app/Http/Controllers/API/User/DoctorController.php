<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\User;
use Illuminate\Http\Request;



class DoctorController extends Controller
{

    public function allDoctors()
    {
        $doctors = Doctor::active()->get();
        return $this->showAll($doctors);
    }

    public function makeMeDoctor(Request $request)
    {
        try {


            $id = auth()->user()->id;
            if (User::assurence($id)->first() == null)
                return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);


            if (Nurse::where('user_id' , $id)->exists())
                return $this->errorResponse('you are nurse ', 400);


            $this->validate($request, Doctor::validDoc());
            $input = $request->all();
            $input['user_id']= $id;
            $doctor = Doctor::create($input);
            return $this->showOne($doctor);
        }
        catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
