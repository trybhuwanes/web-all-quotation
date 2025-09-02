<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\AccountStatusEnum;
use App\Enums\RoleUserEnum;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'gunahijauinovasi2024@gmail.com',
                'email_verified_at' => Carbon::now(),
                'name' => 'Super Admin GHI',
                'phone' => '6281231074433',
                'photo' => null,
                'password' => bcrypt('gunahijau@2024'),
                'status' => AccountStatusEnum::active,
                'role' => RoleUserEnum::admin,
                'company' => null,
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'testpic@gmail.com',
                'email_verified_at' => Carbon::now(),
                'name' => 'Test PIC',
                'phone' => '6281231070000',
                'photo' => null,
                'password' => bcrypt('testpic@2024'),
                'status' => AccountStatusEnum::active,
                'role' => RoleUserEnum::pic,
                'company' => null,
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'testpic2@gmail.com',
                'email_verified_at' => Carbon::now(),
                'name' => 'Test PIC 2',
                'phone' => '6281231070000',
                'photo' => null,
                'password' => bcrypt('testpic@2024'),
                'status' => AccountStatusEnum::active,
                'role' => RoleUserEnum::pic,
                'company' => null,
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'customerexample@gmail.com',
                'email_verified_at' => Carbon::now(),
                'name' => 'Customer Jhon',
                'phone' => null,
                'photo' => null,
                'password' => bcrypt('customer#2024'),
                'status' => AccountStatusEnum::active,
                'role' => RoleUserEnum::customer,
                'company' => 'PT. Inovasi Maju',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'webmaster@grinvirobiotekno.com',
                'email_verified_at' => Carbon::now(),
                'name' => 'webmaster',
                'phone' => null,
                'photo' => null,
                'password' => bcrypt('webmaster#2024'),
                'status' => AccountStatusEnum::active,
                'role' => RoleUserEnum::customer,
                'company' => 'PT. Inovasi Mundur',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
