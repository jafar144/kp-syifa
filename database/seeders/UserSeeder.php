<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'NIK' => '1671181404070001',
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'tanggal_lahir' => '2003-04-14',
            'jenis_kelamin' => 'L',
            'status' => 'A',
            'alamat' => 'Rajawali',
            'notelp' => '6287799841613',
            'password' => Hash::make('admin'),
        ]);
    }
}
