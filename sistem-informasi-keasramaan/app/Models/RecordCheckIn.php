<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordCheckIn extends Model
{
    use HasFactory;

    protected $table = 'record_checkin';

    protected $fillable = [
        'check_in_id', 
        'users_id', 
        'petugas_id',
        'asrama_id',
    ];
    public $timestamps = false;

    public function toCheckIn() 
    {
        return $this->belongsTo('App\Models\CheckIn', 'check_in_id');
        // return $this->hasMany('App\Models\Asrama', 'check_in_id');
    }

    public function isPetugas()
    {
        return $this->belongsTo('App\Models\Petugas', 'petugas_id');
    }

    public function toAsrama() 
    {
        return $this->belongsTo('App\Models\Asrama', 'asrama_id');
    }

    public function isMahasiswa()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }
}
