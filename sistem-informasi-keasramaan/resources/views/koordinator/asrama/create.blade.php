@extends('koordinator.layouts.main')

@section('title')
    <title>Portal Koordinator</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('koordinator.show.asrama') }}"><span class="text-gray-600">Data Asrama / </a></span>Tambah Data Asrama
@endsection

@section('statistics')
<div class="bg-gray-100 py-6 flex flex-col justify-start sm:py-12">
    <div
      class="relative px-4 py-10 bg-white w-1/3 mx-8 md:mx-0 shadow rounded-2xl sm:p-4 sm:w-96 sm:ml-3">
      
      <form action="{{ route('koordinator.store.asrama') }}" method="POST">
        @csrf

        @if(Session::get('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            <span class="font-medium">{{ Session::get('success') }}</span>
        </div>
        @endif

        @if(Session::get('fail'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            <span class="font-medium">{{ Session::get('fail') }}</span>
        </div>
        @endif
        
        <span class="font-poppins font-bold"><h1>Data Asrama Baru</h1></span>
            <div class="py-5">
                <div class="mt-1 max-w-md">
                    <div class="grid grid-cols-1 gap-2">
                        
                        <label class="block">
                        <span class="text-gray-700 font-poppins">Nama Asrama</span>
                        <input
                            type="text" name="nama_asrama"
                            class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 font-poppins"
                            placeholder="" value="{{ old('nama_asrama') }}"
                        />
                        <span class="text-red-800 text-sm">
                            @error('nama_asrama')
                                {{ $message }} 
                            @enderror
                        </span>
                        </label>
                        
                        <label class="block">
                        <span class="text-gray-700 font-poppins">Jenis Asrama</span>
                        <select
                            class="block w-full mt-1 rounded-md bg-gray-100 border-transparent focus:border-gray-500 
                            focus:bg-white focus:ring-0 font-poppins" name="jenis_asrama"
                        >
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <span class="text-red-800 text-sm">
                            @error('jenis_asrama')
                                {{ $message }} 
                            @enderror
                        </span>
                        </label>

                        <label class="block">
                        <span class="text-gray-700 font-poppins">Lokasi Asrama</span>
                        <select
                            class="block w-full mt-1 rounded-md bg-gray-100 border-transparent focus:border-gray-500 
                            focus:bg-white focus:ring-0 font-poppins" name="lokasi_asrama"
                        >
                            <option value="Asrama Luar Kampus">Asrama Luar Kampus</option>
                            <option value="Asrama Dalam Kampus">Asrama Dalam Kampus</option>
                        </select>
                        <span class="text-red-800 text-sm">
                            @error('lokasi_asrama')
                                {{ $message }} 
                            @enderror
                        </span>
                        </label>

                        <div class="block">
                            <div class="mt-2">
                                <div>
                                    <button type="submit"
                                            class="w-28 px-4 py-2 mt-4 text-sm text-center text-white 
                                            bg-login rounded-md hover:bg-login font-poppins">Simpan</button>
                                    {{-- <button type="reset"
                                    class="w-28 px-4 py-2 mt-4 text-sm text-center text-white bg-red-600 rounded-md 
                                    hover:bg-red-700">Cancel</button> --}}
                                        
                                    {{-- <span class="ml-2">
                                        <button type="submit"
                                            class="w-28 px-4 py-2 mt-4 text-sm text-center text-white 
                                            bg-login rounded-md hover:bg-login">
                                            Simpan
                                        </button>
                                    </span> --}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        
    </div>
</div>
  

@endsection