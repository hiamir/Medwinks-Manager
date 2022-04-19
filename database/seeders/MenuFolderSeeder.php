<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("menu_folders")->insert([ "id" => '1', "name" => 'Root', "position" => '1', ]);
        DB::table("menu_folders")->insert([ "id" => '2', "name" => 'Security', "position" => '2', ]);
        DB::table("menu_folders")->insert([ "id" => '3', "name" => 'Menu', "position" => '3', ]);
        DB::table("menu_folders")->insert([ "id" => '4', "name" => 'Data', "position" => '4', ]);
    }
}
