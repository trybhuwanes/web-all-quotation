<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriproductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('category_products')->insert([
            [
                'id' => 1,
                'nama_kategori' => 'FLOWREX',
                'logo' => null, 
                'deskripsi' => 'Flowrex Grinviro',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'nama_kategori' => 'BIOFLUX',
                'logo' => null, 
                'deskripsi' => 'Bioflux 2024 Grinviro',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'nama_kategori' => 'SUPRAX',
                'logo' => null, 
                'deskripsi' => 'Suprax 2024 Grinviro',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
