<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Koordinator;
use Illuminate\Support\Facades\Auth;


class KoordinatorController extends Controller
{
    public function check(Request $request) 
    {
        $request->validate([
            'email' => 'required|email|exists:koordinators,email',
            'password' => 'required'
        ],[
            'email.required' => 'Email tidak boleh kosong.',
            'email.exists' => 'Email Anda tidak terdaftar.',
            'password.required' => 'Password tidak boleh kosong.'
        ]);

        $rememberMe = $request->remember ? true : false;
        $credentials = $request->only('email','password');
        
        if (Auth::guard('koordinator')->attempt($credentials, $rememberMe)) {
            return redirect()->route('koordinator.home');
        }else{
            return redirect()->route('koordinator.login')->with('fail', 'Incorrect email or password.');
        }
    }

    public function logout() 
    {
        Auth::guard('koordinator')->logout();
        return redirect('/');
    }
}
