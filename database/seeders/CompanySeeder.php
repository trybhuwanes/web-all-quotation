<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Enums\AccountStatusEnum;
use App\Enums\RoleUserEnum;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'email' => 'grinviroglobal@gmail.com',
                'company' => 'PT Grinviro Global',
                'phone' => '6282348114479',
                'address' => 'Prominence Office Tower Level 28 Unit C, Jl. Jalur Sutera Barat No.15, Tangerang',
                'logo' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'grinvirobiotekno@gmail.com',
                'company' => 'PT Grinviro Biotekno Indonesia',
                'phone' => '6282348114479',
                'address' => 'Prominence Office Tower Level 28 Unit C, Jl. Jalur Sutera Barat No.15, Tangerang',
                'logo' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'gunahijauinovasi@gmail.com',
                'company' => 'PT Guna Hijau Inovasi',
                'phone' => '6282348114479',
                'address' => 'Prominence Office Tower Level 28 Unit C, Jl. Jalur Sutera Barat No.15, Tangerang',
                'logo' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
