@extends('petugas.layouts.main')

@section('title')
    <title>Portal Petugas</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    Home
@endsection

@section('table')
    <div class="p-4 w-full text-center bg-white rounded-lg border shadow-md sm:p-8">
        <h5 class="mb-2 text-2xl font-poppins font-bold text-slate-900 ">Hai {{ $namaPetugas }}, Anda bertugas di {{ $lokasiBertugas->asrama->nama_asrama }}.</h5>
        
        <p class="mb-0 text-base text-slate-900 sm:text-lg font-poppins py-2.5">Total Mahasiswa: {{ $totalMahasiswa->Total ?? 'Asrama kosong' }} orang mahasiswa</p>
        <div class="justify-center items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
        </div>
        <div class="flex flex-row py-10">
            <div class="bg-asramaLaki h-10 w-10"></div>
            <h1 class="font-poppins text-lg ml-2.5 py-1.5">{{ $asramaLaki }} Asrama Laki-laki</h1>
        </div>
        <div class="flex flex-row py-1.5">
            <div class="bg-asramaPerempuan h-10 w-10"></div>
            <h1 class="font-poppins text-lg ml-2.5 py-1.5">{{ $asramaPerempuan }} Asrama Perempuan</h1>
        </div>
    </div>

    <div class="p-4 mt-4 w-full text-center bg-white rounded-lg border shadow-md sm:p-8">
        <h5 class="mb-2 text-xl text-left font-poppins font-bold text-slate-900 ">Asrama di IT DEL</h5>
        <div class="grid grid-cols-1 gap-4 py-6 md:grid-cols-4">
            @foreach ($getAllAsrama as $asrama)
            @if ($asrama->jenis_asrama == 'laki-laki')
                <div class="bg-asramaLaki flex items-center justify-between rounded-sm py-3.5 px-3.5">
                    <div class="space-y-2">
                        <p class="font-poppins text-lg font-semibold uppercase text-slate-50">
                            {{ $asrama->nama_asrama }}
                            {{-- {{ $getDataMahasiswa->nama_asrama ?? 'Asrama NULL' }} --}}
                        </p>
                        <div class="flex items-center space-x-2">
                            <h1 class="font-poppins text-lg font-semibold">
                                {{-- {{ $totalMahasiswaAsrama->Total ?? 'Belum Memiliki Asrama' }} --}}
                                <span class="font-poppins text-base font-normal text-slate-50 md:text-sm">
                                  
                                </span>
                            </h1>
                        </div>
                    </div>
                    <svg class="h-12 w-12 text-gray-300" id="icon-home" fill="none" stroke="currentColor"
                        viewBox="0 0 32 32">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M32 18.451l-16-12.42-16 12.42v-5.064l16-12.42 16 12.42zM28 18v12h-8v-8h-8v8h-8v-12l12-9z">
                        </path>
                    </svg>
                </div>
            @elseif($asrama->jenis_asrama == 'perempuan')
                <div class="bg-asramaPerempuan flex items-center justify-between rounded-sm py-3.5 px-3.5 shadow">
                    <div class="space-y-2">
                        <p class="font-poppins text-lg font-semibold uppercase text-slate-50">
                            {{ $asrama->nama_asrama }}
                        </p>
                        <div class="flex items-center space-x-2">
                            <h1 class="font-poppins text-lg font-semibold">

                                <span class="font-poppins text-base font-normal text-slate-50 md:text-sm">
                                   
                                </span>

                            </h1>
                            {{-- <p class="text-xs bg-green-50 text-green-500 px-1 rounded">+4.5</p> --}}
                        </div>
                    </div>
                    <svg class="h-12 w-12 text-gray-300" id="icon-home" fill="none" stroke="currentColor"
                        viewBox="0 0 32 32">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M32 18.451l-16-12.42-16 12.42v-5.064l16-12.42 16 12.42zM28 18v12h-8v-8h-8v8h-8v-12l12-9z">
                        </path>
                    </svg>
                </div>
            @endif
        @endforeach
        </div>
    </div>
    
@endsection
