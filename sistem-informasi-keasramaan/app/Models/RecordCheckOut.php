<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordCheckOut extends Model
{
    use HasFactory;

    protected $table = 'record_checkout';

    protected $fillable = [
        'check_out_id', 
        'users_id', 
        'petugas_id',
    ];
    public $timestamps = false;

    public function toCheckOut() 
    {
        return $this->belongsTo('App\Models\CheckOut', 'check_out_id');
    }

    public function isPetugas()
    {
        return $this->belongsTo('App\Models\Petugas', 'petugas_id');
    }

    public function isMahasiswa()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }
}
