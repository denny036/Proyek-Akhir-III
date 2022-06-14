<?php

namespace App\Http\Controllers\User;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\IzinBermalam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class IzinBermalamController extends Controller
{
    public function showPageIzinBermalam()
    {
        $mahasiswa_id = Auth::guard('web')->user()->id;

        $riwayatIB = IzinBermalam::where('users_id', $mahasiswa_id)->orderByDesc('id')->paginate(5);

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
            return view('mahasiswa.izin-bermalam.index', compact('riwayatIB'));
        }

        // dd($riwayatIB);
    }

    public function showReqIB()
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
            return view('mahasiswa.izin-bermalam.create');
        }
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

        if ($save) {
            return redirect()->back()->with('success', 'Anda berhasil melakukan request izin bermalam.');
        } else {
            return redirect()->back()->with('fail', 'Proses gagal, silakan periksa format yang diminta.')->withInput();
        }
        return redirect()->route('mahasiswa.request.izin-bermalam');
    }

    public function getDetailIB($id)
    {
        $izinBermalamID = IzinBermalam::find($id);

        $detailIB = IzinBermalam::join('users', 'izin_bermalam.users_id', '=', 'users.id')
            // ->join('petugas', 'izin_bermalam.petugas_id', '=', 'petugas.id')
            ->where('izin_bermalam.id', $id)
            ->get();

        // dd($detailIB);

        return view('mahasiswa.izin-bermalam.detail', compact('izinBermalamID', 'detailIB'));
    }

    public function printSuratIB($id)
    {
        $izinBermalamID = IzinBermalam::find($id);

        $dataIB = IzinBermalam::join('users', 'izin_bermalam.users_id', '=', 'users.id')
            ->where('izin_bermalam.id', $id)
            ->get();

        $fileName = 'Surat Izin Bermalam.pdf';

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'title'  => 'Surat IB Mahasiswa',
            'default_font_size' => '10',
            'default_font' => 'sans-serif',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 15,
            'margin_bottom' => 20,
            'margin_header' => 10,
            'margin_footer' => 10,
            'orientation' => 'P',

        ]);

        $html = View::make('mahasiswa.izin-bermalam.print')->with('dataIB', $dataIB);
        $html = $html->render();

        // $stylesheet = file_get_contents(url('/css/mdpf.css'));
        // $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->SetTitle('Surat IB Mahasiswa');
        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'I');


        return view('mahasiswa.izin-bermalam.print', compact('dataIB'));
    }
}
