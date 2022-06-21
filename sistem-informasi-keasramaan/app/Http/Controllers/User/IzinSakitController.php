<?php

namespace App\Http\Controllers\User;

use App\Models\IzinSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IzinSakitController extends Controller
{
    public function showPageIzinSakit()
    {
        $mahasiswa_id = Auth::guard('web')->user()->id;

        $riwayatIS = IzinSakit::where('users_id', $mahasiswa_id)->orderByDesc('id')->paginate(5);

        $dataMahasiswa = DB::table('record_mahasiswa_asrama')
            ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
            ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
            ->where('record_mahasiswa_asrama.users_id', '=', $mahasiswa_id)
            ->first();
        
        //jika asrama mahasiswa == null
        if (empty($dataMahasiswa)) {
            return redirect()->route('mahasiswa.profile')
                ->with('info', 'Untuk menggunakan aplikasi ini, silakan pilih asrama Anda terlebih dahulu!');
        } else {
            return view('mahasiswa.izin-sakit.index', compact($riwayatIS));
        }
    }

    public function showReqIS() 
    {
        $mahasiswa_id = Auth::guard('web')->user()->id;

        $dataMahasiswa = DB::table('record_mahasiswa_asrama')
            ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
            ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
            ->where('record_mahasiswa_asrama.users_id', '=', $mahasiswa_id)
            ->first();
        
            
        //jika asrama mahasiswa == null
        if (empty($dataMahasiswa)) {
            return redirect()->route('mahasiswa.profile')
                ->with('info', 'Untuk menggunakan aplikasi ini, silakan pilih asrama Anda terlebih dahulu!');
        } else {
            return view('mahasiswa.izin-sakit.create', compact('dataMahasiswa'));
        }
    }

    // public function storeIS() 
    // {

    // }

    // public function getDetailIzinSakit() 
    // {

    // }

    // public function updateIzinSakit() 
    // {

    // }
}
