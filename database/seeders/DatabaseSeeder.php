<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\MedicalEditor::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RoleHasPermissionSeeder::class,
            ModalHasRoleSeeder::class,
            MenuFolderSeeder::class,
            MenuCategorySeeder::class,
            MenuLinkSeeder::class,
            CountrySeeder::class,
            RegionSeeder::class,
        ]);
    }
}
