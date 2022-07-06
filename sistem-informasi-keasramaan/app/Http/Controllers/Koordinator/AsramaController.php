<?php

namespace App\Http\Controllers\Koordinator;

use App\Models\Asrama;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\RecordMahasiswaAsrama;

class AsramaController extends Controller
{
    public function showDataAsrama(Request $request, Asrama $asrama)
    {
        // $asrama = Asrama::orderBy('nama_asrama', 'asc')->paginate(10);
        // $onlyNamaAsrama = Asrama::where('nama_asrama')->get();

        $keyword = $request->cari;
        $dataAsrama = Asrama::where('nama_asrama', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('jenis_asrama', 'LIKE', '%'.$keyword.'%') 
                        ->orWhere('lokasi_asrama', 'LIKE', '%'.$keyword.'%')
                        ->paginate(10);

        $dataAsrama->appends($request->all());

        return view('koordinator.asrama.index', compact('keyword', 'dataAsrama'));
    }

    public function storeDataAsrama(Request $request)
    {
        //validate input
        $request->validate(
            [
                'nama_asrama' => 'required|min:4|max:20',
                'jenis_asrama' => 'required',
                'lokasi_asrama' => 'required',
            ],
            [
                'nama_asrama.required' => 'Nama Asrama tidak boleh kosong.',
                'nama_asrama.min' => 'Nama Asrama minimal 3 karakter.',
                'nama_asrama.max' =>  'Nama Asrama maksimal 20 karakter.',
                'jenis_asrama.required' => 'Jenis Asrama tidak boleh kosong.',
                'lokasi_asrama.required' => 'Lokasi Asrama tidak boleh kosong.'
            ]
        );

        $asrama = new Asrama();
        $asrama->nama_asrama = $request->nama_asrama;
        $asrama->jenis_asrama = $request->jenis_asrama;
        $asrama->lokasi_asrama = $request->lokasi_asrama;
        $save = $asrama->save();

        if ($save) {
            return redirect()->back()->with('success', 'Anda berhasil menambahkan data asrama.');
        } else {
            return redirect()->back()->with('fail', 'Proses simpan gagal, silakan perhatikan format yang diminta.');
        }
    }

    public function showFormEditAsrama($id) 
    {
        $asrama = Asrama::find($id);
        $dataAsrama = Asrama::all();
        return view('koordinator.asrama.edit', compact('asrama', 'dataAsrama'));
    }

    public function updateDataAsrama(Request $request, $id) 
    {
        $request->validate(
            [
                'nama_asrama' => 'required|min:4|max:20',
                'jenis_asrama' => 'required',
                'lokasi_asrama' => 'required',
            ],
            [
                'nama_asrama.required' => 'Nama Asrama tidak boleh kosong.',
                'nama_asrama.min' => 'Nama Asrama minimal 3 karakter.',
                'nama_asrama.max' =>  'Nama Asrama maksimal 20 karakter.',
                'jenis_asrama.required' => 'Jenis Asrama tidak boleh kosong.',
                'lokasi_asrama.required' => 'Lokasi Asrama tidak boleh kosong.'
            ]
        );

        $save = Asrama::find($id)->update([
            'nama_asrama' => $request->nama_asrama,
            'jenis_asrama' => $request->jenis_asrama,
            'lokasi_asrama' => $request->lokasi_asrama,
        ]);

        if ($save) {
            return redirect()->back()->with('success', 'Anda berhasil mengubah data asrama.');
        } else {
            return redirect()->back()->with('fail', 'Proses edit gagal, silakan periksa format yang diminta.')->withInput();
        }
    }

    public function deleteDataAsrama($id) 
    {
        $dataAsrama = Asrama::find($id);
        $dataAsrama->delete();
        return redirect()->back()->with('success', 'Data asrama berhasil dihapus');
    }
}
