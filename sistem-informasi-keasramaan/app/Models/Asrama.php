<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asrama extends Model
{
    use HasFactory;

    protected $table = 'asrama';

    protected $fillable = [
        'nama_asrama',
        'jenis_asrama',
        'lokasi_asrama'
    ];

    public function petugas() 
    {
      return $this->hasMany('App\Models\Petugas', 'asrama_id');
    }

    public function toCheckIn() 
    {
      return $this->hasMany('App\Models\CheckIn', 'check_in_id');
    }
}
