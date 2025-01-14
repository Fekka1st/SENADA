<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'Ferry',
            'email' => 'ferryaditya124@gmail.com',
            'password' => Hash::make('admin123'),
            'foto_url' => 'https://i2.wp.com/genshinbuilds.aipurrjects.com/genshin/characters/furina/image.png?strip=all&quality=75&w=256',
            'role' => 1,  // 1 = Admin | 2 = User
            'created_at' => now(),
            'updated_at' => now()
        ]);
        User::factory()->create([
            'name' => 'Aku USER',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
            'foto_url' => 'nothing',
            'role' => 2,  // 1 = Admin | 2 = User
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
