<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordMahasiswaAsrama extends Model
{
    use HasFactory;

    protected $table = 'record_mahasiswa_asrama';

    protected $fillable = [
        'users_id', 'asrama_id',
    ];
    
}
