<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'tb_pengeluaran';
    protected $fillable = [
    	'p_title',
    	'p_date',
    	'p_biaya',
    	'p_keterangan'
    ];
}
