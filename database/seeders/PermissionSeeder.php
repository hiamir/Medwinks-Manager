<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("permissions")->insert([ "id" => '1', "name" => 'view-admin-dashboard', "guard_name" => 'admin', ]);
        DB::table("permissions")->insert([ "id" => '2', "name" => 'view-dashboard', "guard_name" => 'web', ]);
        DB::table("permissions")->insert([ "id" => '4', "name" => 'view-admin-admins', "guard_name" => 'admin', ]);
        DB::table("permissions")->insert([ "id" => '5', "name" => 'view-admin-roles', "guard_name" => 'admin', ]);
        DB::table("permissions")->insert([ "id" => '6', "name" => 'view-admin-permissions', "guard_name" => 'admin', ]);
        DB::table("permissions")->insert([ "id" => '7', "name" => 'view-menu-categories', "guard_name" => 'admin', ]);
        DB::table("permissions")->insert([ "id" => '8', "name" => 'view-admin-menu-folders', "guard_name" => 'admin', ]);
        DB::table("permissions")->insert([ "id" => '9', "name" => 'view-admin-menu-links', "guard_name" => 'admin', ]);
        DB::table("permissions")->insert([ "id" => '10', "name" => 'view-admin-countries', "guard_name" => 'admin', ]);
        DB::table("permissions")->insert([ "id" => '11', "name" => 'view-admin-regions', "guard_name" => 'admin', ]);
        DB::table("permissions")->insert([ "id" => '12', "name" => 'view-admin-phone-types', "guard_name" => 'admin', ]);

    }
}
