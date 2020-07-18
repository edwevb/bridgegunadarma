<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Atlet extends Model
{
    protected $table = 'tb_atlet';
    protected $fillable = [
    	'nik',
    	'atlet_name',
    	'tgl_lahir',
    	'gender',
    	'telp',
    	'email',
    	'alamat',
    	'fakultas',
    	'jurusan',
    	'angkatan',
    	'fb',
    	'twt',
    	'ig',
    	'brg_taught',
        'img_atlet'
    ];

    public function prestasi()
    {
        return $this->belongsToMany('App\Prestasi')->withTimeStamps();
    }

    public function history()
    {   
        return $this->belongsToMany('App\History')->withTimeStamps();
    }

    public function masterpoint()
    {   
        return $this->hasOne('App\Masterpoint');
    }

     public function visited()
    {   
        return $this->hasOne('App\Visited');
    }

    public function iuranSk()
    {   
        return $this->belongsToMany('App\IuranSk')->withPivot(['sk_date','sk_bayar'])->withTimeStamps();
    }

    public function getAge()
    {
        return \Carbon\Carbon::parse($this->tgl_lahir)->age;
    }
}
