<?php

namespace App\Http\Controllers\Petugas;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RecordMahasiswaAsrama;
use Illuminate\Support\Facades\Auth;

class CheckInPetugasController extends Controller
{
    public function showPageCheckIn()
    {
        $asramaIDPetugas = Auth::guard('petugas')->user()->asrama_id;

        $daftarRequestCheckIn = CheckIn::paginate(15);
        
        // $daftarRequestCheckIn = CheckIn::join('asrama', 'check_in.asrama_id', 'asrama.id')
        // ->join('record_mahasiswa_asrama', 'check_in.users_id', '=', 'record_mahasiswa_asrama.users_id')
        // ->where('check_in.asrama_id', $asramaIDPetugas)
        // ->paginate(15);

        // $daftarRequestCheckIn = CheckIn::join('record_mahasiswa_asrama', 'check_in.users_id', '=', 'record_mahasiswa_asrama.users_id')
        // ->join('asrama', 'check_in.asrama_id', '=', 'asrama.id')
        // ->where('check_in.asrama_id', $asramaIDPetugas)
        // // ->orderByDesc('check_in.id')
        // ->paginate(15);

        // $daftarRequestCheckIn = CheckIn::join('record_mahasiswa_asrama', 'check_in.users_id', '=', 'record_mahasiswa_asrama.id')
        // ->join('asrama', 'check_in.asrama_id', '=', 'asrama.id')
        // ->paginate(15);

        // $daftarRequestCheckIn = CheckIn::join('record_mahasiswa_asrama', 'check_in.users_id', '=', 'record_mahasiswa_asrama.users_id')
        // ->select('check_in.*')
        // ->paginate(10);

        $dataAsramaMahasiswa = RecordMahasiswaAsrama::join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
            ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
            ->where('record_mahasiswa_asrama.asrama_id', '=', $asramaIDPetugas)
            ->first();

        // $dataAsramaMahasiswa = CheckIn::join('record_mahasiswa_asrama', 'check_in.users_id', '=', 'record_mahasiswa_asrama.users_id')
        // ->select('check_in.*', 'record_mahasiswa_asrama.asrama_id')
        // ->get();

        //    dd($daftarRequestCheckIn); 
        return view('petugas.check-in.index', compact('daftarRequestCheckIn', 'dataAsramaMahasiswa'));
    }

    public function getDetailCheckIn($id) 
    {
        $asramaIDPetugas = Auth::guard('petugas')->user()->asrama_id;

        $checkInID = CheckIn::find($id);

        // $detailCheckIn = CheckIn::join('record_mahasiswa_asrama', 'check_in.asrama_id', '=', 'record_mahasiswa_asrama.asrama_id')
        // ->join('users', 'check_in.users_id', '=', 'users.id')
        // ->where('check_in.id', $id)
        // ->get();

        $dataAsramaMahasiswa = DB::table('record_mahasiswa_asrama')
            ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
            ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
            ->where('record_mahasiswa_asrama.asrama_id', '=', $asramaIDPetugas)
            ->first();
        
        // dd($detailCheckIn);

        return view('petugas.check-in.detail', compact('checkInID', 'dataAsramaMahasiswa'));
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
