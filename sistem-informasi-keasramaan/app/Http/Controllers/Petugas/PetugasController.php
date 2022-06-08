<?php

namespace App\Http\Controllers\Petugas;

use App\Models\User;
use App\Models\Asrama;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RecordMahasiswaAsrama;
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

    public function getAllPetugas() 
    {
        $dataPetugas = Petugas::first()->orderBy('nama', 'asc')->paginate(15);
        return view('petugas.data-petugas', compact('dataPetugas'));
    }

    public function getPenghuniAsrama() 
    {
        $getAllAsrama = DB::table('asrama')->orderBy('lokasi_asrama', 'asc')->get();

        $getAllMahasiswa = DB::table('users')->count();


        return view('petugas.penghuni-asrama.index', compact('getAllAsrama'));
    }


    public function showHomePetugas() 
    {
        $asramaLaki = Asrama::where('jenis_asrama', 'laki-laki')->count();
        $asramaPerempuan = Asrama::where('jenis_asrama', 'perempuan')->count();
        $namaPetugas = Auth::guard('petugas')->user()->nama;
        
        $asramaPetugas = Auth::guard('petugas')->user()->asrama_id;
        $lokasiBertugas = Petugas::where('asrama_id', $asramaPetugas)->first();

        $totalMahasiswa = RecordMahasiswaAsrama::join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
                                ->select(DB::raw('count(asrama_id) as Total'))
                                ->where('asrama.id', '=', $asramaPetugas)
                                ->first();

        $getAllAsrama = DB::table('asrama')->orderBy('lokasi_asrama', 'asc')->get();

        // dd($totalMahasiswa);
        return view('petugas.home', compact('asramaLaki', 'asramaPerempuan', 'namaPetugas', 'lokasiBertugas', 'totalMahasiswa', 'getAllAsrama'));
    }

    public function showDetailAsrama($id) 
    {
        $asramaID = Asrama::find(decrypt($id));
        
        $dataPenghuniAsrama = DB::table('record_mahasiswa_asrama')
                                ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
                                ->where('asrama_id', decrypt($id))
                                ->orderBy('users.nama', 'asc')
                                ->paginate(10);

        $daftarPetugasAsrama = Petugas::where('asrama_id', decrypt($id))->paginate(15);
        
        // dd($daftarPetugasAsrama);

        return view("petugas.penghuni-asrama.detail-asrama", compact('asramaID', 'dataPenghuniAsrama', 'daftarPetugasAsrama'));
    }

    public function logout() 
    {
        Auth::guard('petugas')->logout();
        return redirect()->route('welcome');
    }
}
