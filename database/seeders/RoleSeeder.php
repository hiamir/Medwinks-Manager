<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name' => 'Super Admin', 'slug_name' => 'super_admin', 'guard_name' => 'admin']);
        DB::table('roles')->insert(['name' => 'Admin', 'slug_name' => 'admin', 'guard_name' => 'admin']);
        DB::table('roles')->insert(['name' => 'Manager', 'slug_name' => 'manager', 'guard_name' => 'web']);
        DB::table('roles')->insert(['name' => 'Guest', 'slug_name' => 'guest', 'guard_name' => 'web']);
    }
}
