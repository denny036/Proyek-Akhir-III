<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Denny Abraham Sinaga',
            'nim' => '11419036',
            'password' => Hash::make('Del#123'),
            'angkatan' => 2019,
            'prodi' => 'd4_trpl',
        ]);
    }
}
