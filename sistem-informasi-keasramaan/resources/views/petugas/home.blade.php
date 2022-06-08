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
        <h5 class="mb-2 text-2xl font-poppins font-bold text-slate-900 ">Hai{nama}, Anda bertugas di {lokasi_bertugas}.</h5>
        <p class="mb-0 text-base text-slate-900 sm:text-lg font-poppins py-2.5">{jumlah mahasiswa}</p>
        <div class="justify-center items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
        </div>
        <div class="flex flex-row py-10">
            <div class="bg-asramaLaki h-10 w-10"></div>
            <h1 class="font-poppins text-lg ml-2.5 py-1.5">{jumlah} Asrama Laki-laki</h1>
        </div>
        <div class="flex flex-row py-1.5">
            <div class="bg-asramaPerempuan h-10 w-10"></div>
            <h1 class="font-poppins text-lg ml-2.5 py-1.5">{jumlah} Asrama Perempuan</h1>
        </div>
    </div>

    <div class="p-4 mt-4 w-full text-center bg-white rounded-lg border shadow-md sm:p-8">
        <h5 class="mb-2 text-xl text-left font-poppins font-bold text-slate-900 ">Asrama di IT DEL</h5>
    </div>
    
@endsection
