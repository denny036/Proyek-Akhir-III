<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\CheckIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RecordCheckIn;
use Illuminate\Support\Facades\Auth;

class CheckInController extends Controller
{
  public function showDataCheckIn()
  {
    $userID = Auth::guard('web')->user()->id;
    $dataMahasiswa = DB::table('record_mahasiswa_asrama')
      ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
      ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
      ->where('record_mahasiswa_asrama.users_id', '=', $userID)
      ->first();

    $riwayatCheckIn = RecordCheckIn::join('check_in', 'check_in.id', 'record_checkin.check_in_id')
                      ->where('users_id', $userID)->paginate(10);


    if (empty($dataMahasiswa)) {
      return redirect()->route('mahasiswa.profile')
        ->with('info', 'Untuk menggunakan aplikasi ini, silakan pilih asrama Anda terlebih dahulu!');
    } else {

      $checkStatus = RecordCheckIn::join('check_in', 'check_in.id', 'record_checkin.check_in_id')->where('users_id', $userID)->whereNull('check_in.status_request')->first();                      
    
      $isStatusMenunggu = $checkStatus->status_request ?? $checkStatus == "";
      
      return view('mahasiswa.check-in.index', compact('riwayatCheckIn', 'isStatusMenunggu'));
    }
  }

  public function showFormCheckIn()
  {
    $user_id = Auth::guard('web')->user()->id;

    $dataMahasiswa = DB::table('record_mahasiswa_asrama')
      ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
      ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
      ->where('record_mahasiswa_asrama.users_id', '=', $user_id)
      ->first();

    if (empty($dataMahasiswa)) {
      return redirect()->route('mahasiswa.profile')
        ->with('info', 'Untuk menggunakan aplikasi ini, silakan pilih asrama Anda terlebih dahulu!');
    } else {
      $dataAsrama = DB::table('asrama')->get();
      return view('mahasiswa.check-in.create', compact('dataMahasiswa', 'dataAsrama'));
    }
  }

  public function storeCheckIn(Request $request)
  {
    $request->validate(
      [
        'asrama_tujuan' => 'required',
        'keperluan' => 'required|min:6|max:45|',
        'tanggal_check_in' => 'required'
      ],
      [
        'asrama.required' => 'Kolom Asrama tidak boleh kosong.',
        'keperluan.required' => 'Keperluan check-in tidak boleh kosong.',
        'keperluan.min' => 'Keperluan check-in minimal terdiri atas 6 karakter.',
        'keperluan.max' => 'Keperluan check-in maksimal 45 karakter.',
        'tanggal_check_in.required' => 'Tanggal check-in tidak boleh kosong.'
      ]
    );

    $mahasiswaID = Auth::guard('web')->user()->id;

      $checkin = new CheckIn;
      $checkin->tanggal_check_in = Carbon::createFromFormat('Y-m-d\TH:i', $request->tanggal_check_in)->format('Y-m-d\TH:i');
      $checkin->keperluan = $request->keperluan;

      if($checkin->save())
      {
        $recordCheckIn = new RecordCheckIn;
        $recordCheckIn->check_in_id = $checkin->id;
        $recordCheckIn->users_id = $mahasiswaID;
        $recordCheckIn->asrama_id = $request->asrama_tujuan;

        if($recordCheckIn->save())
        {
          return redirect()->route('mahasiswa.request.check-in')->with('success', 'Anda berhasil melakukan request check in.');
        }
        return redirect()->route('mahasiswa.request.check-in')->with('fail', 'Proses gagal, silakan periksa format yang diminta.')->withInput();
      }
  }

  public function getDetailCheckIn($id)
  {
    $userID = Auth::guard('web')->user()->id;

    $dataAsramaMahasiswa = DB::table('record_mahasiswa_asrama')
      ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
      ->join('asrama', 'record_mahasiswa_asrama.asrama_sebelumnya', '=', 'asrama.id')
      ->where('record_mahasiswa_asrama.users_id', '=', $userID)
      ->first();


    $detailCheckIn = RecordCheckIn::join('check_in', 'check_in.id', '=', 'record_checkin.check_in_id')
    ->where('check_in.id', $id)->where('users_id', $userID)->get(); 

    // dd($dataAsramaMahasiswa);

    return view('mahasiswa.check-in.detail', compact('detailCheckIn', 'dataAsramaMahasiswa'));
  }
}
