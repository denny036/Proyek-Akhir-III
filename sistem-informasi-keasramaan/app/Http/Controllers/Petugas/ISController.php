<?php

namespace App\Http\Controllers\Petugas;

use App\Models\IzinSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ISController extends Controller
{
    public function showPageISMhs()
    {
        $petugas_id = Auth::guard('petugas')->user()->id;
        $asramaIDPetugas = Auth::guard('petugas')->user()->asrama_id;

        $daftarRequestIS = DB::table('izin_sakit')
            ->join('users', 'izin_sakit.users_id', '=', 'users.id')
            ->join('record_mahasiswa_asrama', 'izin_sakit.users_id', '=', 'record_mahasiswa_asrama.users_id')
            ->select('users.*', 'izin_sakit.*', 'record_mahasiswa_asrama.asrama_id')
            ->where('record_mahasiswa_asrama.asrama_id', $asramaIDPetugas)
            ->paginate(10);

        // dd($daftarRequestIS);                            

        return view('petugas.izin-sakit.index', compact('daftarRequestIS'));
    }

    public function getDetailIS($id)
    {
        $izinSakitID = IzinSakit::find($id);

        // $detailRequestIS = IzinSakit::where('izin_sakit.id', $id)->get();

        // dd($izinSakitID);

        return view('petugas.izin-sakit.detail', compact('izinSakitID'));
    }

    public function accIzinSakit($id)
    {
        $izinSakitID = IzinSakit::find($id);

        $petugas_id = Auth::guard('petugas')->user()->id;

        IzinSakit::where('id', $id)->update([
            'petugas_id' => $petugas_id,
            'status_izin' => 1
        ]);

        return redirect()->route('petugas.detail-izin-sakit', $izinSakitID->id)
            ->with('success', 'Izin sakit mahasiswa diterima');
    }

    public function rejectIzinSakit($id)
    {
        $izinSakitID = IzinSakit::find($id);
        $petugas_id = Auth::guard('petugas')->user()->id;

        IzinSakit::where('id', $id)->update([
            'petugas_id' => $petugas_id,
            'status_izin' => 2
        ]);

        return redirect()->route('petugas.detail-izin-sakit', $izinSakitID->id)
            ->with('fail', 'Izin sakit mahasiswa ditolak');
    }

    public function updateKondisiMahasiswa(Request $request, $id)
    {
        $izinSakit = IzinSakit::find($id);

        $result = IzinSakit::find($id)->update([
            'kondisi' => $request->kondisi,
        ]);
        
        // dd($result);

        if($result) {
            return redirect()->route('petugas.detail-izin-sakit', $izinSakit->id)
                ->with('success-update-kondisi', 'Kondisi kesehatan mahasiswa telah diperbarui');
        }else{
            return redirect()->back()->with('fail-update-kondisi', 'Proses gagal, silakan periksa format yang diminta.')->withInput();
        }
    }
}
