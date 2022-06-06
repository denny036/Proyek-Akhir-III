@extends('petugas.layouts.main')

@section('title')
    <title>Portal Petugas</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('petugas.home') }}"><span class="text-gray-600">Home / </a></span>Daftar IB Mahasiswa
@endsection

@section('statistics')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-2">
</div>
@endsection

@section('table')
{{-- <a href="{{ route('mahasiswa.request.izin-bermalam') }}"> --}}
    <p class="font-poppins font-normal text-lg py-2">Daftar Request IB Mahasiswa</p>
    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">
        
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">NIM</th>
                    <th class="py-3 px-6 text-center">Keperluan IB</th>
                    <th class="py-3 px-6 text-center">Tempat Tujuan</th>
                    <th class="py-3 px-6 text-center">Status Permohonan</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            @foreach ($daftarReqIB as $data) 
            <tbody class="text-gray-600 text-sm">
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap font-poppins">
                            {{ $data->nama }}
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span class="font-poppins">
                                {{ $data->nim }}
                            </span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center font-poppins">
                        {{ $data->keperluan_ib }}
                    </td>

                    <td class="py-3 px-6 text-center font-poppins">
                        {{ $data->tempat_tujuan }}
                    </td>

                    <td class="py-3 px-6 text-center font-poppins">
                        @if ($data->status == null)
                            <div class="flex item-center justify-center">
                                <span class="font-poppins bg-yellow-300 text-dark font-semibold py-1 px-3 rounded-full text-xs">
                                    Menunggu Persetujuan
                                </span>
                            </div>
                        @elseif ($data->status == 1)    
                            <div class="flex item-center justify-center">
                                <span class="font-poppins bg-green-700 text-slate-50 py-1 px-3 rounded-full text-xs">
                                    Disetujui
                                </span>
                            </div>
                        @elseif ($data->status == 2)    
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
                                {{-- <a href="{{ route('petugas.detail-izin-bermalam', encrypt($detailReqIB->id)) }}">Detail</a> --}}
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
                {{-- {{ $asrama->links('pagination::tailwind') }} --}}
            </div>
        </div>

    </div>
@endsection