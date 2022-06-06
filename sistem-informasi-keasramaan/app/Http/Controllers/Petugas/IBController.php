<?php

namespace App\Http\Controllers\Petugas;

use App\Models\IzinBermalam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IBController extends Controller
{   

    public function showPageIBMhs() 
    {   
        $petugas_id = Auth::guard('petugas')->user()->id;
        $asramaPetugas = Auth::guard('petugas')->user()->asrama_id;

        $daftarReqIB = DB::table('izin_bermalam')
                            ->join('users', 'izin_bermalam.users_id', '=', 'users.id')
                            ->join('record_mahasiswa_asrama', 'izin_bermalam.users_id', '=', 'record_mahasiswa_asrama.users_id')
                            ->where('record_mahasiswa_asrama.asrama_id', $asramaPetugas)
                            ->get();

        return view('petugas.izin-bermalam.index', compact('daftarReqIB'));
    }

    // public function showDetailIB($id) 
    // {
    //     $izinBermalamID = IzinBermalam::find(decrypt($id));

    //     $asramaPetugas = Auth::guard('petugas')->user()->asrama_id;

    //     $detailReqIB = DB::table('izin_bermalam')
    //                         ->join('users', 'izin_bermalam.users_id', '=', 'users.id')
    //                         ->join('record_mahasiswa_asrama', 'izin_bermalam.users_id', '=', 'record_mahasiswa_asrama.users_id')
    //                         ->where('izin_bermalam.id', decrypt($izinBermalamID))
    //                         ->get();
    //     dd($detailReqIB);
        
    //     return view('petugas.izin-bermalam.detail', compact('izinBermalamID', 'detailReqIB'));
    // }
}
