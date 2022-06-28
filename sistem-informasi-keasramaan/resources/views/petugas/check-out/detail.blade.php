@extends('petugas.layouts.main')

@section('title')
    <title>Portal Petugas</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('petugas.check-out') }}"><span class="text-gray-600">Daftar Request Check Out Mahasiswa / </a>Detail Check Out Mahasiswa</span>
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-2">
    </div>
@endsection

@section('table')
    @if (Session::get('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert">
            <span class="font-medium font-poppins">{{ Session::get('success') }}</span>
        </div>
    @endif

    @if (Session::get('fail'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            <span class="font-medium font-poppins">{{ Session::get('fail') }}</span>
        </div>
    @endif

    <p class="font-poppins font-normal text-lg py-2">Detail Check Out</p>
    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">

        <table class="min-w-max w-full table-auto">

            {{-- @foreach ($detailReqCheckIn as $key => $data) --}}
                <tbody class="text-gray-600 text-sm">
                    <tr class="border-b bg-slate-200 border-gray-200 ">
                        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins font-bold">
                            Nama Mahasiswa
    </div>
    </td>
    <td class="py-3 px-6 text-left">
        <div class="flex items-center">
            <span class="font-poppins">
                {{ ucwords($dataCheckOut->isAnyMahasiswa->nama) }}
            </span>
        </div>
    </td>
    </tr>

    <tr class="border-b border-gray-200 ">
        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins font-bold">
            NIM Mahasiswa
        </td>
        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins">
            {{ $dataCheckOut->isAnyMahasiswa->nim }}
        </td>
    </tr>

    <tr class="border-b bg-slate-200 border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Angkatan
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ $dataCheckOut->isAnyMahasiswa->angkatan }}
        </td>
    </tr>

    <tr class="border-b border-gray-200">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Program Studi
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ Str::of($dataCheckOut->isAnyMahasiswa->prodi)->upper()->explode('_')->implode(' ') }}
        </td>
    </tr>

    <tr class="border-b bg-slate-200 bg-slate-200border-gray-100 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Asrama Asal Check In
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ $dataCheckOut->nama_asrama }}
        </td>
    </tr>


    {{-- <tr class="border-b border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Tanggal Check In
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ \Carbon\Carbon::parse($dataCheckOut->tanggal_check_in)->isoFormat('DD MMMM YYYY H:mm') }}
        </td>
    </tr> --}}

    <tr class="border-b  border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Tanggal Check Out
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ \Carbon\Carbon::parse($dataCheckOut->tanggal_check_out)->isoFormat('DD MMMM YYYY H:mm') }}
        </td>
    </tr>

    <tr class="border-b bg-slate-200 border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Keperluan Check Out
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ $dataCheckOut->keperluan }}
        </td>
    </tr>

    <tr class="border-b border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            Status Request
        </td>

        <td class="py-3 px-6 text-center font-poppins">
            @if ($dataCheckOut->status_request == null)
                <div class="flex">
                    <span class="font-poppins bg-yellow-300 text-dark font-semibold py-1 px-3 rounded text-xs">
                        Menunggu Persetujuan
                    </span>
                </div>
            @elseif ($dataCheckOut->status_request == 1)
                <div class="flex">
                    <span class="font-poppins bg-green-700 text-slate-50 py-1 px-3 rounded text-xs">
                        Disetujui
                    </span>
                </div>
            @elseif ($dataCheckOut->status_request == 2)
                <div class="flex">
                    <span class="font-poppins bg-red-500 text-slate-50 py-1 px-3 rounded text-xs">
                        Ditolak
                    </span>
                </div>
            @endif
        </td>
    </tr>

    <tr class="border-b bg-slate-200 border-gray-200 ">
        <td class="py-3 px-6 text-left font-poppins font-bold">
            @if ($dataCheckOut->status_request == 1)
                Disetujui oleh
            @elseif($dataCheckOut->status_request == 2)
                Ditolak oleh
            @else
                Membutuhkan konfirmasi
            @endif
        </td>

        <td class="py-3 px-6 text-left font-poppins">
            {{ !empty($dataCheckOut->isAnyPetugas->nama) ? $dataCheckOut->isAnyPetugas->nama : ' ' }}
            {{-- {{ Auth::guard('petugas')->user()->nama }} --}}
        </td>
    </tr>

    </tbody>
    {{-- @endforeach --}}

    </div>
    </table>

    </div>

    <a href="{{ route('petugas.reject.check-out', $dataCheckOut->id) }}">
        <button type="button"
            class="font-poppins text-white bg-red-700 focus:ring-4 focus:outline-none 
            focus:ring-red-300 font-normal rounded-lg text-sm px-3 py-2 text-center inline-flex items-center mr-2.5">
            <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" id="icon-cross" viewBox="0 0 32 32">
                <path
                    d="M31.708 25.708c-0-0-0-0-0-0l-9.708-9.708 9.708-9.708c0-0 0-0 0-0 0.105-0.105 0.18-0.227 0.229-0.357 0.133-0.356 0.057-0.771-0.229-1.057l-4.586-4.586c-0.286-0.286-0.702-0.361-1.057-0.229-0.13 0.048-0.252 0.124-0.357 0.228 0 0-0 0-0 0l-9.708 9.708-9.708-9.708c-0-0-0-0-0-0-0.105-0.104-0.227-0.18-0.357-0.228-0.356-0.133-0.771-0.057-1.057 0.229l-4.586 4.586c-0.286 0.286-0.361 0.702-0.229 1.057 0.049 0.13 0.124 0.252 0.229 0.357 0 0 0 0 0 0l9.708 9.708-9.708 9.708c-0 0-0 0-0 0-0.104 0.105-0.18 0.227-0.229 0.357-0.133 0.355-0.057 0.771 0.229 1.057l4.586 4.586c0.286 0.286 0.702 0.361 1.057 0.229 0.13-0.049 0.252-0.124 0.357-0.229 0-0 0-0 0-0l9.708-9.708 9.708 9.708c0 0 0 0 0 0 0.105 0.105 0.227 0.18 0.357 0.229 0.356 0.133 0.771 0.057 1.057-0.229l4.586-4.586c0.286-0.286 0.362-0.702 0.229-1.057-0.049-0.13-0.124-0.252-0.229-0.357z">
                </path>
            </svg>
            Tolak
        </button>
    </a>

    <a href="{{ route('petugas.accept.check-out', $dataCheckOut->id) }}">
        <button type="button"
            class="font-poppins text-white bg-login focus:ring-4 
            focus:outline-none focus:ring-blue-300 font-normal rounded-lg text-sm px-3 
            py-2 text-center inline-flex items-center mr-2.5 mb-3">
            <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" id="icon-checkmark" viewBox="0 0 32 32">
                <path d="M27 4l-15 15-7-7-5 5 12 12 20-20z"></path>
            </svg>
            Terima
        </button>
    </a>
@endsection
