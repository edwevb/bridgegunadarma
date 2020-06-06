<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IuranSk extends Model
{
	protected $table = 'tb_iuran_sk';
	protected $fillable = [
         'sk_tahun',
         'pta_ata'
	];

	public function atlet()
	{
		return $this->belongsToMany('App\Atlet')->withPivot(['sk_date','sk_bayar'])->withTimeStamps()->orderBy('atlet_name');
	}

	public function totalSk()
	{
		foreach ($this->atlet as $atlet)
      {
         // $atlet->pivot->where('iuran_sk_id', $atlet->pivot->iuran_sk_id)->sum('sk_bayar')
			$total = $atlet->pivot
                  ->where('iuran_sk_id',$this->id)
                  ->sum('sk_bayar');
			return $total;
		}
	}

   public function total()
   {
      foreach ($this->atlet as $atlet)
      {
         $total = $atlet->pivot->sum('sk_bayar');
         return $total;
      }
   }

   public function totalIsExist()
   {
      if ($this->atlet->isEmpty()) {
         return Null;
      }else{
         foreach ($this->atlet as $atlet)
         {
            $total = $atlet->pivot->sum('sk_bayar');
         }
         return $total;
         // return $this->total();
      }
   }
}
