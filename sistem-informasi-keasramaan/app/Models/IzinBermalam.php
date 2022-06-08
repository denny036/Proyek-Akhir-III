<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinBermalam extends Model
{
    use HasFactory;

    protected $table = 'izin_bermalam';

    protected $fillable = [
        'users_id',
        'petugas_id',
        'rencana_berangkat',
        'rencana_kembali',
        'keperluan_ib',
        'tempat_tujuan',
        'status'
    ];

    public $timestamps = false;

    public function petugas()
    {
        return $this->belongsTo('App\Models\Petugas', 'petugas_id');
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(User::class);
    }
}
