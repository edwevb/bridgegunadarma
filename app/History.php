<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
	protected $table = 'tb_history';
    protected $fillable = [
    	'hist_title',
    	'hist_date',
    	'hist_loc',
        'hist_dist',
    	'hist_keterangan'
    ];
    
    public function atlet()
    {
    	return $this->belongsToMany(Atlet::class)->withTimeStamps();
    }
}
