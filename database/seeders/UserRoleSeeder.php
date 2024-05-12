<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ganti data sesuai dengan yang Anda inginkan
        $userData = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role'=>'admin',
            ],
            [
                'name' => 'dokter',
                'email' => 'dokter@gmail.com',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
            ],
            [
                'name' => 'perawat',
                'email' => 'perawat@gmail.com',
                'password' => Hash::make('perawat123'),
                'role' => 'perawat',
            ],
            [
                'name' => 'apoteker',
                'email' => 'apoteker@gmail.com',
                'password' => Hash::make('apoteker123'),
                'role' => 'apoteker',
            ],
            // Tambahkan data pengguna lainnya di sini
        ];

        foreach ($userData as $user) {
            User::create($user);
        }
    }
}
