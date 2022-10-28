<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Francisca Rubio',
            'email' => 'kine@jumpitt.com',
            'password' => Hash::make('MacaFicha14'),
            'occupation' => User::OCCUPATION[1],
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Macarena Gárate',
            'email' => 'mgarate@jumpitt.com',
            'password' => Hash::make('admin123'),
            'occupation' => User::OCCUPATION[0],
        ]);
    }
}
