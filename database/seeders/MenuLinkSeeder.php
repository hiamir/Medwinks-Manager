<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MenuLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("menu_links")->insert([ "id" => '1', "name" => 'Dashboard', "route" => 'admin.dashboard', "route_index" => 'livewire.admin.dashboard', "roles" => '["Super Admin","Admin"]', "permission_id" => '1', "folder_id" => '1', "category_id" => '1', "position" => '1', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now() ]);
        DB::table("menu_links")->insert([ "id" => '2', "name" => 'Dashboard', "route" => 'dashboard', "route_index" => 'livewire.admin.dashboard', "roles" => '["Manager","Guest"]', "permission_id" => '1', "folder_id" => '1', "category_id" => '1', "position" => '1', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now() ]);
        DB::table("menu_links")->insert([ "id" => '3', "name" => 'Admin', "route" => 'admin.admins', "route_index" => 'livewire.admin.admins.index', "roles" => '["Super Admin"]', "permission_id" => '4', "folder_id" => '2', "category_id" => '2', "position" => '1', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now() ]);
        DB::table("menu_links")->insert([ "id" => '5', "name" => 'Roles', "route" => 'admin.roles', "route_index" => 'livewire.admin.roles.index', "roles" => '["Super Admin","Admin"]', "permission_id" => '5', "folder_id" => '2', "category_id" => '2', "position" => '2', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now() ]);
        DB::table("menu_links")->insert([ "id" => '6', "name" => 'PermissionExtends', "route" => 'admin.permissions', "route_index" => 'livewire.admin.permissions.index', "roles" => '["Super Admin","Admin"]', "permission_id" => '6', "folder_id" => '2', "category_id" => '2', "position" => '3', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now() ]);
        DB::table("menu_links")->insert([ "id" => '7', "name" => 'Categories', "route" => 'admin.menu.categories', "route_index" => 'livewire.admin.menu.categories.index', "roles" => '["Super Admin","Admin"]', "permission_id" => '7', "folder_id" => '3', "category_id" => '3', "position" => '1', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now() ]);
        DB::table("menu_links")->insert([ "id" => '8', "name" => 'Folders', "route" => 'admin.menu.folders', "route_index" => 'livewire.admin.menu.folders.index', "roles" => '["Super Admin","Admin"]', "permission_id" => '8', "folder_id" => '3', "category_id" => '3', "position" => '2', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now() ]);
        DB::table("menu_links")->insert([ "id" => '9', "name" => 'Links', "route" => 'admin.menu.links', "route_index" => 'livewire.admin.menu.links.index', "roles" => '["Super Admin","Admin"]', "permission_id" => '9', "folder_id" => '3', "category_id" => '3', "position" => '3', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now() ]);
        DB::table("menu_links")->insert([ "id" => '10', "name" => 'Countries', "route" => 'admin.countries', "route_index" => 'livewire.admin.countries.index', "roles" => '["Admin"]', "permission_id" => '10', "folder_id" => '4', "category_id" => '4', "position" => '1', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now() ]);
        DB::table("menu_links")->insert([ "id" => '11', "name" => 'Regions', "route" => 'admin.regions', "route_index" => 'livewire.admin.regions.index', "roles" => '["Admin"]', "permission_id" => '11', "folder_id" => '4', "category_id" => '4', "position" => '12', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now() ]);
    }
}
