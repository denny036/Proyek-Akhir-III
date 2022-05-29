<?php

namespace App\Http\Controllers\Koordinator;

use App\Models\Asrama;
use App\Models\Petugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DataPetugasController extends Controller
{
    public function showDataPetugas() 
    {
        $dataPetugas = Petugas::all();
        return view('koordinator.petugas.index', compact('dataPetugas'));
    }

    public function showFormTambahPetugas() 
    {
        $dataAsrama = Asrama::all();
        return view('koordinator.petugas.create', compact('dataAsrama'));
    }

    public function storeDataPetugas(Request $request) 
    {
        $request->validate(
            [
                'nama' => 'required|min:3|max:25',
                'email' => 'required|email|unique:petugas,email',
                'password' => 'required|string|min:6|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'confirm_password' => 'required|string|min:6|max:16|same:password|',
                'jabatan' => 'required',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong.',
                'nama.min' => 'Nama minimal 3 karakter.',
                'nama.max' =>  'Nama maksimal 25 karakter.',
                'email.required' =>  'Email tidak boleh kosong.',
                'email.unique' => 'Email sudah terdaftar.',
                'password.required' => 'Password tidak boleh kosong.',
                'password.min' => 'Password minimal 6 karakter.',
                'password.max' => 'Password maksimal 16 karakter.',
                'password.regex' => 'Password harus mengandung huruf besar, kecil, angka, dan karakter khusus.',
                'confirm_password.required' => 'Kolom konfirmasi sandi tidak boleh kosong.',
                'confirm_password.same' => 'Konfirmasi kata sandi Anda harus sama dengan kolom Password',
                'jabatan.required' => 'Jabatan tidak boleh kosong.',
                'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong.'
            ]
        );

        $petugas = new Petugas();
        $petugas->nama = $request->nama;
        $petugas->email = $request->email;
        $petugas->password = Hash::make($request->password);
        $petugas->jabatan = $request->jabatan;
        $petugas->asrama_id = $request->lokasi_bertugas;
        $petugas->jenis_kelamin = $request->jenis_kelamin;
        $save = $petugas->save();

        if ($save) {
            return redirect()->back()->with('success', 'Anda berhasil menambah data petugas asrama.');
        } else {
            return redirect()->back()->with('fail', 'Proses gagal, silakan periksa format yang diminta.')->withInput();
        }
        return redirect()->route('koordinator.form-tambah-petugas');
    }
}
