<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppetaleController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, ['email' => 'required', 'password' => 'required']);
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['credetial' => trans('auth.failed')]);
    }

    public function dashboard(){
        return view('dashboard');
    }
}
