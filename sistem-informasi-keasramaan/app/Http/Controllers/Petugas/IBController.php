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
        $asramaIDPetugas = Auth::guard('petugas')->user()->asrama_id;

        $daftarRequestIB = DB::table('izin_bermalam')
                            ->join('users', 'izin_bermalam.users_id', '=', 'users.id')
                            ->join('record_mahasiswa_asrama', 'izin_bermalam.users_id', '=', 'record_mahasiswa_asrama.users_id')
                            ->select('users.*', 'izin_bermalam.*', 'record_mahasiswa_asrama.asrama_id')
                            ->where('record_mahasiswa_asrama.asrama_id', $asramaIDPetugas)
                            ->paginate(10);

        // dd($daftarRequestIB);                            

        return view('petugas.izin-bermalam.index', compact('daftarRequestIB'));
    }

    public function getDetailIB($id) 
    {
        $izinBermalamID = IzinBermalam::find(decrypt($id));

        $detailReqIB = DB::table('izin_bermalam')
                            ->join('users', 'izin_bermalam.users_id', '=', 'users.id')
                            ->where('izin_bermalam.id', decrypt($id))
                            ->get();
                            
        // dd($detailReqIB);
        return view('petugas.izin-bermalam.detail', compact('izinBermalamID', 'detailReqIB'));
    }
}
