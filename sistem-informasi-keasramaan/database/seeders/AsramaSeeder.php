<?php

namespace Database\Seeders;

use App\Models\Asrama;
use Illuminate\Database\Seeder;

class AsramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Asrama::create([
                'nama_asrama' => 'Silo',
                'jenis_asrama' => 'laki-laki',
                'lokasi_asrama' => 'Asrama Dalam Kampus',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
        ]);
    }
}
