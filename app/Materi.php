<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'tb_materi';
    protected $fillable = [
    	'mat_title',
    	'mat_date',
    	'mat_keterangan',
    	'file_mat'
    ];
}
