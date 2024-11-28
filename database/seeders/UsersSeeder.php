<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $now = now();

        // $data =[
        $users = [
            [
                'name' => 'tegardimas',
                'email' => 'tegard@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
