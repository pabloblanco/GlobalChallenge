<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Movies;
use App\Models\Turns;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Se crean 10 películas
        Movies::factory()->times(10)->create();

        //Se crean 8 turnos
        Turns::factory()->times(8)->create()->each(function($turn)
        {
            $turn->movies()->sync(
                // Cada turno es asignado a 3 películas
                Movies::all()->random(3)
            );
        });        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
