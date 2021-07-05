<?php

namespace App\Http\Controllers\API\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationPerson;
use App\Models\LocationPersonInteract;
use Illuminate\Http\Request;

class PeopleLocationController extends Controller
{


    public function updateLocation(Request $request)
    {
        $rules= [
            'lang' => 'required|numeric',
            'lat' => 'required|numeric',
            'address' => 'required',
        ];
        $this->validate($request, $rules);
        $data = $request->all();
         $id = auth()->user()->id;
        $locationPerson = LocationPerson::where('user_id' , $id)->first();
        if ($locationPerson!= null)
        {
            $locationPerson->update($data);
        }
        else{
            $data['user_id'] = auth()->user()->id;
            $locationPerson = LocationPerson::create($data);
        }
        $people = LocationPerson::all();

        $people = $people->except($locationPerson->id);
        $ss = [];
        foreach ($people as  $index=>$person)
        {
            $person['distance'] = $this->distance($locationPerson->lat , $locationPerson->lang, $person->lat , $person->lang);
            $ss[$index] = $person;
            if ($person['distance'] <= 2)
            {
                LocationPersonInteract::updateOrCreate([
                    'lang' =>$locationPerson->lang ,
                    'lat' => $locationPerson->lat ,
                    'address' => $locationPerson->address ,
                    'user_1' => $id ,
                    'user_2' =>$person['user_id'],
                ]);
            }
        }

        return response()->json(['status' => 200] , 200 );


    }
}
