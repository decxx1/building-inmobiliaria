<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => env('USER_NAME_SEED'),
            'email' => env('USER_EMAIL_SEED'),
            'password' => env('USER_PASSWORD_SEED')
        ]);
    }
}
