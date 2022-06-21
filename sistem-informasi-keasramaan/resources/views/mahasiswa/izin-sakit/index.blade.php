@extends('mahasiswa.layouts.main')

@section('title')
    <title>Portal Mahasiswa</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('mahasiswa.home') }}"><span class="text-gray-600">Home / </a></span>Izin Sakit
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-2">
    </div>
@endsection

@section('table')
    <a href="{{ route('mahasiswa.request.izin-sakit') }}">
        <button type="button"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 
    focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 
    dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 font-poppins">Request
            Izin Sakit</button></a>

    <p class="font-poppins font-normal text-lg py-2">Request sebelumnya</p>
    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">

        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Status Permohonan</th>
                    <th class="py-3 px-6 text-left">Oleh</th>
                    <th class="py-3 px-6 text-center">Jadwal Istirahat</th>
                    <th class="py-3 px-6 text-left">Kondisi</th>
                    <th class="py-3 px-6 text-center">Keterangan</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            @foreach ($riwayatIS as $key => $data)
                <tbody class="text-gray-600 text-sm">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">

                        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins">
                            @if ($data->status_izin == null)
                                <div class="flex item-center">
                                    <span
                                        class="font-poppins bg-yellow-300 text-dark font-semibold py-1 px-3 rounded-full text-xs">
                                        Menunggu Persetujuan
                                    </span>
                                </div>
                            @elseif ($data->status_izin == 1)
                                <div class="flex item-center">
                                    <span class="font-poppins bg-green-700 text-slate-50 py-1 px-3 rounded-full text-xs">
                                        Disetujui
                                    </span>
                                </div>
                            @elseif ($data->status_izin == 2)
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
                                {{ !empty($data->petugas->nama) ? $data->petugas->nama:' ' }}
                                </span>
                            </div>
                        </td>
                        
                        <td class="py-3 px-6 text-center font-poppins">
                            {{ \Carbon\Carbon::parse($data->jadwal_istirahat)->isoFormat('DD MMMM YYYY H:mm') }}
                        </td>

                        <td class="py-3 px-6 text-center font-poppins">
                            @if ($data->kondisi_sakit == 1)
                                <div class="flex item-center">
                                    <span
                                        class="font-poppins py-1 px-3 rounded-full text-sm">
                                        Sakit
                                    </span>
                                </div>
                            @else
                            <div class="flex item-center">
                                <span
                                    class="font-poppins py-1 px-3 rounded-full text-sm">
                                    Sembuh
                                </span>
                            </div>
                            @endif
                        </td>

                        <td class="py-3 px-6 text-center font-poppins">
                            {{ $data->keterangan }}
                        </td>

                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <span class="bg-blue-500 text-slate-50 py-1 px-3 rounded-full text-xs font-poppins">
                                    <a href="{{ route('mahasiswa.detail.izin-sakit', encrypt($data->id)) }}">Detail</a>
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
            {{ $riwayatIS->links('pagination::tailwind') }}
        </div>
    </div>

    </div>
    
    {{-- <p class="font-poppins font-normal text-lg py-2">Pedoman Izin Sakit</p>
    <div class="flex border-b border-gray-300"></div>
    <ul class="list-disc px-4 font-poppins text-base text-justify">
        <li>
            Mahasiswa diberikan Izin Bermalam di Luar Kampus (IBL) di hari Jumat atau Sabtu atau di hari lain dimana
            keesokan harinya tidak ada kegiatan akademik atau kegiatan lainnya yang tidak mengharuskan mahasiswa berada di
            kampus IT Del.
        </li>
        <li>
            Mahasiswa yang IBL wajib menjaga nama baik IT Del di luar kampus.
        </li>
        <li>
            Mahasiswa mengisi pengajuan IBL selambatnya H-2. Dan mencetak form IBL untuk ditandatangani Bapak/Ibu Asrama dan
            ditunjukan di Pos Satpam saat keluar kampus.
        </li>
        <li>
            Pada saat kembali ke kampus, mahasiswa mengumpulkan kertas IBL yang telah ditandatangani oleh orangtua di Pos
            Satpam untuk selanjutnya dikumpulkan dan direkap oleh Pembina Asrama.
        </li>
        <li>
            Apabila terdapat kegiatan Badan Eksekutif Mahasiswa (BEM) yang mengharuskan seluruh mahasiswa mengikuti kegiatan
            tersebut, maka mahasiswa tidak diperbolehkan IBL.
        </li>
        <li>
            Mahasiswa yang tidak mengajukan IBL sesuai ketentuan pada butir 3 (tiga) tidak diizinkan untuk IBL kecuali dalam
            kondisi mendesak (emergency) seperti sakit atau ada keluarga meninggal.
        </li>
    </ul> --}}
@endsection
