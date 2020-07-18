<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visited extends Model
{
    protected $table = 'tb_visited';
    protected $fillable = [
    	'atlet_id','hits', 'name'
    ];

  	public function atlet()
		{
				return $this->belongsTo('App\Atlet');
		}
}
