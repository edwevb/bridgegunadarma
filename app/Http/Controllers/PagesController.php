<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class PagesController extends Controller
{
    public function home()
    {
		$data_atlet     = \App\Atlet::orderBy('atlet_name','Asc')
                            ->where('home', 1)
                            ->get();

		$data_prestasi = \App\Prestasi::orderBy('pre_date','Desc')
                            ->take(3)
                            ->get();

        $data_event    = \App\Event::orderBy('eve_date','Desc')
                            ->take(3)
                            ->get();

    	return view('index',
                [
                    'data_atlet'    => $data_atlet,
                    'data_prestasi' => $data_prestasi,
                    'data_event'    => $data_event
		    	]);
    }

    public function moreAtlet()
    {
        $data_atlet = \App\Atlet::orderBy('atlet_name','Asc')->get();
        return view('home.HomeMoreAtlet',compact('data_atlet'));
    }

    public function detailAtlet(\App\Atlet $atlet)
    {
        return view('home.HomeDetailAtlet',compact('atlet'));
    }

    public function morePrestasi()
    {
        $data_prestasi = \App\Prestasi::orderBy('pre_date','Desc')->get();
        return view('home.HomeMorePrestasi',compact('data_prestasi'));
    }

    public function detailPrestasi(\App\Prestasi $prestasi)
    {
        return view('home.HomeDetailPrestasi',compact('prestasi'));
    }

    public function moreEvent()
    {
        $data_event = \App\Event::orderBy('eve_date','Desc')->get();
        return view('home.HomeMoreEvent',compact('data_event'));
    }


    public function detailEvent(\App\Event $event)
    {
        return view('home.HomeDetailEvent',compact('event'));
    }
}
