@extends('mahasiswa.layouts.main')

@section('title')
    <title>Portal Mahasiswa</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('mahasiswa.show.check-out') }}"><span class="text-gray-600">Data Check Out / </a></span>Request Check Out
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-6">
    </div>
@endsection

@section('table')
    <!-- component -->
    <div class="h-screen flex justify-start w-full">
        <form action="{{ route('mahasiswa.store.check-out') }}" method="POST">
            @csrf
            
            @if (Session::get('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                    role="alert">
                    <span class="font-medium font-poppins">{{ Session::get('success') }}</span>
                </div>
            @endif

            @if (Session::get('fail'))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                    role="alert">
                    <span class="font-medium font-poppins">{{ Session::get('fail') }}</span>
                </div>
            @endif

            <div class="bg-white px-10 py-7 rounded-xl w-screen shadow-md max-w-lg">
                <div class="space-y-4">
                    <h1 class="text-center text-2xl font-semibold text-gray-600 font-poppins">Request Check Out</h1>
                    <div>
                        <label for="nama" class="block mb-1 text-gray-600 font-semibold font-poppins">Nama</label>
                        <input type="text" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins"
                            value="{{ ucwords($dataMahasiswa->nama) }}" disabled />
                    </div>
                    
                    <div>
                        <label for="nim" class="block mb-1 text-gray-600 font-semibold font-poppins">NIM</label>
                        <input type="text" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins"
                            value="{{ $dataMahasiswa->nim }}" disabled />
                    </div>
                    
                    <div>
                        <label for="angkatan" class="block mb-1 text-gray-600 font-semibold font-poppins">Angkatan</label>
                        <input type="text" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins"
                            value="{{ $dataMahasiswa->angkatan }}" disabled />
                    </div>

                    <div>
                        <label for="asal_asrama" class="block mb-1 text-gray-600 font-semibold font-poppins">Asal
                            Asrama Check In</label>
                        <input type="text" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins"
                            value="{{ $dataMahasiswa->nama_asrama }}" disabled />
                    </div>

                    <div>
                        <label for="tanggal_check_out" class="block mb-1 text-gray-600 font-semibold font-poppins">Tanggal
                            Check Out</label>
                        <input type="datetime-local" name="tanggal_check_out"
                            class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins" />
                    </div>

                    <div>
                        <label for="keperluan" class="block mb-1 text-gray-600 font-semibold font-poppins">Keperluan</label>
                        <textarea id="keperluan" name="keperluan" rows="4"
                            class="bg-indigo-50 
                px-4 py-2 outline-none rounded-md w-full text-sm font-poppins">
                </textarea>
                    </div>


                </div>

                <button type="submit"
                    class="w-28 px-4 py-2 mt-4 text-sm text-center text-white 
        bg-login rounded-md hover:bg-login font-poppins">Kirim</button>

            </div>
        </form>
    </div>
@endsection
