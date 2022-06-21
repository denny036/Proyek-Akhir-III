@extends('mahasiswa.layouts.main')

@section('title')
    <title>Portal Mahasiswa</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('mahasiswa.izin-sakit') }}"><span class="text-gray-600">Izin Sakit / </a></span>Data Izin
    Sakit
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-2">
    </div>
@endsection

@section('table')
    <p class="font-poppins font-normal text-lg py-2">Data Izin Sakit</p>

    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">

        <table class="min-w-max w-full table-auto">

            @foreach ($detailIS as $data)
                <tbody class="text-gray-600 text-sm">
                    <tr class="border-b bg-slate-200 border-gray-200 ">
                        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins font-bold">
                            Nama Mahasiswa
    </div>
    </td>
    <td class="py-3 px-6 text-left">
        <div class="flex items-center">
            <span class="font-poppins">
                {{ $data->nama }}
            </span>
        </div>
    </td>
    </tr>

    <tr class="border-b border-gray-200 ">
        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins font-bold">
            NIM Mahasiswa
        </td>
        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins">
            {{ $data->nim }}
        </td>
    </tr>

    <tr class="border-b bg-slate-200 border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Mulai Istirahat
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ \Carbon\Carbon::parse($data->jadwal_istirahat)->isoFormat('DD MMMM YYYY H:mm') }}
        </td>
    </tr>

    <tr class="border-b border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Kondisi
        </td>

        <td class="py-3 px-3 text-center font-poppins">
            @if ($data->kondisi_sakit == 1)
                <div class="flex">
                    <span class="font-poppins py-1 px-3 rounded text-sm">
                        Sakit
                    </span>
                </div>
            @else
                <div class="flex">
                    <span class="font-poppins py-1 px-3 rounded text-sm">
                        Sembuh
                    </span>
                </div>
            @endif
        </td>
    </tr>

    <tr class="border-b bg-slate-200 bg-slate-200border-gray-100 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Keterangan
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ $data->keterangan }}
        </td>
    </tr>

    <tr class="border-b border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Surat Sakit (*jika ada)
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            @if($data->surat_sakit) 
            <img src="{{ asset('uploads/surat-sakit/' . $data->surat_sakit) }}" class="w-32 rounded-full" alt="Surat Sakit">
            @else
            <p class="font-semibold">Anda tidak memiliki surat sakit</p>
            @endif
        </td>
    </tr>

    <tr class="border-b bg-slate-200 border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Status Request
        </td>

        <td class="py-3 px-6 text-center font-poppins">
            @if ($data->status == null)
                <div class="flex">
                    <span class="font-poppins bg-yellow-300 text-dark font-semibold py-1 px-3 rounded text-xs">
                        Menunggu Persetujuan
                    </span>
                </div>
            @elseif ($data->status == 1)
                <div class="flex">
                    <span class="font-poppins bg-green-700 text-slate-50 py-1 px-3 rounded text-xs">
                        Disetujui
                    </span>
                </div>
            @elseif ($data->status == 2)
                <div class="flex">
                    <span class="font-poppins bg-red-500 text-slate-50 py-1 px-3 rounded text-xs">
                        Ditolak
                    </span>
                </div>
            @endif
        </td>
    </tr>

    <tr class="border-b border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            @if ($data->status == 1)
                Disetujui oleh
            @elseif($data->status == 2)
                Ditolak oleh
            @else
                Membutuhkan konfirmasi
            @endif
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ !empty($data->petugas->nama) ? $data->petugas->nama : 'Pengurus Asrama' }}
        </td>
    </tr>

    </tbody>
    @endforeach

    </div>
    </table>

    </div>
@endsection
