@extends('mahasiswa.layouts.main')

@section('title')
    <title>Portal Mahasiswa</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('mahasiswa.izin-sakit') }}"><span class="text-gray-600">Izin Sakit / </a></span>Request Izin
    Sakit
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-4">
    </div>
@endsection

@section('table')
    <div class="h-screen flex justify-start w-full">
        <form action="{{ route('mahasiswa.store.izin-sakit') }}" method="POST" enctype="multipart/form-data">
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
                    <h1 class="text-left text-2xl font-normal text-gray-600 font-poppins">Request Izin Sakit</h1>

                    <div>
                        <label for="asrama_mahasiswa" class="block mb-1 text-gray-600 font-semibold font-poppins">Asrama</label>
                        <input type="text" name="asrama_mahasiswa"
                            class="bg-indigo-50 opacity-70 px-4 py-2 outline-none rounded-md w-full font-poppins"
                            value="{{ $dataMahasiswa->nama_asrama }}" disabled>
                    </div>

                    <div>
                        <label for="jadwal_istirahat" class="block mb-1 text-gray-600 font-semibold font-poppins">Mulai istirahat</label>
                        <input type="datetime-local" name="jadwal_istirahat"
                            class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins"
                            value="{{ old('jadwal_istirahat') }}">
                        <span class="text-red-800 text-sm font-poppins">
                            @error('jadwal_istirahat')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div>
                        <label for="keterangan" class="block mb-1 text-gray-600 font-semibold font-poppins">Keterangan
                            Izin Sakit</label>
                        <textarea name="keterangan" id="keterangan" rows="4"
                            class="bg-indigo-50 px-4 py-2 outline-none rounded-md 
            w-full font-poppins"></textarea>
                        <span class="text-red-800 text-sm font-poppins">
                            @error('keterangan')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div>
                        <label for="surat_sakit" class="block mb-1 text-gray-600 font-semibold font-poppins">Lampiran Surat Sakit
                            </label>
                        <input type="file" name="surat_sakit"
                            class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full cursor-pointer font-poppins"
                            value="{{ old('surat_sakit') }}">
                            <p class="italic mt-1 text-xs text-black font-poppins">Silakan lampirkan surat keterangan sakit dari dokter jika ada.</p>
                        <span class="text-red-800 text-sm font-poppins">
                            @error('surat_sakit')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                </div>

                <button type="submit"
                    class="w-28 px-4 py-2 mt-4 text-sm text-center text-white 
        bg-login rounded-md hover:bg-login font-poppins">Simpan</button>
            </div>
        </form>
    </div>
@endsection
