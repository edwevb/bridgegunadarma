<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	$this->call([
    		AnnounceTableSeeder::class,
    		UserSeeder::class
    	]);
        // $this->call(UserSeeder::class);
    }
}
