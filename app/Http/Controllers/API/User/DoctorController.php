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
        $doctors = Doctor::active()->with('user')->simplePaginate(15);
        return response()->json($doctors , 200);
    }

    public function makeMeDoctor(Request $request)
    {
        try {

            $id = auth()->user()->id;
            if (User::assurence($id)->first() == null)
                return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

            if (Nurse::where('user_id' , $id)->exists())
                return $this->errorResponse('you are nurse ', 400);
            if (Doctor::where('user_id' , $id)->exists())
                return $this->errorResponse('you are doctor ', 400);


            $this->validate($request, Doctor::validDoc());
            $input = $request->all();

            $image = $request->file('image');
            $new_name = rand().$image->getClientOriginalName();
            $image->move(public_path("images"), $new_name);
            $input['image'] = $new_name;
            $input['user_id']= $id;
            $input['review'] = 1;
            $doctor = Doctor::create($input);
            $data= $doctor->with('user')->where('id' , $doctor->id)->first();
            return response()->json(['data' =>$data , 'status' => 202], 202);
        }
        catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
