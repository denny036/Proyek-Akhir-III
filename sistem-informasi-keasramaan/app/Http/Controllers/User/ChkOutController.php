<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\CheckOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RecordCheckOut;
use Illuminate\Support\Facades\Auth;

class ChkOutController extends Controller
{
    public function showDataCheckOut()
  {
    $userID = Auth::guard('web')->user()->id;
    $dataMahasiswa = DB::table('record_mahasiswa_asrama')
      ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
      ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
      ->where('record_mahasiswa_asrama.users_id', '=', $userID)
      ->first();

    $riwayatCheckOut = RecordCheckOut::join('check_out', 'check_out.id', 'record_checkout.check_out_id')
      ->where('users_id', $userID)->paginate(10);  

    if (empty($dataMahasiswa)) {
      return redirect()->route('mahasiswa.profile')
        ->with('info', 'Untuk menggunakan aplikasi ini, silakan pilih asrama Anda terlebih dahulu!');
    } else {

      $checkStatus = RecordCheckOut::join('check_out', 'check_out.id', 'record_checkout.check_out_id')->where('users_id', $userID)->whereNull('check_out.status_request')->first();

      $isStatusMenunggu = $checkStatus->status_request ?? $checkStatus == "";

      return view('mahasiswa.check-out.index', compact('riwayatCheckOut', 'isStatusMenunggu'));
    }
  }

  public function showFormCheckOut()
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
      return view('mahasiswa.check-out.create', compact('dataMahasiswa', 'dataAsrama'));
    }
  }

  public function storeCheckOut(Request $request)
  {
    $request->validate(
        [
          'keperluan' => 'required|min:6|max:45|',
          'tanggal_check_out' => 'required'
        ],
        [
          'keperluan.required' => 'Keperluan check-in tidak boleh kosong.',
          'keperluan.min' => 'Keperluan check-in minimal terdiri atas 6 karakter.',
          'keperluan.max' => 'Keperluan check-in maksimal 45 karakter.',
          'tanggal_check_out.required' => 'Tanggal check-out tidak boleh kosong.'
        ]
      );
  
      $mahasiswaID = Auth::guard('web')->user()->id;
  
        $checkout = new CheckOut;
        $checkout->tanggal_check_out = Carbon::createFromFormat('Y-m-d\TH:i', $request->tanggal_check_out)->format('Y-m-d\TH:i');
        $checkout->keperluan = $request->keperluan;
  
        if($checkout->save())
        {
          $recordCheckOut = new RecordCheckOut;
          $recordCheckOut->check_out_id = $checkout->id;
          $recordCheckOut->users_id = $mahasiswaID;
  
          if($recordCheckOut->save())
          {
            return redirect()->route('mahasiswa.request.check-out')->with('success', 'Anda berhasil melakukan request check out.');
          }
          return redirect()->route('mahasiswa.request.check-out')->with('fail', 'Proses gagal, silakan periksa format yang diminta.')->withInput();
        }
  }

  public function getDetailCheckOut($id)
  {
    $userID = Auth::guard('web')->user()->id;

    $dataAsramaMahasiswa = DB::table('record_mahasiswa_asrama')
      ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
      ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
      // ->select('asrama.nama_asrama', 'record_mahasiswa_asrama.asrama_sebelumnya')
      ->where('record_mahasiswa_asrama.users_id', '=', $userID)
      ->first();


    $detailCheckOut = RecordCheckOut::join('check_out', 'check_out.id', '=', 'record_checkout.check_out_id')
    ->where('check_out.id', $id)->where('users_id', $userID)->get(); 

    // dd($dataAsramaMahasiswa);

    return view('mahasiswa.check-out.detail', compact('detailCheckOut', 'dataAsramaMahasiswa'));
  }
}
