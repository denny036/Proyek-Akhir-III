@extends('koordinator.layouts.main')

@section('title')
    <title>Portal Koordinator</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('koordinator.show.data-petugas') }}"><span class="text-gray-600">Data Petugas / </a></span>Edit Petugas Asrama
@endsection

@section('statistics')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-4">
</div>
@endsection

@section('table')
    <!-- component -->
<div class="h-screen flex justify-start w-full">
    <form action="{{ route('koordinator.update.data-petugas', $petugas->id) }}" method="POST">
    @method("PUT")
    @csrf

    @if(Session::get('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        <span class="font-medium font-poppins">{{ Session::get('success') }}</span>
    </div>
    @endif

    @if(Session::get('fail'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        <span class="font-medium font-poppins">{{ Session::get('fail') }}</span>
    </div>
    @endif

      <div class="bg-white px-10 py-7 rounded-xl w-screen shadow-md max-w-lg">
        <div class="space-y-4">
          <h1 class="text-center text-2xl font-semibold text-gray-600 font-poppins">Edit Data Petugas</h1>
          <div>
            <label for="nama" class="block mb-1 text-gray-600 font-semibold font-poppins">Nama</label>
            <input type="text" name="nama" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins"
            value="{{ $petugas->nama }}">
            <span class="text-red-800 text-sm font-poppins">
                @error('nama')
                    {{ $message }} 
                @enderror
            </span>
          </div>
          <div>
            <label for="email" class="block mb-1 text-gray-600 font-semibold font-poppins">Email</label>
            <input type="email" name="email" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins"
            value="{{ $petugas->email }}">
            <span class="text-red-800 text-sm font-poppins">
                @error('email')
                    {{ $message }} 
                @enderror
            </span>
          </div>
          <div>
            <label for="password" class="block mb-1 text-gray-600 font-semibold font-poppins">Password</label>
            <input type="password" name="password" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins">
            <span class="text-red-800 text-sm font-poppins">
                @error('password')
                    {{ $message }} 
                @enderror
            </span>
          </div>

          <div>
            <label for="confirm_password" class="block mb-1 text-gray-600 font-semibold font-poppins">Konfirmasi Password</label>
            <input type="password" name="confirm_password" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins">
            <span class="text-red-800  text-sm font-poppins">
                @error('confirm_password')
                    {{ $message }} 
                @enderror
            </span>
          </div>

          <div>
            <label for="jenis_kelamin" class="block mb-1 text-gray-600 font-semibold font-poppins">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin"  class="bg-indigo-50 border  text-gray-900 text-sm  focus:ring-blue-500 
            focus:border-blue-500 block  px-4 py-2 outline-none rounded-md w-full
                      dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500 font-poppins">

                      <option value="Pilih Jenis Kelamin" disabled selected class="font-poppins">Pilih Jenis Kelamin</option>
                      <option class="font-poppins" value="laki-laki" {{ $petugas->jenis_kelamin == "laki-laki" ? "selected" : "" }}">Laki-Laki</option>
                      <option class="font-poppins" value="perempuan" {{ $petugas->jenis_kelamin == "perempuan" ? "selected" : "" }}">Perempuan</option>

            </select>
            
          </div>

          <div>
            <label for="jabatan" class="block mb-1 text-gray-600 font-semibold font-poppins">Jabatan</label>
            <select name="jabatan" id="jabatan"  class="bg-indigo-50 border 
                    text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                        dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500 font-poppins">

                <option class="font-poppins" value="Pilih Jabatan" disabled selected>Pilih Jabatan</option>                                    
                <option class="font-poppins" value="Bapak Asrama" {{ $petugas->jabatan == "Bapak Asrama" ? "selected" : ""}}>Bapak Asrama</option>
                <option class="font-poppins" value="Ibu Asrama"   {{ $petugas->jabatan == "Ibu Asrama" ? "selected" : ""}}>Ibu Asrama</option>
                <option class="font-poppins" value="Abang Asrama" {{ $petugas->jabatan == "Abang Asrama" ? "selected" : ""}}>Abang Asrama</option>
                <option class="font-poppins" value="Kakak Asrama" {{ $petugas->jabatan == "Kakak Asrama" ? "selected" : ""}}>Kakak Asrama</option>
            
            </select>
        
          </div>

          <div>
            <label for="lokasi_bertugas" class="block mb-1 text-gray-600 font-semibold font-poppins">Lokasi Bertugas</label>
                <select name="lokasi_bertugas" id="asrama"  class="bg-indigo-50 border 
                            text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                            dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500 font-poppins">
                        <option class="font-poppins" value="Pilih Lokasi Bertugas" disabled selected>Pilih Lokasi Bertugas</option>

                    @foreach ($dataAsrama as $data)
                        <option value="{{ $data->id }}" class="font-poppins">{{ $data->nama_asrama }}</option>
                    @endforeach

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