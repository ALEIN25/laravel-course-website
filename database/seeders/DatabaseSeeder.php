<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jānis',
            'email' => 'janis@email.com',
            'password' => 'parole123',
            'phonenr' => '24126287',
            'role' => 'user',
        ]);
        User::create([
            'name' => 'Bad Guy221',
            'email' => 'badguy221@email.com',
            'password' => 'parole123',
            'phonenr' => '23125678',
            'role' => 'user',
        ]);
        User::create([
            'name' => 'Peter',
            'email' => 'peter@fake.com',
            'password' => 'parole123',
            'phonenr' => 'parole123',
            'role' => 'user',
        ]);
        User::create([
            'name' => 'Anna',
            'email' => 'anna@fake.com',
            'password' => 'parole123',
            'phonenr' => '23149842',
            'role' => 'user',
        ]);
        User::create([
            'name' => 'Niko',
            'email' => 'niko@fake.com',
            'password' => 'parole123',
            'phonenr' => '21312451',
            'role' => 'user',
        ]);
}
}