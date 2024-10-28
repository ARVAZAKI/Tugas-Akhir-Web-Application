<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'arva admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'arva student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'student',
        ]);
        User::create([
            'name' => 'arva teacher',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'teacher',
        ]);
        User::create([
            'name' => 'arva staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'staff',
        ]);
    }
}
