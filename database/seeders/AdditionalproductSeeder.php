<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Additional_product;

class AdditionalproductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //additional_products
        $additional_products = [
            [
                'product_id' => 1,
                'nama_produk_tambahan' => 'Panel Control for Aerator',
                'harga_produk_tambahan' => 2000000,
                'thumbnail_produk_tambahan' => null, 
                'deskripsi_produk_tambahan' => 'Panel Control for Aerator Include',
                'slug' => 'panel-control-for-aerator',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 1,
                'nama_produk_tambahan' => 'Commissioning Cost',
                'harga_produk_tambahan' => 5000000,
                'thumbnail_produk_tambahan' => null, 
                'deskripsi_produk_tambahan' => 'Commissioning Cost Grinviro',
                'slug' => 'commissioning-cost',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 1,
                'nama_produk_tambahan' => 'Site Supervision',
                'harga_produk_tambahan' => 5200000,
                'thumbnail_produk_tambahan' => null, 
                'deskripsi_produk_tambahan' => 'Site Supervision Grinviro',
                'slug' => 'site-supervision',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 1,
                'nama_produk_tambahan' => 'Shipping to Onsite',
                'harga_produk_tambahan' => 3500000,
                'thumbnail_produk_tambahan' => null, 
                'deskripsi_produk_tambahan' => 'Shipping to Onsite',
                'slug' => 'shipping-to-onsite',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // -MPS Additional------------------------------------------------------
            [
                'product_id' => 2,
                'nama_produk_tambahan' => 'Dosing Pump',
                'harga_produk_tambahan' => 5100000,
                'thumbnail_produk_tambahan' => null, 
                'deskripsi_produk_tambahan' => 'Dosing Pump',
                'slug' => 'dosing-pump',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            [
                'product_id' => 2,
                'nama_produk_tambahan' => 'Agitator + Chemical Tank',
                'harga_produk_tambahan' => 5000000,
                'thumbnail_produk_tambahan' => null, 
                'deskripsi_produk_tambahan' => 'Agitator and Chemical Tank',
                'slug' => 'agitator-and-chemical-tank',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'product_id' => 2,
                'nama_produk_tambahan' => 'APP (Automatic Polymer Preparation)',
                'harga_produk_tambahan' => 5000000,
                'thumbnail_produk_tambahan' => null, 
                'deskripsi_produk_tambahan' => 'APP (Automatic Polymer Preparation)',
                'slug' => 'automatic-polymer-preparation',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'product_id' => 2,
                'nama_produk_tambahan' => 'Pump (Feed Pump & Filtrat Pump)',
                'harga_produk_tambahan' => 5500000,
                'thumbnail_produk_tambahan' => null, 
                'deskripsi_produk_tambahan' => 'Pump (Feed Pump & Filtrat Pump)',
                'slug' => 'pump',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 2,
                'nama_produk_tambahan' => 'Civil & Structural Work - Foundation',
                'harga_produk_tambahan' => 5100000,
                'thumbnail_produk_tambahan' => null, 
                'deskripsi_produk_tambahan' => 'Civil & Structural Work - Foundation',
                'slug' => 'civil-and-structural-work-foundation',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 2,
                'nama_produk_tambahan' => 'Testing & Commissioning - Chemical',
                'harga_produk_tambahan' => 4200000,
                'thumbnail_produk_tambahan' => null, 
                'deskripsi_produk_tambahan' => 'Testing & Commissioning - Chemical',
                'slug' => 'testing-and-commissioning-chemical',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 2,
                'nama_produk_tambahan' => 'Testing & Commissioning - Offline Training',
                'harga_produk_tambahan' => 4500000,
                'thumbnail_produk_tambahan' => null, 
                'deskripsi_produk_tambahan' => 'Testing & Commissioning - Offline Training',
                'slug' => 'testing-and-commissioning-offline-training',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 2,
                'nama_produk_tambahan' => 'Supervision of Installation',
                'harga_produk_tambahan' => 5200000,
                'thumbnail_produk_tambahan' => null, 
                'deskripsi_produk_tambahan' => 'Supervision of Installation',
                'slug' => 'supervision-of-installation',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 2,
                'nama_produk_tambahan' => 'Shipping to Onsite',
                'harga_produk_tambahan' => 3500000,
                'thumbnail_produk_tambahan' => null,
                'deskripsi_produk_tambahan' => 'Shipping to Onsite',
                'slug' => 'shipping-to-onsite',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($additional_products as $additional_product) {
            Additional_product::create($additional_product);
        }
    }
}
