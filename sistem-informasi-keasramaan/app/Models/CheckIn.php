<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $table = 'check_in';
    protected $primaryKey = 'check_in_id';

    protected $fillable = [
        'users_id',
        'petugas_id',
        'asrama_id',
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
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    public function toAsrama() 
    {
        return $this->belongsTo('App\Models\Asrama', 'asrama_id');
        // return $this->hasMany('App\Models\Asrama', 'check_in_id');
    }
}
