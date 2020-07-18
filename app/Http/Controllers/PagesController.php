<?php

namespace App\Http\Controllers;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PagesController extends Controller
{
    public function home()
    {
        if (DB::table('tb_device')->where('name',$this->checkClient()['name'])->exists()==false ||
            DB::table('tb_device')->where('ip',$this->checkClient()['ip'])->exists()==false)
        {
            $this->addClient();
        }
        $data_mpoint   = $this->getMasterpoint();
        $data_prestasi = $this->getPrestasi();
        $data_event    = $this->getEvent();
    	return view('index', compact('data_mpoint','data_prestasi','data_event'));
    }

    public function getMasterpoint()
    {
        $data_mpoint = \App\Masterpoint::all();
        $data_mpoint->map(function($avg)
                {
                    $avg->AvarageMasterpoint = $avg->AvarageMasterpoint();
                    return $avg;
                });
        $data_mpoint = $data_mpoint->sortByDesc('AvarageMasterpoint')->take(6);
        return $data_mpoint;
    }

    public function getPrestasi()
    {
        $data_prestasi = \App\Prestasi::orderBy('pre_date','Desc')
                        ->take(3)
                        ->get();
        return $data_prestasi;
    }

    public function getEvent()
    {
        $data_event = \App\Event::orderBy('eve_date','Desc')
                        ->take(3)
                        ->get();
        return $data_event;
    }

    public function addClient()
    {
        $agent = new Agent;
        DB::table('tb_device')
        ->insert([
            'name'       => $this->checkClient()['name'],
            'device'     => $agent->device(),
            'browser'    => $agent->browser().' '.$agent->version($agent->browser()),
            'platform'   => $agent->platform().' '.$agent->version($agent->platform()),
            'ip'         => $this->checkClient()['ip'],
            'created_at' => now()
        ]);
    }

    public function checkClient()
    {
        if (isset(auth()->user()->name))
        {
            $name = auth()->user()->name;
            $ip = \Request::ip();
        }else{
             $name = 'unknown';
             $ip = \Request::ip();
        }
        return $check = ['name'=>$name, 'ip'=>$ip];
    }

    public function moreAtlet()
    {
        $data_atlet = \App\Atlet::orderBy('atlet_name','Asc')->get();
        return view('home.HomeMoreAtlet',compact('data_atlet'));
    }

    public function detailAtlet(\App\Atlet $atlet)
    {
        $data_visited = DB::table('tb_visited')->where('atlet_id', $atlet->id)->first();
        if (empty($data_visited))
        {
            DB::table('tb_visited')
            ->insert([
                'atlet_id' => $atlet->id,
                'hits'     => 1
            ]);
            return view('home.HomeDetailAtlet',compact('atlet'));
        }else{
            \App\Visited::where('atlet_id', $atlet->id)
            ->update([
                'hits'     => $data_visited->hits + 1
            ]);
            return view('home.HomeDetailAtlet',compact('atlet'));
        }
    }

    public function morePrestasi()
    {
        $data_prestasi = \App\Prestasi::orderBy('pre_date','Desc')->get();
        return view('home.HomeMorePrestasi',compact('data_prestasi'));
    }

    public function detailPrestasi(\App\Prestasi $prestasi)
    {
        $sort_atlet = $prestasi->atlet()->orderBy('atlet_name', 'ASC')->get();
        return view('home.HomeDetailPrestasi',compact('prestasi','sort_atlet'));
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
