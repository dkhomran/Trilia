<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            "name" => "omran",
            "pattern" => "zig-zag",
            "description" => "omran's team.",
        ]);

        Team::create([
            "name" => "anas",
            "pattern" => "isometric",
            "description" => "anas's team.",
        ]);

        Team::create([
            "name" => "test",
            "pattern" => "wavy",
            "description" => "test's team.",
        ]);

        Team::create([
            "name" => "ayoub",
            "pattern" => "circle",
            "description" => "ayoub's team.",
        ]);
    }
}
