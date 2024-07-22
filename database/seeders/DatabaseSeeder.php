<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
             RoleSeeder::class,
             UserSeeder::class,
             GeneroSeeder::class,
             PeliculaSeeder::class,
             SalaSeeder::class,
             FuncionSeeder::class,
             CompraSeeder::class,
             //DetallesCompraSeeder::class,
        ]);
    }
}
