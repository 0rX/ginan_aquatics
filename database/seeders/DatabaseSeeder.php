<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Ginan',
            'email' => 'admin@ginanaquatic.com',
            'password' => Hash::make('password'),
            'roles' => 'admin'
        ]);
    }
}
