<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Dekhil Omran",
            "email" => "Dekhil22omran@gmail.com",
            "password" => bcrypt("password"),
            "image_path" => "image/user/4.png",
        ]);

        User::create([
            "name" => "Dekhil Ayoub",
            "email" => "Ayoub@gmail.com",
            "password" => bcrypt("password"),
            "image_path" => "image/user/1.png",
        ]);

        User::create([
            "name" => "dekhil anas",
            "email" => "anas@gmail.com",
            "password" => bcrypt("password")
        ]);

        User::create([
            "name" => "test 1",
            "email" => "test1@gmail.com",
            "password" => bcrypt("password")
        ]);

        User::create([
            "name" => "test 2",
            "email" => "test2@gmail.com",
            "password" => bcrypt("password"),
            "image_path" => "image/user/2.jpg",
        ]);

        User::create([
            "name" => "test 3",
            "email" => "test3@gmail.com",
            "password" => bcrypt("password"),
            "image_path" => "image/user/3.jpg",
        ]);

        User::create([
            "name" => "test 4",
            "email" => "test4@email.com",
            "password" => bcrypt("password"),
        ]);

        User::create([
            "name" => "Test 5",
            "email" => "test 5@email.com",
            "password" => bcrypt("password"),
            "is_active" => false,
        ]);
    }
}
