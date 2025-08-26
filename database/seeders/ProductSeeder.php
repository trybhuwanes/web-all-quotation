<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //products
        $products = [
            [
                'nama_produk' => 'FLOWREX Surface Aerator',
                // 'harga' => 50000000,
                'thumbnail' => null, 
                'deskripsi_produk' => 'Tingkatkan efisiensi pengolahan air limbah Anda dengan FLOWREX Surface Aerator',
                'slug' => 'flowrex-surface-aerator',
                'category_id' => 1,
                'specification_type' => 'fas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_produk' => 'FLOWREX Multi Plate Screw Press',
                // 'harga' => 51000000,
                'thumbnail' => null, 
                'deskripsi_produk' => 'Optimalkan proses dewatering Anda dengan FLOWREX Multi Plate Screw Press',
                'slug' => 'flowrex-multi-plate-screw-press',
                'category_id' => 1,
                'specification_type' => 'fmp',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_produk' => 'BIOFLUX STP MBR',
                // 'harga' => 52000000,
                'thumbnail' => null,
                'deskripsi_produk' => 'Bioflux STP Membrane Bio Reactor terbaik dan berkualitas',
                'slug' => 'bioflux-stp-mbr',
                'category_id' => 2,
                'specification_type' => 'bf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], 
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

    }
}
