<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'full_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Arekcakep1'),
                'role' => 'admin'
            ],
            [
                'username' => 'rasyajusticio',
                'full_name' => 'Rasya Justicio',
                'email' => 'rasyajusticio.personal@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Arekcakep1'),
                'role' => 'user'
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
