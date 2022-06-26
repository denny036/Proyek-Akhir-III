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
        ->select('record_checkin.*', 'check_in.tanggal_check_in', 'check_in.keperluan', 'check_in.status_request', 'asrama.nama_asrama')
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
        ->select('record_checkin.*', 'check_in.tanggal_check_in', 'check_in.keperluan', 'check_in.status_request', 'asrama.nama_asrama')
        ->where('record_mahasiswa_asrama.asrama_id', $asramaIDPetugas)
        ->where('record_checkin.id', $id)
        ->first();

        // $checkID = RecordCheckIn::where('id', $id)->value('check_in_id');
        // $recordMahasiswaAsramaID = RecordCheckIn::where('id', $id)->value('users_id');
        // $asramaIDMahasiswa = RecordCheckIn::where('id', $id)->value('asrama_id');
        // $usersID = RecordCheckIn::where('id', $id)->value('users_id');
        // $checkInID = RecordCheckIn::where('id', $id)->value('check_in_id');

        // $tempAsramaID = RecordMahasiswaAsrama::where('users_id', $usersID)->first();
        // $asramaID = $tempAsramaID->asrama_id;
        
        // dd($checkInID);

        return view('petugas.check-in.detail', compact('checkInID'));
    }

    public function acceptCheckIn($id) 
    {
        // $dataRecord = RecordCheckIn::join('check_in', 'check_in.id', '=', 'record_checkin.check_in_id')
        // ->join('record_mahasiswa_asrama', 'record_mahasiswa_asrama.users_id', '=', 'record_checkin.users_id')
        // ->join('asrama', 'asrama.id', '=', 'record_checkin.asrama_id')
        // ->where('record_mahasiswa_asrama.asrama_id', $asramaIDPetugas)
        // ->where('record_checkin.id', $id)
        // ->first();

        $petugas_id = Auth::guard('petugas')->user()->id;
        $checkInID = RecordCheckIn::where('id', $id)->value('check_in_id');

        CheckIn::where('id', $checkInID)->update([
            'status_request' => 1
        ]);
        
        RecordCheckIn::where('id', $id)->update([
            'petugas_id' => $petugas_id
        ]);

        $usersID = RecordCheckIn::where('id', $id)->value('users_id');
        $asramaTujuan = RecordCheckIn::where('id', $id)->value('asrama_id');

        $tempAsramaID = RecordMahasiswaAsrama::where('users_id', $usersID)->first();
        $asramaAwal = $tempAsramaID->asrama_id;

        RecordMahasiswaAsrama::where('users_id', $usersID)->update([
            'asrama_id' => $asramaTujuan,
            'asrama_sebelumnya' => $asramaAwal
        ]);

        return redirect()->route('petugas.check-in')
            ->with('success-check-in', 'Permintaan Check In mahasiswa diterima');
    }

    public function rejectCheckIn($id) 
    {
        $checkInID = CheckIn::find($id);

        $petugas_id = Auth::guard('petugas')->user()->id;
        $checkInID = RecordCheckIn::where('id', $id)->value('check_in_id');
    
        CheckIn::where('id', $checkInID)->update([
            'status_request' => 2
        ]);
        
        RecordCheckIn::where('id', $id)->update([
            'petugas_id' => $petugas_id
        ]);

        return redirect()->route('petugas.check-in')
            ->with('fail-check-in', 'Permintaan Check In mahasiswa ditolak');
    }
}
