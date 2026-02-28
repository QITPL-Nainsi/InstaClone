<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Admin Demo', 'email' => 'admin@instaclone.test'],
            ['name' => 'Aarav Sharma', 'email' => 'aarav@instaclone.test'],
            ['name' => 'Sara Khan', 'email' => 'sara@instaclone.test'],
            ['name' => 'Rohan Mehta', 'email' => 'rohan@instaclone.test'],
            ['name' => 'Mia Joseph', 'email' => 'mia@instaclone.test'],
        ];

        foreach ($users as $item) {
            User::updateOrCreate(
                ['email' => $item['email']],
                [
                    'name' => $item['name'],
                    'password' => Hash::make('password123'),
                ]
            );
        }
    }
}
