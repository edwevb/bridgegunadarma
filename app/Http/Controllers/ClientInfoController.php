<?php

namespace App\Http\Controllers;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClientInfoController extends Controller
{
    public function index()
    {
    	$data_client = DB::table('tb_device')->orderBy('created_at','DESC')->get();
    	return view('admin.client.clientInfo',compact('data_client'));
    }

    public function delete($id)
    {
    	DB::table('tb_device')->where('id',$id)->delete();
    	return redirect('/clientInfo')->with('AlertSuccess','Data berhasil dihapus!');
    }

    public function visit()
    {
        $data_visit = \App\Visited::orderBy('hits','DESC')->get();
        return view('admin.client.visited',compact('data_visit'));
    }

    public function deleteVisitor($id)
    {
        DB::table('tb_visited')->where('id',$id)->delete();
        return redirect('/visitor')->with('AlertSuccess','Data berhasil dihapus!');
    }

}
