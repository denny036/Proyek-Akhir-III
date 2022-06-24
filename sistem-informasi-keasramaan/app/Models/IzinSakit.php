<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinSakit extends Model
{
    use HasFactory;

    protected $table = 'izin_sakit';

    protected $fillable = [
        'users_id',
        'petugas_id',
        'jadwal_istirahat',
        'keterangan',
        'status_izin',
        'kondisi',
        'surat_sakit'
    ];

    public $timestamps = false;

    public function toPetugas()
    {
        return $this->belongsTo('App\Models\Petugas', 'petugas_id');
    }

    public function toMahasiswa()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }
}
