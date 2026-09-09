<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Login;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Login::factory()->create([
            'username' => 'Admin',
            'password' => Hash::make('adminadmin'),
        ]);
    }
}
