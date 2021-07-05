<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Validator;
class HosoitalController extends Controller
{
    public function index()
    {
        return view('admin/add-hospital');
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required' ,
            'lat' => 'required' ,
            'lang' => 'required' ,
        ];
        $data = $request->except('_token');

         Hospital::create($data);

         return back()->with(['success'=>'hospital is added ' ]);

    }
}
