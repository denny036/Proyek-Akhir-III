<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $table = 'check_in';

    protected $fillable = [
        'users_id',
        'petugas_id',
        'record_mahasiswa_asrama_id',
        'asrama_tujuan',
        'tanggal_check_in',
        'keperluan',
        'status_request',
    ];

    public $timestamps = false;

    public function isPetugas()
    {
        return $this->belongsTo('App\Models\Petugas', 'petugas_id');
    }

    public function isMahasiswa()
    {
        return $this->belongsToMany(User::class);
    }

    public function isRecordAsrama() 
    {
      return $this->belongsTo('App\Models\RecordMahasiswaAsrama', 'record_mahasiswa_asrama_id');
    }
}
