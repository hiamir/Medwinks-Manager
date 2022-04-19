<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(['name' => 'Amir Hussain', 'email' => 'amir@user.com', 'email_verified_at' => Carbon::now(),'password'=>'$2y$10$8/XEcNZXyMxwZdPFoYOi7uNY5zYpAvZiNBM024jTs513HcsUCqxaO','blocked'=>null,'two_factor_code'=>'938288','two_factor_expires_at'=>Carbon::now(),'deleted_at'=>null,'remember_token'=>'','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
    }
}
