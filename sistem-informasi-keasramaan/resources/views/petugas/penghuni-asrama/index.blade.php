@extends('petugas.layouts.main')

@section('title')
    <title>Portal Petugas</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    Data Penghuni Asrama
@endsection

@section('statistics')
    <div class="flex flex-row py-2">
        <div class="bg-asramaLaki h-6 w-6"></div>
        <h1 class="font-poppins ml-3">Asrama Laki-laki</h1>
    </div>
    <div class="flex flex-row py-2">
        <div class="bg-asramaPerempuan h-6 w-6"></div>
        <h1 class="font-poppins ml-3">Asrama Perempuan</h1>
    </div>

    <div class="grid grid-cols-1 gap-4 py-6 md:grid-cols-4">

        @foreach ($getAllAsrama as $allAsrama)
            @if ($allAsrama->jenis_asrama == 'laki-laki')
                <div class="bg-asramaLaki flex items-center justify-between rounded-sm py-3.5 px-3.5">
                    <div class="space-y-2">
                        <p class="font-poppins text-lg font-semibold uppercase text-slate-50">
                            {{ $allAsrama->nama_asrama }}
                            {{-- {{ $getDataMahasiswa->nama_asrama ?? 'Asrama NULL' }} --}}
                        </p>
                        <div class="flex items-center space-x-2">
                            <h1 class="font-poppins text-lg font-semibold">
                                {{-- {{ $totalMahasiswaAsrama->Total ?? 'Belum Memiliki Asrama' }} --}}
                                <span class="font-poppins text-base font-normal text-slate-50 md:text-sm">
                                    <a href="{{ route('petugas.detail.penghuni-asrama', encrypt($allAsrama->id)) }}"
                                        class="underline">Lihat</a>
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
            @elseif($allAsrama->jenis_asrama == 'perempuan')
                <div class="bg-asramaPerempuan flex items-center justify-between rounded-sm py-3.5 px-3.5 shadow">
                    <div class="space-y-2">
                        <p class="font-poppins text-lg font-semibold uppercase text-slate-50">
                            {{ $allAsrama->nama_asrama }}
                        </p>
                        <div class="flex items-center space-x-2">
                            <h1 class="font-poppins text-lg font-semibold">

                                <span class="font-poppins text-base font-normal text-slate-50 md:text-sm">
                                    <a href="{{ route('petugas.detail.penghuni-asrama', encrypt($allAsrama->id)) }}"
                                        class="underline">Lihat</a>
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
@endsection

{{-- <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5">
    <div class="space-y-2">
        <p class="text-lg text-gray-600 uppercase font-semibold font-poppins">Petugas</p>
        <div class="flex items-center space-x-2">
            <h1 class="text-xl font-semibold">819</h1>
        </div>
    </div>
    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>                    
</div> --}}
