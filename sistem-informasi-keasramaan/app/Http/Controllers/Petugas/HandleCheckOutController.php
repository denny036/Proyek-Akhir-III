<?php

namespace App\Http\Controllers\Petugas;

use App\Models\CheckOut;
use Illuminate\Http\Request;
use App\Models\RecordCheckOut;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RecordMahasiswaAsrama;

class HandleCheckOutController extends Controller
{
    public function showPageCheckOut() 
    {
        $asramaIDPetugas = Auth::guard('petugas')->user()->asrama_id;

        $daftarRequestCheckOut = RecordCheckOut::join('check_out', 'check_out.id', '=', 'record_checkout.check_out_id')
        ->join('record_mahasiswa_asrama', 'record_mahasiswa_asrama.users_id', '=', 'record_checkout.users_id')
        ->join('asrama', 'asrama.id', '=', 'record_mahasiswa_asrama.asrama_id')
        ->select('record_checkout.*', 'check_out.tanggal_check_out', 'check_out.keperluan', 'check_out.status_request', 'asrama.nama_asrama')
        ->where('record_mahasiswa_asrama.asrama_id', $asramaIDPetugas)
        ->paginate(15);

        //    dd($daftarRequestCheckIn);   
        return view('petugas.check-out.index', compact('daftarRequestCheckOut'));
    }

    public function getDetailCheckOut($id) 
    {
        $asramaIDPetugas = Auth::guard('petugas')->user()->asrama_id;

        $dataCheckOut = RecordCheckOut::join('check_out', 'check_out.id', '=', 'record_checkout.check_out_id')
        ->join('record_mahasiswa_asrama', 'record_mahasiswa_asrama.users_id', '=', 'record_checkout.users_id')
        ->join('asrama', 'asrama.id', '=', 'record_mahasiswa_asrama.asrama_id')
        // ->join('check_in', 'check_in.id', 'record_checkout.id')
        ->select('record_checkout.*', 'check_out.tanggal_check_out', 'check_out.keperluan', 'check_out.status_request', 'asrama.nama_asrama')
        ->where('record_mahasiswa_asrama.asrama_id', $asramaIDPetugas)
        ->where('record_checkout.id', $id)
        ->first();

        // $usersID = RecordCheckOut::where('id', $id)->value('users_id');
        // $tempAsramaID = RecordMahasiswaAsrama::where('users_id', $usersID)->first();
        // $asramaAwal = $tempAsramaID->asrama_sebelumnya;

        // dd($asramaAwal);
        return view('petugas.check-out.detail', compact('dataCheckOut'));
    }

    public function acceptCheckOut($id) 
    {
        $petugas_id = Auth::guard('petugas')->user()->id;
        $checkOutID = RecordCheckOut::where('id', $id)->value('check_out_id');

        CheckOut::where('id', $checkOutID)->update([
            'status_request' => 1
        ]);
        
        RecordCheckOut::where('id', $id)->update([
            'petugas_id' => $petugas_id
        ]);

        $usersID = RecordCheckOut::where('id', $id)->value('users_id');

        $tempAsramaID = RecordMahasiswaAsrama::where('users_id', $usersID)->first();
        $asramaAwal = $tempAsramaID->asrama_sebelumnya;
        $asramaCheckIn = $tempAsramaID->asrama_id;

        RecordMahasiswaAsrama::where('users_id', $usersID)->update([
            'asrama_id' => $asramaAwal,
            'asrama_sebelumnya' => $asramaCheckIn
        ]);

        return redirect()->route('petugas.check-out')
            ->with('success-check-out', 'Permintaan Check Out mahasiswa diterima');
    }

    public function rejectCheckOut($id) 
    {
        $checkOutID = CheckOut::find($id);

        $petugas_id = Auth::guard('petugas')->user()->id;
        $checkOutID = RecordCheckOut::where('id', $id)->value('check_out_id');
    
        CheckOut::where('id', $checkOutID)->update([
            'status_request' => 2
        ]);
        
        RecordCheckOut::where('id', $id)->update([
            'petugas_id' => $petugas_id
        ]);

        return redirect()->route('petugas.check-out')
            ->with('fail-check-out', 'Permintaan Check Out mahasiswa ditolak');
    }
}
