<?php

namespace App\Http\Controllers\Petugas;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use App\Models\RecordCheckIn;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RecordMahasiswaAsrama;
use Facade\FlareClient\Glows\Recorder;

class CheckInPetugasController extends Controller
{
    public function showPageCheckIn()
    {
        $asramaIDPetugas = Auth::guard('petugas')->user()->asrama_id;

        $daftarRequestCheckIn = RecordCheckIn::join('check_in', 'check_in.id', '=', 'record_checkin.check_in_id')
        ->join('record_mahasiswa_asrama', 'record_mahasiswa_asrama.users_id', '=', 'record_checkin.users_id')
        ->join('asrama', 'asrama.id', '=', 'record_mahasiswa_asrama.asrama_id')
        ->select('record_checkin.*', 'check_in.tanggal_check_in', 'check_in.keperluan', 'asrama.nama_asrama')
        ->where('record_mahasiswa_asrama.asrama_id', $asramaIDPetugas)
        ->paginate(15);

        //    dd($daftarRequestCheckIn);   
        return view('petugas.check-in.index', compact('daftarRequestCheckIn'));
    }

    public function getDetailCheckIn($id) 
    {
        $asramaIDPetugas = Auth::guard('petugas')->user()->asrama_id;

        $checkInID = RecordCheckIn::join('check_in', 'check_in.id', '=', 'record_checkin.check_in_id')
        ->join('record_mahasiswa_asrama', 'record_mahasiswa_asrama.users_id', '=', 'record_checkin.users_id')
        ->join('asrama', 'asrama.id', '=', 'record_checkin.asrama_id')
        ->where('record_mahasiswa_asrama.asrama_id', $asramaIDPetugas)
        ->where('record_checkin.id', $id)
        ->first();

        return view('petugas.check-in.detail', compact('checkInID'));
    }

    public function acceptCheckIn($id) 
    {
        $checkInID = CheckIn::find($id);

        $petugas_id = Auth::guard('petugas')->user()->id;

        CheckIn::where('id', $id)->update([
            'petugas_id' => $petugas_id,
            'status_request' => 1
        ]);
        
        $userIDMahasiswa = CheckIn::where('id', $id)->value('users_id');
        $asramaIDMahasiswa = CheckIn::where('id', $id)->value('asrama_id');

        RecordMahasiswaAsrama::where('id', $id)->update([
            'users_id' => $userIDMahasiswa,
            'asrama_id' => $asramaIDMahasiswa
        ]);

        return redirect()->route('petugas.detail-check-in', $checkInID->id)
            ->with('success', 'Permintaan Check In mahasiswa diterima');
    }

    public function rejectCheckIn($id) 
    {
        $checkInID = CheckIn::find($id);
        $petugas_id = Auth::guard('petugas')->user()->id;
        
        CheckIn::where('id', $id)->update([
            'petugas_id' => $petugas_id,
            'status_request' => 2
        ]);

        return redirect()->route('petugas.detail-check-in', $checkInID->id)
            ->with('fail', 'Permintaan Check In mahasiswa ditolak');
    }
}
