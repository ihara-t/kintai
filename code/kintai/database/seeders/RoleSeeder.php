<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => '社員']);
        Role::create(['name' => '労務士']);
        Role::create(['name' => '管理者']);
    }
}
