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
        $izinBermalamID = IzinBermalam::find($id);
        
        $detailReqIB = IzinBermalam::join('users', 'izin_bermalam.users_id', '=', 'users.id')
                        ->join('record_mahasiswa_asrama', 'izin_bermalam.users_id', '=', 'record_mahasiswa_asrama.users_id')
                        ->select('users.*', 'izin_bermalam.*', 'record_mahasiswa_asrama.asrama_id')
                        ->where('izin_bermalam.id', $id)
                        ->get();

        // dd($detailReqIB);
        return view('petugas.izin-bermalam.detail', compact('izinBermalamID', 'detailReqIB'));
    }

    public function accIB($id)
    {
        $izinBermalamID = IzinBermalam::find($id);

        $petugas_id = Auth::guard('petugas')->user()->id;

        IzinBermalam::where('id', $id)->update([
            'petugas_id' => $petugas_id,
            'status' => 1
        ]);
        
        return redirect()->route('petugas.detail-izin-bermalam', $izinBermalamID->id)
            ->with('success', 'Izin bermalam mahasiswa diterima');

    }

    public function rejectIB(Request $request, $id)
    {
        $izinBermalamID = IzinBermalam::find($id);
        $petugas_id = Auth::guard('petugas')->user()->id;

        // $request->validate(
        //     [
        //         'alasan_penolakan' => 'required|min:4|max:45',
        //     ],
        //     [
        //         'alasan_penolakan.required' => 'Alasan penolakan tidak boleh kosong.',
        //         'alasan_penolakan.min' => 'Alasan penolakan minimal 4 karakter.',
        //         'alasan_penolakan.max' =>  'Alasan penolakan maksimal 45 karakter.',
        //     ]
        // );
        
        if (empty($request->alasan_tolak)){
            return redirect()->back()->with('fail-format', 'Gagal menolak permintaan mahasiswa, silakan isi alasan penolakan dengan format yang benar!');
        }else{
            $save = IzinBermalam::where('id', $id)->update([
                'petugas_id' => $petugas_id,
                'status' => 2,
                'alasan_tolak' => $request->alasan_tolak
            ]);
            if ($save) {
                return redirect()->route('petugas.detail-izin-bermalam', $izinBermalamID->id)
                ->with('fail', 'Izin bermalam mahasiswa ditolak');
            } else {
                return redirect()->back()->with('fail-format', 'Gagal menolak permintaan mahasiswa, silakan isi alasan penolakan dengan format yang benar!');
            }
        }


        // dd($alasanTolak);

        
        
    }
}
