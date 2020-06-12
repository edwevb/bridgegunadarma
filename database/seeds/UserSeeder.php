<?php

use Illuminate\Database\Seeder;
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
         DB::table('users')->insert([
				'name'     => 'Admin',
				'email'    => 'admin@bridgegunadarma.com',
				'role_id'  => 1,
				'password' => bcrypt('admin123')
    		]);
    }
}
