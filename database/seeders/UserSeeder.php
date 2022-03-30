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
        User::create([
            'firstname'=>'admin',
            'lastname' =>'admin',
            'email' => 'omshreedalvi31@gmail.com',
            'password' => Hash::make('admin123'),
            'role_id' => 1,
            'status' => 1
        ]);
    }
}
