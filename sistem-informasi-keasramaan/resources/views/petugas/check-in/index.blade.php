@extends('petugas.layouts.main')

@section('title')
    <title>Portal Petugas</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('petugas.home') }}"><span class="text-gray-600">Home / </a></span>Daftar Check In Mahasiswa
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-2">
    </div>
@endsection

@section('table')
    @if (Session::get('success-check-in'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert">
            <span class="font-medium font-poppins">{{ Session::get('success-check-in') }}</span>
        </div>
    @endif

    @if (Session::get('fail-check-in'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            <span class="font-medium font-poppins">{{ Session::get('fail-check-in') }}</span>
        </div>
    @endif
    <p class="font-poppins font-normal text-lg py-2">Daftar Request Check In Mahasiswa</p>
    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">

        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">NIM</th>
                    <th class="py-3 px-6 text-center">Asrama Asal</th>
                    <th class="py-3 px-6 text-center">Asrama Tujuan</th>
                    <th class="py-3 px-6 text-center">Tanggal Check In</th>
                    <th class="py-3 px-6 text-center">Status Permohonan</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            @foreach ($daftarRequestCheckIn as $data)
                <tbody class="text-gray-600 text-sm">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins">
                            {{ $data->isMahasiswa->nama }}
    </div>
    </td>

    <td class="py-3 px-6 text-left">
        <div class="flex items-center">
            <span class="font-poppins">
                {{ $data->isMahasiswa->nim }}
            </span>
        </div>
    </td>

    {{-- Asrama Asal --}}
    <td class="py-3 px-6 text-center font-poppins">
        {{ $data->nama_asrama }}
    </td>

    <td class="py-3 px-6 text-center font-poppins">
        {{ $data->toAsrama->nama_asrama }}
    </td>

    <td class="py-3 px-6 text-center font-poppins">
        {{ \Carbon\Carbon::parse($data->tanggal_check_in)->isoFormat('DD MMMM YYYY H:mm') }}
    </td>

    <td class="py-3 px-6 text-center font-poppins">
        @if ($data->status_request == null)
            <div class="flex item-center justify-center">
                <span class="font-poppins bg-yellow-300 text-dark font-semibold py-1 px-3 rounded-full text-xs">
                    Menunggu Persetujuan
                </span>
            </div>
        @elseif ($data->status_request == 1)
            <div class="flex item-center justify-center">
                <span class="font-poppins bg-green-700 text-slate-50 py-1 px-3 rounded-full text-xs">
                    Disetujui
                </span>
            </div>
        @elseif ($data->status_request == 2)
            <div class="flex item-center justify-center">
                <span class="font-poppins bg-red-500 text-slate-50 py-1 px-3 rounded-full text-xs">
                    Ditolak
                </span>
            </div>
        @endif
    </td>

    <td class="py-3 px-6 text-center">
        <div class="flex item-center justify-center">
            <span class="bg-blue-500 text-slate-50 py-1 px-3 rounded-full text-xs font-poppins">
                <a href="{{ route('petugas.detail-check-in', $data->id) }}">Detail</a>
                {{-- {{ dd($data) }} --}}
            </span>
        </div>
    </td>
    </tr>
    </tbody>
    @endforeach

    </div>
    </table>
    <div class="row">
        <div class="col-md-12">
            {{ $daftarRequestCheckIn->links('pagination::tailwind') }}
        </div>
    </div>

    </div>
@endsection
