<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Petugas;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function check(Request $request) 
    {
        $request->validate([
            'email' => 'required|email|exists:petugas,email',
            'password' => 'required'
        ],[
            'email.required' => 'Email tidak boleh kosong.',
            'email.exists' => 'Email Anda tidak terdaftar.',
            'password.required' => 'Password tidak boleh kosong.'
        ]);

        $rememberMe = $request->remember ? true : false;
        $credentials = $request->only('email','password');
        
        if (Auth::guard('petugas')->attempt($credentials, $rememberMe)) {
            return redirect()->route('petugas.home');
        }else{
            return redirect()->route('petugas.login')->with('fail', 'Incorrect email or password.');
        }
    }

    public function logout() 
    {
        Auth::guard('petugas')->logout();
        return redirect()->route('welcome');
    }
}
