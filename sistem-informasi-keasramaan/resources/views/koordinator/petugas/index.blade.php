@extends('koordinator.layouts.main')

@section('title')
    <title>Portal Koordinator</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    Data Petugas Asrama &mdash; Institut Teknologi Del
@endsection

@section('statistics')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-2">
    </div>
@endsection

@section('table')
    <a href="{{ route('koordinator.form-tambah-petugas') }}">
        <button type="button"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 
    focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 
    dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 font-poppins">Tambah
            Petugas Asrama</button></a>
    @if (Session::get('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert">
            <span class="font-medium font-poppins">{{ Session::get('success') }}</span>
        </div>
    @endif
    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-center">Jabatan</th>
                    <th class="py-3 px-6 text-center">Jenis Kelamin</th>
                    <th class="py-3 px-6 text-center">Lokasi Bertugas</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            @foreach ($dataPetugas as $key => $value)
                <tbody class="text-gray-600 text-sm">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap font-poppins">
                            {{ $value->nama }}
    </div>
    </td>
    <td class="py-3 px-6 text-left">
        <div class="flex items-center">
            <span class="font-poppins">
                {{ $value->email }}
            </span>
        </div>
    </td>
    <td class="py-3 px-6 text-center font-poppins">
        {{ $value->jabatan }}
    </td>
    <td class="py-3 px-6 text-center font-poppins">
        {{ Str::of($value->jenis_kelamin)->ucfirst()->explode('_')->implode(' ') }}
    </td>
    <td class="py-3 px-6 text-center">
        {{ $value->asrama->nama_asrama }}
    </td>
    <td class="py-3 px-6 text-center">
        <div class="flex item-center justify-center">

            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110  cursor-pointer">
                <a href="{{ route('koordinator.form-edit-petugas', $value->id) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    </form>
                </a>
            </div>
            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110  cursor-pointer">
                <a href="{{ route('koordinator.delete-petugas', $value->id) }}" class="swal-confirm">
                    <form action="{{ route('koordinator.delete-petugas', $value->id) }}" id="deleteForm" method="POST">
                        @csrf
                        @method('delete')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </form>
                </a>
            </div>
        </div>
    </td>
    </tr>
    </tbody>
    @endforeach

    </div>
    </table>
    <div class="row">
        <div class="col-md-12">
            {{ $dataPetugas->links('pagination::tailwind') }}
        </div>
    </div>

    </div>

    <script>
        $('.swal-confirm').on('click', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            Swal.fire({
                title: 'Anda yakin hapus data ini?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').action = href;
                    document.getElementById('deleteForm').submit();
                    Swal.fire({
                        title: 'Terhapus!',
                        text: 'Data berhasil dihapus!',
                        icon: 'success',
                        confirmButtonColor: '#13C39C',
                        timer: 4000
                    })
                } else {
                    Swal.fire({
                        title: 'Dibatalkan',
                        text: 'Data petugas tidak jadi dihapus',
                        icon: 'error',
                    })
                }
            })
        })
    </script>
    {{-- <script>
        $(".swal-confirm").click(function(e) {
        id = e.target.dataset.id;
        swal({
            title: 'Anda yakin hapus data ini?',
            text: 'Anda tidak dapat mengembalikan data ini jika sudah dihapus.',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal('Data petugas berhasil dihapus!', {
                        icon: 'success',
                    });
                    $(`#delete${id}`).submit();
                } else {
                    swal('Data petugas tidak jadi dihapus!');
                }
            });
        });
    </script> --}}
@endsection
{{-- <script src="https://demo.getstisla.com/assets/modules/sweetalert/sweetalert.min.js"></script> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.js"></script>
