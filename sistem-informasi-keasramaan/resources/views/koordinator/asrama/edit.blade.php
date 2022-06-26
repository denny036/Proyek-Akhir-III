@extends('koordinator.layouts.main')

@section('title')
    <title>Portal Koordinator</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('koordinator.show.asrama') }}"><span class="text-gray-600">Data Asrama / </a></span>Edit
    Data Asrama
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-4">
    </div>
@endsection

@section('table')
    <div class="h-screen flex justify-start w-full">
        <form action="{{ route('koordinator.update.data-asrama', $asrama->id) }}" method="POST">
            @method('PUT')
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
                    <h1 class="text-center text-2xl font-semibold text-gray-600 font-poppins">Edit Data Asrama</h1>
                    <div>
                        <label for="nama_asrama" class="block mb-1 text-gray-600 font-semibold font-poppins">Nama
                            Asrama</label>
                        <input type="text" name="nama_asrama"
                            class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins"
                            value="{{ $asrama->nama_asrama }}">
                        <span class="text-red-800 text-sm font-poppins">
                            @error('nama_asrama')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div>
                        <label for="jenis_asrama" class="block mb-1 text-gray-600 font-semibold font-poppins">Jenis
                            Asrama</label>
                        <select name="jenis_asrama" id="jenis_asrama"
                            class="bg-indigo-50 border  text-gray-900 text-sm  focus:ring-blue-500 
            focus:border-blue-500 block  px-4 py-2 outline-none rounded-md w-full
                      dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500 font-poppins">

                            <option value="Pilih Jenis Asrama" disabled selected class="font-poppins">Pilih Jenis Asrama
                            </option>
                            <option class="font-poppins" value="laki-laki"
                                {{ $asrama->jenis_asrama == 'laki-laki' ? 'selected' : '' }}">Laki-Laki</option>
                            <option class="font-poppins" value="perempuan"
                                {{ $asrama->jenis_asrama == 'perempuan' ? 'selected' : '' }}">Perempuan</option>

                        </select>

                    </div>

                    <div>
                        <label for="lokasi_asrama" class="block mb-1 text-gray-600 font-semibold font-poppins">Lokasi
                            Asrama</label>
                        <select name="lokasi_asrama" id="lokasi_asrama"
                            class="bg-indigo-50 border  text-gray-900 text-sm  focus:ring-blue-500 
            focus:border-blue-500 block  px-4 py-2 outline-none rounded-md w-full
                      dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500 font-poppins">

                            <option value="Pilih Lokasi Asrama" disabled selected class="font-poppins">Pilih Lokasi Asrama
                            </option>
                            
                            <option class="font-poppins" value="Asrama Dalam Kampus"
                                {{ $asrama->lokasi_asrama == 'Asrama Dalam Kampus' ? 'selected' : '' }}">Asrama Dalam
                                Kampus</option>
                            <option class="font-poppins" value="Asrama Luar Kampus"
                                {{ $asrama->lokasi_asrama == 'Asrama Luar Kampus' ? 'selected' : '' }}">Asrama Luar Kampus
                            </option>
                        </select>
                    </div>
                </div>

                <button type="submit"
                    class="w-28 px-4 py-2 mt-4 text-sm text-center text-white 
        bg-login rounded-md hover:bg-login font-poppins">Simpan</button>

            </div>
        </form>
    </div>
@endsection
