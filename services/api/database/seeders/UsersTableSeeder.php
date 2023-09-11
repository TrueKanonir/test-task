<?php

namespace Database\Seeders;

use Domain\Shared\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Rustam Sadykov',
            'email' => 'rustam.sadikov17@gmail.com',
            'password' => 'password123'
        ]);
    }
}
