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
        $nurses = Nurse::active()->get();
        return $this->showAll($nurses);
    }

    public function makeMeNurse(Request $request , $id)
    {
        try {

            if (User::assurence($id)->first() == null)
                return $this->errorResponse('unauthenticated you try to modify another user you do not have permission ', 404);

            if (Doctor::where('user_id', $id)->exists())
                return $this->errorResponse('you are doctor  ', 400);

            $this->validate($request, Nurse::validNurse());
            $input = $request->all();
            $input['user_id']= auth()->user()->id;
            $nurse = Nurse::create($input);
            return $this->showOne($nurse);
        }
        catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
