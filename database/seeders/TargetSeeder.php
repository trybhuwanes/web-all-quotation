<?php

namespace Database\Seeders;

use App\Models\Target;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $year = now()->year;

        // Ambil semua PIC (misalnya role user sebagai PIC)
        $users = User::where('role', 'PIC')->where('status', 'active')->get(); // Bisa disaring sesuai kebutuhan, contoh: User::where('role', 'PIC')->get();

        foreach ($users as $user) {
            foreach (range(1, 12) as $month) {
                // Cek dulu biar tidak double insert
                Target::firstOrCreate(
                    [
                        'pic_id' => $user->id,
                        'month'  => $month,
                        'year'   => $year,
                    ],
                    [
                        'target' => 50000000, // Default target (bisa disesuaikan per bulan)
                    ]
                );
            }
        }
    }
}
