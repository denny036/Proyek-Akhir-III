@extends('mahasiswa.layouts.main')

@section('title')
    <title>Portal Mahasiswa</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    User Profile
@endsection



@if ($nullAsrama)

@section('statistics')

<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
  <div class="relative py-3 sm:max-w-xl sm:mx-auto">
    <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
      <div class="max-w-md mx-auto">
        @if(Session::get('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" 
            role="alert">
                <span class="font-medium">{{ Session::get('success') }}</span>
            </div>
        @endif
        <div class="flex items-center space-x-5">
          <div class="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono">i</div>
          <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
            <h2 class="leading-relaxed font-poppins">Create an Event</h2>
            <p class="text-sm text-gray-500 font-normal leading-relaxed">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
          </div>
        </div>
        <div class="divide-y divide-gray-200">


          <form action="{{ route('mahasiswa.store.profile') }}" method="POST">
          <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
            <div class="flex flex-col">
              <label class="leading-loose font-poppins">Asrama</label>
              {{-- <input type="text" name="asrama" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 
              w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" 
              placeholder="Asrama"> --}}
              
              <select name="asrama" id="asrama"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
              dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 
                      dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <option value="Pilih Asrama" disabled selected>Pilih Asrama</option>

                  @foreach ($asrama as $item)
                      <option value="{{ $item->id }}" class="font-poppins">{{ $item->nama_asrama }}</option>
                  @endforeach
              </select>
            </div>
            
          </div>
          <div class="pt-4 flex items-center space-x-4">
              {{-- <button class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none">
                <svg class="w-6 h-6 mr-3" fill="none" 
                stroke="currentColor" viewBox="0 0 24 24" 
                xmlns="http://www.w3.org/2000/svg"><path 
                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Cancel
              </button> --}}
            
              
                  @csrf
                  <button class="bg-blue-500 flex justify-center 
                  items-center w-full text-white px-4 py-3 
                  rounded-md focus:outline-none font-poppins">Simpan</button>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@else
  @section('statistics')

      <!-- component -->
<div class="bg-gray-100 block py-10">
  <div class="max-w-2xl justify-start">
      <!--
          ! ------------------------------------------------------------
          ! Profile banner and avatar
          ! ------------------------------------------------------------
          !-->
      <div class="w-full">
          <div class="w-full bg-login h-10 rounded-t-lg">
            <h1 class="font-poppins p-5 pt-2 text-white">User Info</h1>
          </div>
      </div>

      <!--
          ! ------------------------------------------------------------
          ! Profile general information
          ! ------------------------------------------------------------
          !-->
      <div class="bg-primary border border-primary rounded-b-lg p-5 pt-4 flex flex-col">
        
        @foreach ($dataMahasiswa as $item)
    
          <div class="mt-0 text-gray-700">
              <div class="flex flex-row ml-auto space-x-2 items-center">
                  <div class="mb-1 h-5 w-20">
                    <h3 class="font-poppins font-bold flex flex-col">Nama</h3>
                  </div> 
                  <div class=" rounded-full h-1 w-16"></div><h3 class="font-poppins flex flex-col">{{ $item->nama }}</h3>
              </div>
          </div>

          <div class="w-full border-t border-gray-300"></div>

          <div class="mt-1 text-gray-700">
              <div class="flex flex-row ml-auto space-x-2 items-center">
                  <div class="mb-1 h-5 w-20">
                    <h3 class="font-poppins font-bold">NIM</h3>
                  </div> 
                  <div class=" rounded-full h-1 w-16"></div><h3 class="font-poppins">{{ $item->nim }}</h3>
              </div>
          </div>

          <div class="w-full border-t border-gray-300"></div>

          <div class="mt-1 text-gray-700">
              <div class="flex flex-row ml-auto space-x-2 items-center">
                  <div class="mb-1 h-5 w-20">
                    <h3 class="font-poppins font-bold">Angkatan</h3>
                  </div> 
                  <div class=" rounded-full h-1 w-16"></div>
                  <h3 class="font-poppins">
                    {{ $item->angkatan }}
                  </h3>
              </div>
          </div>

          <div class="w-full border-t border-gray-300"></div>

          <div class="mt-1 text-gray-700">
              <div class="flex flex-row ml-auto space-x-2 items-center">
                  <div class="mb-1 h-5">
                    <h3 class="font-poppins font-bold">Program Studi</h3>
                  </div> 
                  <div class=" rounded-full h-1 w-7"></div><h3 class="font-poppins"> {{ Str::of($item->prodi)->upper()->explode('_')->implode(' ')}}</h3>
              </div>
          </div>

          <div class="w-full border-t border-gray-300"></div>

          <div class="mt-1 text-gray-700">
            <div class="flex flex-row ml-auto space-x-2 items-center">
                <div class="mb-1 h-5 w-20">
                  <h3 class="font-poppins font-bold">Asrama</h3>
                </div> 
                <div class=" rounded-full h-1 w-16"></div><h3 class="font-poppins">
                  {{ $item->nama_asrama }}
                </h3>
            </div>
          </div>
          
          <div class="w-full border-t border-gray-300"></div>

          <div class="mt-1 text-gray-700">
            <div class="flex flex-row ml-auto space-x-2 items-center">
                <div class="mb-1 h-5">
                  <h3 class="font-poppins font-bold">Jenis Asrama</h3>
                </div> 
                <div class=" rounded-full h-1 w-9"></div><h3 class="font-poppins">
                  {{ $item->jenis_asrama }}
                </h3>
            </div>
          </div>

          @endforeach

      </div>
  </div>
      
  @endsection

@endif



