<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'user@weather-today.com',
            'password' => bcrypt('123456'),
        ]);

        $user->locations()->createMany([
            [
                'name'=> 'Cairo',
                'longitude'=> 31.233334,
                'latitude'=> 30.033333,
            ],
            [
                'name'=> 'Alexandria',
                'longitude'=> 29.924526,
                'latitude'=> 31.205753,
            ],
        ]);
    }
}
