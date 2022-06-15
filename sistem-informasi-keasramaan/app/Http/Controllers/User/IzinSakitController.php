<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IzinSakitController extends Controller
{
    public function showPageIzinSakit()
    {
        return view('mahasiswa.izin-sakit.index');
    }

    // public function showReqIS() 
    // {

    // }

    // public function storeIS() 
    // {

    // }

    // public function getDetailIzinSakit() 
    // {

    // }

    // public function updateIzinSakit() 
    // {

    // }
}
