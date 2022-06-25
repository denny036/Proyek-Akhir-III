@extends('mahasiswa.layouts.main')

@section('title')
    <title>Portal Mahasiswa</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('mahasiswa.home') }}"><span class="text-gray-600">Home / </a></span>Check In
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-2">
    </div>
@endsection

@section('table')
    <a href="{{ route('mahasiswa.request.check-in') }}">
        <button type="button"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 
    focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 
    dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 font-poppins">Request
            Check In</button></a>

    <p class="font-poppins font-normal text-lg py-2">Request sebelumnya</p>
    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">

        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Status Permohonan</th>
                    <th class="py-3 px-6 text-left">Oleh</th>
                    <th class="py-3 px-6 text-center">Tanggal Check In</th>
                    <th class="py-3 px-6 text-left">Asrama Tujuan</th>
                    <th class="py-3 px-6 text-center">Keperluan</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            @foreach ($riwayatCheckIn as $key => $data)
                <tbody class="text-gray-600 text-sm">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">

                        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins">
                            @if ($data->status_request == null)
                                <div class="flex item-center">
                                    <span
                                        class="font-poppins bg-yellow-300 text-dark font-semibold py-1 px-3 rounded-full text-xs">
                                        Menunggu Persetujuan
                                    </span>
                                </div>
                            @elseif ($data->status_request == 1)
                                <div class="flex item-center">
                                    <span class="font-poppins bg-green-700 text-slate-50 py-1 px-3 rounded-full text-xs">
                                        Disetujui
                                    </span>
                                </div>
                            @elseif ($data->status_request == 2)
                                <div class="flex item-center">
                                    <span class="font-poppins bg-red-500 text-slate-50 py-1 px-3 rounded-full text-xs">
                                        Ditolak
                                    </span>
                                </div>
                            @endif

                        </td>

                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <span class="font-poppins">
                                {{ !empty($data->isPetugas->nama) ? $data->isPetugas->nama:' ' }}
                                </span>
                            </div>
                        </td>
                        
                        <td class="py-3 px-6 text-center font-poppins">
                            {{ \Carbon\Carbon::parse($data->tanggal_check_in)->isoFormat('DD MMMM YYYY H:mm') }}
                        </td>

                        <td class="py-3 px-6 text-center font-poppins">
                            {{ $data->toAsrama->nama_asrama}}
                        </td>

                        <td class="py-3 px-6 text-center font-poppins">
                            {{ $data->keperluan }}
                        </td>

                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <span class="bg-blue-500 text-slate-50 py-1 px-3 rounded-full text-xs font-poppins">
                                    <a href="{{ route('mahasiswa.detail.check-in', $data->id) }}">Detail</a>
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
            {{ $riwayatCheckIn->links('pagination::tailwind') }}
        </div>
    </div>

    </div>
@endsection
