<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product_specification_fas;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductspecfasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default timestamps
        $timestamps = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        // Data spesifikasi aerator
        $specificationfas = [
            [
                'product_id' => 1,
                'harga' => 82000000,
                'type_name' => 'FAS 302',
                'power_hp' => 2,
                'power_kw' => 1.5,
                'aerator_sotr' => 3.0,
                'aerator_md' => 6,
                'aerator_mz' => 12,
                'aerator_d' => '2-3',
                'aerator_pr' => 5,
            ],
            [
                'product_id' => 1,
                'harga' => 85000000,
                'type_name' => 'FAS 303',
                'power_hp' => 3,
                'power_kw' => 2.2,
                'aerator_sotr' => 4.2,
                'aerator_md' => 9,
                'aerator_mz' => 18,
                'aerator_d' => '3-4',
                'aerator_pr' => 7,
            ],
            [
                'product_id' => 1,
                'harga' => 90000000,
                'type_name' => 'FAS 305',
                'power_hp' => 5.5,
                'power_kw' => 4,
                'aerator_sotr' => 6.6,
                'aerator_md' => 12,
                'aerator_mz' => 24,
                'aerator_d' => '3-4',
                'aerator_pr' => 9,

                'floater_kubikasi' => 1.936,
                'motor_kubikasi' => 1.125,
                'floater_kg' => 484,
                'motor_kg' => 281.25,
            ],
            [
                'product_id' => 1,
                'harga' => 95000000,
                'type_name' => 'FAS 307',
                'power_hp' => 7.5,
                'power_kw' => 5.5,
                'aerator_sotr' => 9.6,
                'aerator_md' => 16,
                'aerator_mz' => 32,
                'aerator_d' => '3-4',
                'aerator_pr' => 11,

                'floater_kubikasi' => 1.936,
                'motor_kubikasi' => 1.125,
                'floater_kg' => 484,
                'motor_kg' => 281.25,
            ],
            [
                'product_id' => 1,
                'harga' => 105000000,
                'type_name' => 'FAS 310',
                'power_hp' => 10,
                'power_kw' => 7.5,
                'aerator_sotr' => 11.5,
                'aerator_md' => 19,
                'aerator_mz' => 38,
                'aerator_d' => '3-4',
                'aerator_pr' => 19,

                'floater_kubikasi' => 2.53125,
                'motor_kubikasi' => 1.65,
                'floater_kg' => 632.8125,
                'motor_kg' => 412.5,
            ],
            [
                'product_id' => 1,
                'harga' => 120000000,
                'type_name' => 'FAS 315',
                'power_hp' => 15,
                'power_kw' => 11,
                'aerator_sotr' => 16.5,
                'aerator_md' => 27,
                'aerator_mz' => 54,
                'aerator_d' => '3-4',
                'aerator_pr' => 24,

                'floater_kubikasi' => 2.53125,
                'motor_kubikasi' => 1.65,
                'floater_kg' => 632.8125,
                'motor_kg' => 412.5,
            ],
            [
                'product_id' => 1,
                'harga' => 135000000,
                'type_name' => 'FAS 320',
                'power_hp' => 20,
                'power_kw' => 15,
                'aerator_sotr' => 21.0,
                'aerator_md' => 32,
                'aerator_mz' => 64,
                'aerator_d' => '3-4',
                'aerator_pr' => 29,
            ],
            [
                'product_id' => 1,
                'harga' => 150000000,
                'type_name' => 'FAS 325',
                'power_hp' => 25,
                'power_kw' => 18.5,
                'aerator_sotr' => 27.5,
                'aerator_md' => 36,
                'aerator_mz' => 72,
                'aerator_d' => '3-4',
                'aerator_pr' => 33,
            ],
            [
                'product_id' => 1,
                'harga' => 165000000,
                'type_name' => 'FAS 330',
                'power_hp' => 30,
                'power_kw' => 22,
                'aerator_sotr' => 31.0,
                'aerator_md' => 40,
                'aerator_mz' => 80,
                'aerator_d' => '3-4',
                'aerator_pr' => 37,
            ],
            [
                'product_id' => 1,
                'harga' => 180000000,
                'type_name' => 'FAS 340',
                'power_hp' => 40,
                'power_kw' => 30,
                'aerator_sotr' => 38.0,
                'aerator_md' => 45,
                'aerator_mz' => 90,
                'aerator_d' => '5-6',
                'aerator_pr' => 46,
            ],
            [
                'product_id' => 1,
                'harga' => 200000000,
                'type_name' => 'FAS 350',
                'power_hp' => 50,
                'power_kw' => 37,
                'aerator_sotr' => 50,
                'aerator_md' => 50,
                'aerator_mz' => 100,
                'aerator_d' => '5-6',
                'aerator_pr' => 55,
            ],
            [
                'product_id' => 1,
                'harga' => 225000000,
                'type_name' => 'FAS 360',
                'power_hp' => 60,
                'power_kw' => 45,
                'aerator_sotr' => 61,
                'aerator_md' => 56,
                'aerator_mz' => 112,
                'aerator_d' => '5-6',
                'aerator_pr' => 65,
            ],
            [
                'product_id' => 1,
                'harga' => 250000000,
                'type_name' => 'FAS 375',
                'power_hp' => 75,
                'power_kw' => 55,
                'aerator_sotr' => 73,
                'aerator_md' => 62.5,
                'aerator_mz' => 125,
                'aerator_d' => '5-6',
                'aerator_pr' => 80,
            ],
            [
                'product_id' => 1,
                'harga' => 300000000,
                'type_name' => 'FAS 3100',
                'power_hp' => 100,
                'power_kw' => 75,
                'aerator_sotr' => 95,
                'aerator_md' => 70,
                'aerator_mz' => 140,
                'aerator_d' => '5-6',
                'aerator_pr' => 120,
            ],
        ];

        // Menambahkan timestamps ke setiap item dan insert data ke database
        foreach ($specificationfas as $fas) {
            Product_specification_fas::create(array_merge($fas, $timestamps));
        }
    }

}