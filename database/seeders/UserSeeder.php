<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
        'name' => 'Vel',
        'email' => 'vel@gmail.com',
        'password' => Hash::make('Azizbek123456'),
       ]);
       User::create([
        'name' => 'Azizbek',
        'email' => 'webcoderazizbek@gmail.com',
        'password' => Hash::make('Azizbek987'),
       ]);
    }
}
