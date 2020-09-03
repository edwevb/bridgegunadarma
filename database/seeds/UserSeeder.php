<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('users')->get()->count() == 0) 
        {
            DB::table('users')->insert([
                'name'       => 'Admin',
                'email'      => 'admin@bridgegunadarma.com',
                'role_id'    => 1,
                'password'   => bcrypt('admin123'),
                'created_at' => now()
            ],
            [
                'name'       => 'Edward Evbert',
                'email'      => 'edwardevbert@gmail.com',
                'role_id'    => 1,
                'password'   => bcrypt('123123'),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }else{ echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
