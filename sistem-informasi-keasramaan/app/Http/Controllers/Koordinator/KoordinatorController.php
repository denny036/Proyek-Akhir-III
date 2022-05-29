<?php

namespace App\Http\Controllers\Koordinator;

use App\Models\Asrama;
use App\Models\Koordinator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\RecordMahasiswaAsrama;
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


    public function showDashboardKoordinator() 
    {
        // ambil data asrama
        // ambil data mahasiswa -> count data mahasiswa / asrama 

        $getAllAsrama = DB::table('asrama')->orderBy('lokasi_asrama', 'asc')->get();

        $getAllMahasiswa = DB::table('users')->count();

        // dd($getAllAsrama);

        return view('koordinator.home', compact('getAllAsrama'));
    }

    public function showDetailDashboard($id) 
    {
        $asramaID = Asrama::find(decrypt($id));
        
        $dataPenghuniAsrama = DB::table('record_mahasiswa_asrama')
                                // ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')  
                                ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
                                ->where('asrama_id', decrypt($id))
                                ->orderBy('users.nama', 'asc')
                                ->paginate(10);

        $daftarPetugasAsrama = Petugas::where('asrama_id', decrypt($id))->paginate(10);
        
        // dd($daftarPetugasAsrama);

        return view("koordinator.home.keasramaan", compact('asramaID', 'dataPenghuniAsrama', 'daftarPetugasAsrama'));
    }

    public function logout() 
    {
        Auth::guard('koordinator')->logout();
        return redirect()->route('welcome');
    }
}
