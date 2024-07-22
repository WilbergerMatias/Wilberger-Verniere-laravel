<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        User::create([
            'name' => "Admin",
            'email'=>"admin@iaw.com",            
            'password'=>Hash::make('admin123'),
            'rol'=>"SUPER_ADMIN",
        ])->assignRole('superadmin');

        User::create([
            'name' => "FuncionAdmin",
            'email'=>"funcionAdmin@iaw.com",            
            'password'=>Hash::make('admin234'),
            'rol'=>"ADMIN",
        ])->assignRole('adminFunc');

        User::create([
            'name' => "SalaAdmin",
            'email'=>"salaAdmin@iaw.com",            
            'password'=>Hash::make('admin456'),
            'rol'=>"ADMIN",
        ])->assignRole('adminSala');

        User::create([
            'name' => "GenyPelAdmin",
            'email'=>"generoypeliculaAdmin@iaw.com",            
            'password'=>Hash::make('admin567'),
            'rol'=>"ADMIN",
        ])->assignRole('adminGyP');
    }
}
