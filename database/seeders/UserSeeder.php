<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            User::create([
                'name' => 'Customer ' . $i,
                'email' => 'customer-' . $i . '@gmail.com',
                'phone_number' => Str::random(10), // Menggunakan nilai acak untuk phone_number
                'roles' => 'customer',
                'password' => Hash::make('password')
            ]);
        }
    }
}
