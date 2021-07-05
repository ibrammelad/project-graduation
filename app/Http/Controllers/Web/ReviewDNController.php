<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Nurse;
use Illuminate\Http\Request;

class ReviewDNController extends Controller
{

    public function indexDoctor()
    {
        $doctors = Doctor::where('review' , 1) ->get();
        return view('admin/review-doctors', compact('doctors'));
    }

    public function acceptDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update([
            'status' => 1 ,
            'review' => 0 ,]) ;
        return back()->with(['success' => "doctor is accepted"]);
    }

    public function refuseDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        if ($doctor->image != null)
        {
            $image = $doctor->image;
            $image = public_path('images/'.$image);  // get the path of basic app
            unlink($image);              // delete photo from directory
        }
        $doctor->delete();
        return back()->with(['success' => "doctor is refused"]);
    }

    public function indexNurse()
    {
        $nurses = Nurse::where('review' , 1) ->get();
        return view('admin/review-nurse' , compact('nurses'));
    }
    public function acceptNurse($id)
    {
        $nurse = Nurse::findOrFail($id);
        $nurse->update([
            'status' => 1 ,
            'review' => 0 ,]) ;
        return back()->with(['success' => "nurse is accepted"]);
    }

    public function refuseNurse($id)
    {
        $nurse = Nurse::findOrFail($id);

        $nurse->delete();
        return back()->with(['success' => "nurse is refused"]);
    }

}
