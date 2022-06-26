<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    use HasFactory;

    protected $table = 'check_out';

    protected $fillable = [
        // 'users_id',
        // 'petugas_id',
        // 'asrama_id',
        'tanggal_check_in',
        'keperluan',
        'status_request',
    ];

    public $timestamps = false;

    public function toRecordCO() 
    {
      return $this->hasMany('App\Models\RecordCheckOut', 'record_checkout_id');
    }
}
