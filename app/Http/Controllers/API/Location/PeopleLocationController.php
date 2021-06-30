<?php

namespace App\Http\Controllers\API\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationPerson;
use Illuminate\Http\Request;

class PeopleLocationController extends Controller
{
    public function storeLocation(Request $request)
    {
        $rules= [
            'lang' => 'required|numeric',
            'lat' => 'required|numeric',
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $user_id = auth()->user()->id;
        $data['user_id'] = $user_id;
        $locationPerson = LocationPerson::create($data);
        return $this->showOne($locationPerson , 202);

    }

    public function updateLocation(Request $request , $id)
    {
        $rules= [
            'lang' => 'required|numeric',
            'lat' => 'required|numeric',
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $locationPerson = LocationPerson::find($id);
        $locationPerson->update($data);
        return $this->showOne($locationPerson , 202);

    }
}
