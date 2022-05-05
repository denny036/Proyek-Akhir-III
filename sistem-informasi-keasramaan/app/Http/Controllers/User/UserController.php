<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request)
    {
        //validate input
        $request->validate(
            [
                'nama' => 'required|min:3|max:23',
                'nim' => 'required|unique:users,nim|min:8|max:8',
                'password' => 'required|string|min:6|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'confirm_password' => 'required|string|min:6|max:16|same:password|',
                'angkatan' => 'required',
                'prodi' => 'required'
            ],
            [
                'nama.required' => 'Kolom nama tidak boleh kosong.',
                'nama.min' => 'Kolom nama minimal 3 karakter.',
                'nama.max' =>  'Kolom nama maksimal 23 karakter.',
                'nim.required' =>  'Kolom NIM tidak boleh kosong.',
                'nim.unique' => 'Kolom NIM sudah terdaftar.',
                'nim.min' => 'Kolom NIM sesuai dengan format akademik.',
                'nim.max' => 'Kolom NIM sesuai dengan format akademik.',
                'password.required' => 'Kolom password tidak boleh kosong.',
                'password.min' => 'Kolom password minimal 6 karakter.',
                'password.max' => 'Kolom password maksimal 16 karakter.',
                'password.regex' => 'Password harus mengandung huruf besar, kecil, angka, dan karakter khusus.',
                'confirm_password.required' => 'Kolom konfirmasi sandi tidak boleh kosong.',
                'confirm_password.same' => 'Konfirmasi sandi Anda harus sama dengan kolom Password',
                'angkatan.required' => 'Kolom angkatan tidak boleh kosong.',
                'prodi.required' =>  'Kolom program studi tidak boleh kosong.',
            ]);

        $user = new User();
        $user->nama = $request->nama;
        $user->nim = $request->nim;
        $user->password = Hash::make($request->password);
        $user->angkatan = $request->angkatan;
        $user->prodi = $request->prodi;
        $save = $user->save();

        if($save) {
            return redirect()->back()->with('success','Anda berhasil melakukan registrasi.');
        }else{
            return redirect()->back()->with('fail', 'Registrasi gagal, silakan periksa format yang diminta.');
        }
    }

    public function check(Request $request) 
    {
      $request->validate([
          'nim' => 'required|exists:users,nim',
          'password' => 'required'
      ],[
          'nim.required' => 'NIM tidak boleh kosong.',
          'nim.exists' => 'NIM Anda tidak ditemukan.',
          'password.required' => 'Password tidak boleh kosong.'
      ]);

      $credentials = $request->only('nim','password');
      if (Auth::attempt($credentials)) {
          return redirect()->route('mahasiswa.home');
      }else{
          return redirect()->route('mahasiswa.login')->with('fail', 'Incorrect username or password.');
      }
    }
}
