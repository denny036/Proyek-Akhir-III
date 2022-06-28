@extends('petugas.layouts.main')

@section('title')
    <title>Portal Petugas</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('petugas.home') }}"><span class="text-gray-600">Home / </a></span>Data Petugas
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-2">
    </div>
@endsection

@section('table')
    {{-- <a href="{{ route('mahasiswa.request.izin-bermalam') }}"> --}}
    <p class="font-poppins font-normal text-lg py-2">Daftar Petugas Asrama &mdash; Institut Teknologi Del</p>
    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">

        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">Jenis Kelamin</th>
                    <th class="py-3 px-6 text-center">Jabatan</th>
                    <th class="py-3 px-6 text-center">Lokasi Bertugas</th>
                </tr>
            </thead>
            @foreach ($dataPetugas as $lists)
                <tbody class="text-gray-600 text-sm">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins">
                            {{ ucwords($lists->nama) }}
    </div>
    </td>
    <td class="py-3 px-6 text-left">
        <div class="flex items-center">
            <span class="font-poppins">
                {{ Str::of($lists->jenis_kelamin)->ucfirst()->explode('_')->implode(' ') }}
            </span>
        </div>
    </td>
    <td class="py-3 px-6 text-center font-poppins">
        {{ $lists->jabatan }}
    </td>

    <td class="py-3 px-6 text-center font-poppins">
        {{ $lists->asrama->nama_asrama }}
    </td>

    </tr>
    </tbody>
    @endforeach

    </div>
    </table>
    <div class="row">
        <div class="col-md-12">
            {{ $dataPetugas->links('pagination::tailwind') }}
        </div>
    </div>

    </div>
@endsection
