<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local') && env('ADMIN_MAIL', false)) {
            DB::table('users')->insert([
                'email' => env('ADMIN_MAIL'),
                'password' => bcrypt(env('ADMIN_MAIL')),
                'wulogin' => env('ADMIN_WU_USER'),
                'wupassword' => env('ADMIN_WU_PASS'),
            ]);
        }
    }
}