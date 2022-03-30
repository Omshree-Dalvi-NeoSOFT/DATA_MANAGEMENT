<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['role_name'=>'Superadmin'],
            ['role_name'=>'User Admin'],
            ['role_name'=>'Sales Team']
        ];
        Role::insert($roles);
    }
}
