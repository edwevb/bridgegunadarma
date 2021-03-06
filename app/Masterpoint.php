<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masterpoint extends Model
{
		protected $table = 'tb_masterpoint';
		protected $fillable = [
				'atlet_id',
				'discipline',
				'bidding',
				'play'
	];

	public function atlet()
	{
			return $this->belongsTo('App\Atlet');
	}

	public function AvarageMasterpoint()
  {
      $avg = ($this->discipline + $this->bidding + $this->play)/3;
      return $avg;
  }
}
