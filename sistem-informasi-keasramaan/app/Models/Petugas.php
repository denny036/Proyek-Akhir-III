<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Petugas extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'petugas';
    
    protected $fillable = [
        'asrama_id',
        'nama',
        'email',
        'password',
        'jabatan',
        'jenis_kelamin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function asrama() 
    {
      return $this->belongsTo('App\Models\Asrama', 'asrama_id');
    }

    public function ib()
    {
        return $this->hasMany('App\Models\IzinBermalam', 'izin_bermalam_id');
    }
    
    public function i_sakit()
    {
        return $this->hasMany('App\Models\IzinBermalam', 'izin_bermalam_id');
    }
}
