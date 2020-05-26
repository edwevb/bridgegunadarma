<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'tb_event';
    protected $fillable = [
    		'eve_title',
    		'eve_date',
    		'eve_loc',
    		'eve_isi',
    		'kontak',
            'prizepool',
    		'fee_team_open',
    		'fee_team_mhs',
    		'fee_team_u21',
    		'fee_pas_open',
            'fee_pas_mhs',
            'fee_pas_u21',
    		'eve_url',
    		'img_eve'
    ];
}
