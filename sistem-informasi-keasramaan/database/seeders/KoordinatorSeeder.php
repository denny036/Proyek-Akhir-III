<?php

namespace Database\Seeders;

use App\Models\Koordinator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Koordinator::create([
            'nama' => 'Koordinator Asrama Del',
            'email' => 'koordinatorasramadel@gmail.com',
            'password' => Hash::make('Del#123'),
        ]);
    }
}
