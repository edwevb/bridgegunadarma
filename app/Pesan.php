<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'tb_pesan';
    protected $fillable = [
    	'name',
    	'pesan'
    ];
}
