@extends('petugas.layouts.main')

@section('title')
    <title>Portal Petugas</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('petugas.home') }}"><span class="text-gray-600">Home / </a></span>Daftar Izin Sakit Mahasiswa
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-2">
    </div>
@endsection

@section('table')
    <p class="font-poppins font-normal text-lg py-2">Daftar Request Izin Sakit Mahasiswa</p>
    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">

        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">NIM</th>
                    <th class="py-3 px-6 text-center">Mulai Istirahat</th>
                    <th class="py-3 px-6 text-center">Keterangan</th>
                    <th class="py-3 px-6 text-center">Kondisi</th>
                    <th class="py-3 px-6 text-center">Status Permohonan</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            @foreach ($daftarRequestIS as $key => $data)
                <tbody class="text-gray-600 text-sm">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins">
                            {{ $data->nama }}
    </div>
    </td>
    <td class="py-3 px-6 text-left">
        <div class="flex items-center">
            <span class="font-poppins">
                {{ $data->nim }}
            </span>
        </div>
    </td>
    <td class="py-3 px-6 text-center font-poppins">
        {{ \Carbon\Carbon::parse($data->jadwal_istirahat)->isoFormat('DD MMMM YYYY H:mm') }}
    </td>

    <td class="py-3 px-6 text-center font-poppins">
        {{ $data->keterangan }}
    </td>

    <td class="py-3 px-6 text-center font-poppins">
        @if ($data->kondisi_sakit == 1)
            <div class="flex item-center">
                <span class="font-poppins py-1 px-3 rounded-full text-sm">
                    Sakit
                </span>
            </div>
        @else
            <div class="flex item-center">
                <span class="font-poppins py-1 px-3 rounded-full text-sm">
                    Sembuh
                </span>
            </div>
        @endif
    </td>

    <td class="py-3 px-6 text-center font-poppins">
        @if ($data->status_izin == null)
            <div class="flex item-center justify-center">
                <span class="font-poppins bg-yellow-300 text-dark font-semibold py-1 px-3 rounded-full text-xs">
                    Menunggu Persetujuan
                </span>
            </div>
        @elseif ($data->status_izin == 1)
            <div class="flex item-center justify-center">
                <span class="font-poppins bg-green-700 text-slate-50 py-1 px-3 rounded-full text-xs">
                    Disetujui
                </span>
            </div>
        @elseif ($data->status_izin == 2)
            <div class="flex item-center justify-center">
                <span class="font-poppins bg-red-500 text-slate-50 py-1 px-3 rounded-full text-xs">
                    Ditolak
                </span>
            </div>
        @endif
    </td>

    <td class="py-3 px-6 text-center">
        <div class="flex item-center justify-center">
            <span class="bg-blue-500 text-slate-50 py-1 px-3 rounded-full text-xs font-poppins">
                <a href="{{ route('petugas.detail-izin-sakit', encrypt($data->id)) }}">Detail</a>
            </span>
        </div>
    </td>
    </tr>
    </tbody>
    @endforeach

    </div>
    </table>
    <div class="row">
        <div class="col-md-12">
            {{ $daftarRequestIS->links('pagination::tailwind') }}
        </div>
    </div>

    </div>
@endsection
