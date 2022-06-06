@extends('mahasiswa.layouts.main')

@section('title')
    <title>Portal Mahasiswa</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('mahasiswa.izin-bermalam') }}"><span class="text-gray-600">Izin Bermalam / </a></span>Request Izin Bermalam
@endsection

@section('statistics')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-4">
</div>
@endsection

@section('table')

<div class="h-screen flex justify-start w-full">
    <form action="{{ route('mahasiswa.store.izin-bermalam') }}" method="POST">
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
          <h1 class="text-left text-2xl font-normal text-gray-600 font-poppins">Request Izin Bermalam</h1>

          <div>
            <label for="rencana_berangkat" class="block mb-1 text-gray-600 font-semibold font-poppins">Rencana berangkat</label>
            <input type="datetime-local" name="rencana_berangkat" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins"
            value="{{ old('rencana_berangkat') }}">
            <span class="text-red-800 text-sm font-poppins">
                @error('rencana_berangkat')
                    {{ $message }} 
                @enderror
            </span>
          </div>

          <div>
            <label for="rencana_kembali" class="block mb-1 text-gray-600 font-semibold font-poppins">Rencana kembali</label>
            <input type="datetime-local" name="rencana_kembali" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins"
            value="{{ old('rencana_kembali') }}">
            <span class="text-red-800 text-sm font-poppins">
                @error('rencana_kembali')
                    {{ $message }} 
                @enderror
            </span>
          </div>

          <div>
            <label for="keperluan_ib" class="block mb-1 text-gray-600 font-semibold font-poppins">Keperluan IB</label>
            <textarea name="keperluan_ib" id="keperluan_ib" rows="4" class="bg-indigo-50 px-4 py-2 outline-none rounded-md 
            w-full font-poppins"></textarea>
            <span class="text-red-800 text-sm font-poppins">
                @error('keperluan_ib')
                    {{ $message }} 
                @enderror
            </span>
          </div>

          <div>
            <label for="tempat_tujuan" class="block mb-1 text-gray-600 font-semibold font-poppins">Tempat Tujuan</label>
            <input type="text" name="tempat_tujuan" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins"
            value="{{ old('tempat_tujuan') }}">
            <span class="text-red-800 text-sm font-poppins">
                @error('tempat_tujuan')
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