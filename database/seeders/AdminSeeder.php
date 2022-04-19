<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(['name' => 'Amir Hussain', 'email' => 'amir@admin.com', 'email_verified_at' => '2021-12-28 12:25:38','password'=>'$2y$10$8/XEcNZXyMxwZdPFoYOi7uNY5zYpAvZiNBM024jTs513HcsUCqxaO','blocked'=>null,'two_factor_code'=>'938288','two_factor_expires_at'=>Carbon::now(),'deleted_at'=>null,'remember_token'=>'','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
        DB::table('admins')->insert(['name' => 'Sameer Hussain', 'email' => 'sameer@admin.com', 'email_verified_at' => '2021-12-28 12:25:38','password'=>'$2y$10$8/XEcNZXyMxwZdPFoYOi7uNY5zYpAvZiNBM024jTs513HcsUCqxaO','blocked'=>null,'two_factor_code'=>'938288','two_factor_expires_at'=>Carbon::now(),'deleted_at'=>null,'remember_token'=>'','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);

    }
}
