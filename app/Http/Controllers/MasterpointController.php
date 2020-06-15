<?php

namespace App\Http\Controllers;

use App\Masterpoint;
use Illuminate\Http\Request;

class MasterpointController extends Controller
{

    public function index()
    {
        $data_mpoint = Masterpoint::all();
        $data_mpoint->map(function($avg){
            $avg->AvarageMasterpoint = $avg->AvarageMasterpoint();
            return $avg;
        });
        $data_mpoint = $data_mpoint->sortByDesc('AvarageMasterpoint');
        
        $data_atlet  = \App\Atlet::orderBy('atlet_name','asc')->get();
        return view('admin.masterpoint.masterpoint', compact('data_mpoint','data_atlet'));
    }

    public function store(Request $request, Masterpoint $masterpoint)
    {
         $request->validate([
            'atlet_id'   => 'required',
            'discipline' => 'required|numeric|between:1.10',
            'bidding'    => 'required|numeric|between:1.10',
            'play'       => 'required|numeric|between:1.10'
        ]);
         if ($masterpoint->where('atlet_id',$request->atlet_id)->exists()){
             return redirect()->back()->with('AlertWarning',
                '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    Data Masterpoint Atlet sudah ada!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
         }else{
            $masterpoint = Masterpoint::create($request->all());
            return redirect('/masterpoint')->with('AlertSuccess','Data Masterpoint berhasil ditambahkan!');
         }
        
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
