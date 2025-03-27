<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Web Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('12345678'),
            'role' => 1 //Admin
        ]);
        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
            'role'  => 2 //user
        ]);

        // Employee::factory()->count(1000)->create();
    }
}
