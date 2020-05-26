<?php

namespace App\Http\Controllers;

use App\Masterpoint;
use Illuminate\Http\Request;

class MasterpointController extends Controller
{

    public function index()
    {
        $data_mpoint = Masterpoint::orderBy('atlet_id','asc')->get();
        $data_atlet  = \App\Atlet::orderBy('atlet_name','asc')->get();
        return view('admin.masterpoint.masterpoint', compact('data_mpoint','data_atlet'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'atlet_id'   => 'required|unique:tb_masterpoint',
            'discipline' => 'required|numeric|between:1,10',
            'bidding'    => 'required|numeric|between:1,10',
            'play'       => 'required|numeric|between:1,10'
        ]);
        $masterpoint = Masterpoint::create($request->all());
        return redirect('/masterpoint')->with('AlertSuccess','Data Masterpoint berhasil ditambahkan!');
    }

    public function edit(Masterpoint $masterpoint)
    {
        return view('admin.masterpoint.EditMasterpoint', compact('masterpoint'));
    }

    public function update(Request $request, Masterpoint $masterpoint)
    {
         $request->validate([
            'discipline' => 'required|numeric|between:1,10',
            'bidding'    => 'required|numeric|between:1,10',
            'play'       => 'required|numeric|between:1,10'
        ]);
        $masterpoint->update($request->all());
        return redirect('/masterpoint')->with('AlertSuccess','Data Masterpoint berhasil diperbaharui!');
    }

    public function destroy(Masterpoint $masterpoint)
    {
        Masterpoint::destroy($masterpoint->id);
        return redirect('/masterpoint')->with('AlertSuccess','Data Masterpoint berhasil dihapus!');
    }
}
