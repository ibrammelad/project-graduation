<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginPage()
    {
        if (!Auth::check()) {
            return view('admin/login-admin');
        }
        else return redirect()->route('FirstPage');
    }

    public function login(Request $request)
    {
        try {
            request()->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->route('FirstPage');
            }else
                return redirect()->route('loginPage');
        }catch (\Exception $exception)
        {
            return redirect()->route('loginPage')->with(['error' => 'oops .... try again later.. !!!']);

        }
    }
}
