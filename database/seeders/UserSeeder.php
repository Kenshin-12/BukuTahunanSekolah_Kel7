<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            'username' => 'Nama Pengguna',
            // 'email' => 'email@contoh.com',
            'password' => Hash::make('password'),
            'role'     => fake()->randomElement(['admin', 'guru', 'siswa']),
            // Dan kolom lain yang diperlukan
        ]);
    }
}
