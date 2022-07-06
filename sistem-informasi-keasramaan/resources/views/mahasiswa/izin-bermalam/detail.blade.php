@extends('mahasiswa.layouts.main')

@section('title')
    <title>Portal Mahasiswa</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('mahasiswa.izin-bermalam') }}"><span class="text-gray-600">Izin Bermalam / </a></span>Data Izin
    Bermalam
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-2">
    </div>
@endsection

@section('table')
    <p class="font-poppins font-normal text-lg py-2">Detail Izin Bermalam</p>
    
    {{-- @foreach ($detailIB as $data) --}}
    @if($detailIB[0]->status == null)
    @elseif ($detailIB[0]->status == 2)
    @else
    <a href="{{ route('mahasiswa.print.surat-ib', encrypt($izinBermalamID->id)) }}">
        <button type="button"
            class="font-poppins text-white bg-login focus:ring-4 
focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3.5
py-1.5 text-center inline-flex items-center mr-2">
            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" id="icon-printer" viewBox="0 0 32 32">
                <path d="M8 2h16v4h-16v-4z"></path>
                <path
                    d="M30 8h-28c-1.1 0-2 0.9-2 2v10c0 1.1 0.9 2 2 2h6v8h16v-8h6c1.1 0 2-0.9 2-2v-10c0-1.1-0.9-2-2-2zM4 14c-1.105 0-2-0.895-2-2s0.895-2 2-2 2 0.895 2 2-0.895 2-2 2zM22 28h-12v-10h12v10z">
                </path>
            </svg>
            Print IB
        </button>
    </a>
    @endif
    {{-- @endforeach --}}

    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">

        <table class="min-w-max w-full table-auto">

            @foreach ($detailIB as $data)
                <tbody class="text-gray-600 text-sm">
                    <tr class="border-b bg-slate-200 border-gray-200 ">
                        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins font-bold">
                            Nama Mahasiswa
    </div>
    </td>
    <td class="py-3 px-6 text-left">
        <div class="flex items-center">
            <span class="font-poppins">
                {{ ucwords($data->nama) }}
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
            Rencana Berangkat
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ \Carbon\Carbon::parse($data->rencana_berangkat)->isoFormat('DD MMMM YYYY H:mm') }}
        </td>
    </tr>

    <tr class="border-b border-gray-200">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Rencana Kembali
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ \Carbon\Carbon::parse($data->rencana_kembali)->isoFormat('DD MMMM YYYY H:mm ') }}
        </td>
    </tr>

    <tr class="border-b bg-slate-200 bg-slate-200border-gray-100 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Keperluan IB
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ $data->keperluan_ib }}
        </td>
    </tr>

    <tr class="border-b border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Tempat Tujuan IB
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ $data->tempat_tujuan }}
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

    @if ($data->status == 2)
    <tr class="border-b bg-slate-200 border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
                Alasan Penolakan
        </td>
        <td class="py-3 px-6 text-left font-poppins">
            {{ ucfirst($data->alasan_tolak) }}
        </td>
    </tr>
    @endif

    </tbody>
    @endforeach

    </div>
    </table>

    </div>
@endsection
