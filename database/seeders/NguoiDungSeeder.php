<?php

namespace Database\Seeders;

use App\Models\Nguoidung;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nguoidung::create([
            'email' => 'khanhnkq',
            'password' => Hash::make('123456')
        ]);
    }
}
