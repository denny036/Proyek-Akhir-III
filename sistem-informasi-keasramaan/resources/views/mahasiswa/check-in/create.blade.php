@extends('mahasiswa.layouts.main')

@section('title')
    <title>Portal Mahasiswa</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('mahasiswa.show.check-in') }}"><span class="text-gray-600">Data Check In / </a></span>Request Check In
@endsection

@section('statistics')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-6">
</div>
@endsection

@section('table')
    <!-- component -->
<div class="h-screen flex justify-start w-full">
    <form action="#" method="POST">
    @csrf
      <div class="bg-white px-10 py-7 rounded-xl w-screen shadow-md max-w-lg">
        <div class="space-y-4">
          <h1 class="text-center text-2xl font-semibold text-gray-600 font-poppins">Request Check In</h1>
          <div>
            <label for="nim" class="block mb-1 text-gray-600 font-semibold font-poppins">NIM</label>
            <input type="text" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins" value="{{ $dataMahasiswa->nim }}" disabled />
          </div>
          <div>
            <label for="nama" class="block mb-1 text-gray-600 font-semibold font-poppins">Nama</label>
            <input type="text" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins" value="{{ $dataMahasiswa->nama }}" disabled/>
          </div>
          <div>
            <label for="angkatan" class="block mb-1 text-gray-600 font-semibold font-poppins">Angkatan</label>
            <input type="text" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins" value="{{ $dataMahasiswa->angkatan }}" disabled />
          </div>

          <div>
            <label for="asal_asrama" class="block mb-1 text-gray-600 font-semibold font-poppins">Asal Asrama</label>
            <input type="text" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full font-poppins" value="{{ $dataMahasiswa->nama_asrama }}" disabled/>
          </div>

          <div>
            <label for="asrama_tujuan" class="block mb-1 text-gray-600 font-semibold font-poppins">Asrama Tujuan</label>
            <select name="asrama" id="asrama"  class="bg-indigo-50 border  text-gray-900 text-sm  focus:ring-blue-500 
            focus:border-blue-500 block  px-4 py-2 outline-none rounded-md w-full
                      dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500 font-poppins">

                      <option value="Pilih Asrama" disabled selected class="font-poppins">Pilih Asrama</option>

                  @foreach ($dataAsrama as $item)
                      <option value="{{ $item->id }}" class="font-poppins">{{ $item->nama_asrama }}</option>
                  @endforeach

            </select>
            
          </div>

          <div>
            <label for="keperluan" class="block mb-1 text-gray-600 font-semibold font-poppins">Keperluan</label>
                <textarea id="keperluan" name="keperluan" rows="4" class="bg-indigo-50 
                px-4 py-2 outline-none rounded-md w-full text-sm font-poppins">
                </textarea>
          </div>
          
          <div>
            <label for="tanggal_check_in" class="block mb-1 text-gray-600 font-semibold font-poppins">Tanggal Check In</label>
            <input type="datetime-local" name="tanggal_check_in" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full" />
          </div>
        </div>
        
        <button type="submit"
        class="w-28 px-4 py-2 mt-4 text-sm text-center text-white 
        bg-login rounded-md hover:bg-login font-poppins">Kirim</button>

      </div>
    </form>
  </div>
@endsection