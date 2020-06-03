<?php

namespace App\Http\Controllers;

use App\Pesan;
use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class PesanController extends Controller
{

    public function index()
    {
        if (auth()->user()->role_id != 1) {
            return abort(403,'Access Forbidden!');
        }
        $data_pesan = Pesan::orderBy('created_at', 'desc')->get();
        return view('admin.pesan',['data_pesan'=>$data_pesan]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'pesan' => 'required',
        ]);

        if ($pesan = Pesan::create($request->all()))
        {
            return redirect('/dashboard')->with('AlertSuccess','Pesan terkirim! Terima kasih.');
        }
        return abort(500);
    }

    public function show(Pesan $pesan)
    {
        return view('admin.DetailPesan',compact('pesan'));
    }

    public function edit(Pesan $pesan)
    {
        //
    }

    public function update(Request $request, Pesan $pesan)
    {
        //
    }

    public function destroy(Pesan $pesan)
    {
        if (auth()->user()->role_id != 1) {
            return abort(403,'Access Forbidden!');
        }
        Pesan::destroy($pesan->id);
        return redirect('/pesan')->with('AlertSuccess','Pesan berhasil dihapus!');
    }

    public function makePesan()
    {
        return view('user._pesan');
    }
}
