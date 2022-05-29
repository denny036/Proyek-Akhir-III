<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\Asrama;
use Illuminate\Http\Request;

class AsramaController extends Controller
{
    public function showDataAsrama(Asrama $asrama) 
    {   
        $asrama = Asrama::orderBy('created_at', 'asc')->paginate(5);
        return view('koordinator.asrama.index',compact('asrama'));
    }
    
    public function storeDataAsrama(Request $request) 
    {
        //validate input
        $request->validate([
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
        ]);

        $asrama = new Asrama();
        $asrama->nama_asrama = $request->nama_asrama;
        $asrama->jenis_asrama = $request->jenis_asrama;
        $asrama->lokasi_asrama = $request->lokasi_asrama;
        $save = $asrama->save();

        if($save) {
            return redirect()->back()->with('success','Anda berhasil menambahkan data asrama.');
        }else{
            return redirect()->back()->with('fail', 'Proses simpan gagal, silakan perhatikan format yang diminta.');
        }
    }
}
