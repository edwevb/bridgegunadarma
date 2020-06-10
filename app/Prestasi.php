<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'tb_prestasi';
    protected $fillable = [
        'pre_title',
        'pre_date',
        'pre_isi',
        'img_pre'
    ];

    public function atlet()
    {
    	return $this->belongsToMany(Atlet::class)->orderBy('atlet_name');
    }

    public function getData()
    {
        $prestasi = \App\Prestasi::orderBy('pre_date','Desc')
                            ->take(3)
                            ->get();
        return $prestasi;
    }
}
