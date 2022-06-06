@extends('petugas.layouts.main')

@section('title')
    <title>Portal Petugas</title>
@endsection

@section('judul-navigasi')
    Keasramaan IT Del
@endsection

@section('judul-halaman')
    <a href="{{ route('petugas.izin-bermalam') }}"><span class="text-gray-600">Daftar IB Mahasiswa / </a></span>
@endsection

@section('statistics')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-2">
</div>
@endsection

@section('table')
    
@endsection