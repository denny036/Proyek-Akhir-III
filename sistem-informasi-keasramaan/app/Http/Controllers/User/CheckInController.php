<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CheckIn;
use Illuminate\Support\Facades\Auth;

class CheckInController extends Controller
{
    public function showDataCheckIn() 
    {
      return view('mahasiswa.check-in.index');
    }

    public function showFormCheckIn() 
    {
      $user_id = Auth::guard('web')->user()->id;
      $dataMahasiswa = DB::table('record_mahasiswa_asrama')
                         ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
                         ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
                         ->where('record_mahasiswa_asrama.users_id', '=', $user_id)
                         ->first();

      $dataAsrama = DB::table('asrama')->get();

      return view('mahasiswa.check-in.create', compact('dataMahasiswa', 'dataAsrama'));
    }

    // public function storeCheckIn(Request $request) 
    // {
    //   $request->validate(
    //     [
    //         'asrama' => 'required',
    //         'keperluan' => 'required',
    //         'tanggal_check_in' => 'required'
    //     ],
    //     [
    //         'asrama.required' => 'Kolom Asrama tidak boleh kosong.',
    //         'keperluan.required' => 'Keperluan check-in tidak boleh kosong.',
    //         'tanggal_check_in.required' => 'Tanggal check-in tidak boleh kosong.'
    //     ]);

    //     $user_id = Auth::guard('web')->user()->id;
    //     $asrama_id = $request->asrama;

    //     CheckIn::create([
    //       ''
    //     ])
    // }
}
