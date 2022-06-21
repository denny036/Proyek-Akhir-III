@extends('mahasiswa.layouts.main')

@section('title')
    <title>Portal Mahasiswa</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    Home
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-6">
        <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5">
            <div class="space-y-2">
                <p class="text-lg text-gray-600 uppercase font-semibold font-poppins">
                    {{ $getDataMahasiswa->nama_asrama ?? 'Asrama NULL' }}
                </p>
                <div class="flex items-center space-x-2">
                    <h1 class="text-lg font-semibold font-poppins">
                        {{ $totalMahasiswaAsrama->Total ?? 'Belum Memiliki Asrama' }}
                        <span class="text-base font-normal font-poppins md:text-sm">mahasiswa</span>
                    </h1>
                    {{-- <p class="text-xs bg-green-50 text-green-500 px-1 rounded">+4.5</p> --}}
                </div>
            </div>
            <svg class="w-12 h-12 text-gray-300" id="icon-home" fill="none" stroke="currentColor" viewBox="0 0 32 32">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M32 18.451l-16-12.42-16 12.42v-5.064l16-12.42 16 12.42zM28 18v12h-8v-8h-8v8h-8v-12l12-9z"></path>
            </svg>

        </div>

        <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5">
            <div class="space-y-2">
                <p class="text-lg text-gray-600 uppercase font-semibold font-poppins">Petugas</p>
                <div class="flex items-center space-x-2">
                    <h1 class="text-xl font-semibold">
                        {{ $totalPetugasByAsrama->TotalPetugas ?? 'Belum memiliki petugas'}}
                        <span class="text-base font-normal font-poppins md:text-sm">orang petugas</span>
                    </h1>
                </div>
            </div>
            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
        </div>

    </div>
@endsection

@section('table')
    <div class="bg-neutral-100 text-base font-poppins">
        <h1 class="text-base font-poppins text-gray-600 font-semibold">
            Daftar Penghuni
        </h1>
    </div>
    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">

        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">NIM</th>
                    <th class="py-3 px-6 text-center">Prodi</th>
                    <th class="py-3 px-6 text-center">Angkatan</th>
                </tr>
            </thead>
            @foreach ($dataPenghuniAsrama as $key => $value)
                <tbody class="text-gray-600 text-sm">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins">
                            {{ $value->nama }}
    </div>
    </td>
    <td class="py-3 px-6 text-left">
        <div class="flex items-center">
            <span class="font-poppins">
                {{ $value->nim }}
            </span>
        </div>
    </td>
    <td class="py-3 px-6 text-center font-poppins">
        {{ Str::of($value->prodi)->upper()->explode('_')->implode(' ') }}
    </td>
    <td class="py-3 px-6 text-center">
        <span class="font-poppins">
            {{ $value->angkatan }}
        </span>
    </td>
    </tr>
    </tbody>
    @endforeach

    </div>
    </table>
    <div class="row">
        <div class="col-md-12">
            {{ $dataPenghuniAsrama->links('pagination::tailwind') }}
        </div>
    </div>

    </div>
@endsection
