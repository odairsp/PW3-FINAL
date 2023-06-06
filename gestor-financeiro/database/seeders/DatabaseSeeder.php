<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(8)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Transaction::factory(300)->create();

        \App\Models\User::factory()->create([

            'name' => "Odair Farias",
            'email' => "email@email.com",
            'password' => 12345678,
        ]);
        \App\Models\User::factory()->create([

            'name' => "Simone Oliveira",
            'email' => "email@email",
            'password' => 12345678,
        ]);


        \App\Models\Category::factory()->create([

            'name' => "Alimentação",
            'description' => "Consumo etc...",
        ]);
        \App\Models\Category::factory()->create([

            'name' => "Transporte",
            'description' => "Gas e uber",
        ]);
    }
}