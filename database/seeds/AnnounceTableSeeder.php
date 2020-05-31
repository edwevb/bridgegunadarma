<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AnnounceTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('tb_ann')->insert([
    				'ann_title' => 'Bridge Gunadarma',
            'ann_date'  => now(),
            'ann_isi'   => 'Hello, Bridge Lovers!'
    		]);
    }
}
