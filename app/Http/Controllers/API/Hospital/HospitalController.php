<?php

namespace App\Http\Controllers\API\Hospital;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function allHospitals()
    {
        $hospitals = Hospital::all();
        return response()->json(['data' => $hospitals , 'status' =>200] , 200);
    }
}
