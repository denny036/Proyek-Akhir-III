<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\IzinBermalam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IzinBermalamController extends Controller
{
    public function showPageIzinBermalam() 
    {
        $mahasiswa_id = Auth::guard('web')->user()->id;

        $riwayatIB = DB::table('izin_bermalam')->where('users_id', $mahasiswa_id)->paginate(5);

        return view('mahasiswa.izin-bermalam.index', compact('riwayatIB'));
    }

    public function showReqIB() 
    {
      return view('mahasiswa.izin-bermalam.create');
    }
    
    public function storeIB(Request $request) 
    {
        $request->validate(
            [
                'rencana_berangkat' => 'required',
                'rencana_kembali' => 'required',
                'keperluan_ib' => 'required|min:6|max:45|',
                'tempat_tujuan' => 'required|max:45|',

            ],
            [
                'rencana_berangkat.required' => 'Rencana berangkat tidak boleh kosong.',
                'rencana_kembali.required' => 'Rencana kembali tidak boleh kosong.',
                'keperluan_ib.required' =>  'Keperluan IB tidak boleh kosong.',
                'keperluan_ib.min' => 'Keperluan IB minimal terdiri atas 6 karakter.',
                'keperluan_ib.max' => 'Keperluan IB maksimal 45 karakter.',
                'tempat_tujuan.required' => 'Tempat tujuan tidak boleh kosong.',
                'tempat_tujuan.max' => 'Tempat tujuan maksimal 45 karakter.'
            ]
        );

        $save = DB::table('izin_bermalam')->insert([
                    'users_id' => Auth::guard('web')->user()->id,
                    'rencana_berangkat' => Carbon::createFromFormat('Y-m-d\TH:i', $request->rencana_berangkat)->format('Y-m-d\TH:i'),
                    'rencana_kembali' => Carbon::createFromFormat('Y-m-d\TH:i', $request->rencana_kembali)->format('Y-m-d\TH:i'),
                    'keperluan_ib' => $request->keperluan_ib,
                    'tempat_tujuan' => $request->tempat_tujuan,
        ]);

        // $user_id = Auth::guard('web')->user()->id;

        // $izin_asrama = new IzinBermalam();

        // $izin_asrama->users_id = $request->$user_id;
        
        // $izin_asrama->rencana_berangkat = Carbon::createFromFormat('Y-m-d\TH:i', $request->rencana_berangkat)->format('Y-m-d\TH:i');
        // $izin_asrama->rencana_kembali = Carbon::createFromFormat('Y-m-d\TH:i', $request->rencana_kembali)->format('Y-m-d\TH:i');
        // $izin_asrama->keperluan_ib = $request->keperluan_ib;
        // $izin_asrama->tempat_tujuan = $request->tempat_tujuan;
        
        // $save = $izin_asrama->save();

        if ($save) {
            return redirect()->back()->with('success', 'Anda berhasil melakukan request izin bermalam.');
        } else {
            return redirect()->back()->with('fail', 'Proses gagal, silakan periksa format yang diminta.')->withInput();
        }
        return redirect()->route('mahasiswa.request.izin-bermalam');
    }

    public function getDetailIB($id) 
    {
        $izinBermalamID = IzinBermalam::find(decrypt($id));
        // $mahasiswa_id = Auth::guard('web')->user()->id;

        $detailIB = DB::table('izin_bermalam')
                        ->join('users', 'izin_bermalam.users_id', '=', 'users.id')
                        ->where('izin_bermalam.id', decrypt($id))
                        ->get();

        // dd($detailIB);

        return view('mahasiswa.izin-bermalam.detail', compact('izinBermalamID', 'detailIB'));
    }
}
