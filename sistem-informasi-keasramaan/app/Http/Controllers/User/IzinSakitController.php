<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\IzinSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IzinSakitController extends Controller
{
    public function showPageIzinSakit()
    {
        $mahasiswa_id = Auth::guard('web')->user()->id;

        $riwayatIS = IzinSakit::where('users_id', $mahasiswa_id)->orderByDesc('id')->paginate(5);

        $dataMahasiswa = DB::table('record_mahasiswa_asrama')
            ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
            ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
            ->where('record_mahasiswa_asrama.users_id', '=', $mahasiswa_id)
            ->first();

        //jika asrama mahasiswa == null
        if (empty($dataMahasiswa)) {
            return redirect()->route('mahasiswa.profile')
                ->with('info', 'Untuk menggunakan aplikasi ini, silakan pilih asrama Anda terlebih dahulu!');
        } else {
            return view('mahasiswa.izin-sakit.index', compact('riwayatIS'));
        }
    }

    public function showReqIS()
    {
        $mahasiswa_id = Auth::guard('web')->user()->id;

        $dataMahasiswa = DB::table('record_mahasiswa_asrama')
            ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
            ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
            ->where('record_mahasiswa_asrama.users_id', '=', $mahasiswa_id)
            ->first();


        //jika asrama mahasiswa == null
        if (empty($dataMahasiswa)) {
            return redirect()->route('mahasiswa.profile')
                ->with('info', 'Untuk menggunakan aplikasi ini, silakan pilih asrama Anda terlebih dahulu!');
        } else {
            return view('mahasiswa.izin-sakit.create', compact('dataMahasiswa'));
        }
    }

    public function storeIS(Request $request)
    {
        $request->validate(
            [
                'jadwal_istirahat' => 'required',
                'keterangan' => 'required|min:6|max:45|',
                'surat_sakit' => 'image|file|mimes:jpg,png,jpeg|max:1024',

            ],
            [
                'jadwal_istirahat.required' => 'Jadwal Istirahat tidak boleh kosong.',
                'keterangan.required' =>  'Keterangan sakit tidak boleh kosong.',
                'keterangan.min' => 'Keterangan sakit minimal terdiri atas 6 karakter.',
                'keterangan.max' => 'Keterangan sakit maksimal 45 karakter.',
                'surat_sakit.max' => 'Lampiran surat sakit maksimal 1 MB',
            ]
        );

        if ($request->hasFile('surat_sakit')) {
            $file = $request->file('surat_sakit');
            $fileExtension = $file->getClientOriginalExtension();
            $destinationPath = 'uploads/surat-sakit/';
            $fileName =  md5(time()) . '.' . $fileExtension;
            $file->move($destinationPath, $fileName);

            $saveHasFile = DB::table('izin_sakit')->insert([
                'users_id' => Auth::guard('web')->user()->id,
                'jadwal_istirahat' => Carbon::createFromFormat('Y-m-d\TH:i', $request->jadwal_istirahat)->format('Y-m-d\TH:i'),
                'keterangan' => $request->keterangan,
                'surat_sakit' => $fileName,
            ]);
            if($saveHasFile){
                return redirect()->back()->with('success', 'Anda berhasil melakukan request izin sakit.');
            }else{
                return redirect()->back()->with('fail', 'Proses gagal, silakan periksa format yang diminta.')->withInput();
            }
            
        }else{
            $saveHasNoFile = DB::table('izin_sakit')->insert([
                'users_id' => Auth::guard('web')->user()->id,
                'jadwal_istirahat' => Carbon::createFromFormat('Y-m-d\TH:i', $request->jadwal_istirahat)->format('Y-m-d\TH:i'),
                'keterangan' => $request->keterangan,
            ]);

            if ($saveHasNoFile) {
                return redirect()->back()->with('success', 'Anda berhasil melakukan request izin sakit.');
            } else {
                return redirect()->back()->with('fail', 'Proses gagal, silakan periksa format yang diminta.')->withInput();
            }
        }
        // dd($request);
    }

    public function getDetailIzinSakit($id) 
    {
        $izinSakitID = IzinSakit::find($id);

        $detailIS = IzinSakit::join('users', 'izin_sakit.users_id', '=', 'users.id')
            ->where('izin_sakit.id', $id)
            ->get();

        // dd($detailIB);

        return view('mahasiswa.izin-sakit.detail', compact('izinSakitID', 'detailIS'));
    }

    // public function updateIzinSakit() 
    // {

    // }
}
