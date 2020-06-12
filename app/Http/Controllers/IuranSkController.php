<?php

namespace App\Http\Controllers;

use App\IuranSk;
use Illuminate\Http\Request;

class IuranSkController extends Controller
{

    public function index()
    {
        if (!$data_sk = IuranSk::orderBy('sk_tahun','DESC')->get())
        {
            return abort(500);
        }
        return view('admin.iuran_sk.iuran_sk', compact('data_sk'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'pta_ata'  => 'required',
            'sk_tahun' => 'required|max:16'
        ]);

        if ($iuranSk = IuranSK::create($request->all()))
        {
            return redirect('/iuranSk')->with('AlertSuccess','Data berhasil ditambahkan!');
        }
        return abort(500);
    }

    public function show(IuranSk $iuranSk)
    {
        $data_atlet = \App\Atlet::orderBy('atlet_name')->get();
        return view('admin.iuran_sk.DetailIuranSk',compact('iuranSk','data_atlet'));
    }

    public function edit(IuranSk $iuranSk)
    {
        //
    }

    public function update(Request $request, IuranSk $iuranSk)
    {
        //
    }

    public function destroy(IuranSk $iuranSk)
    {
        if (IuranSk::destroy($iuranSk->id))
        {
            $iuranSk->atlet()->detach($iuranSk->atlet);
        }
        return redirect('/iuranSk')->with('AlertSuccess','Data berhasil dihapus!');
    }

    public function addAtlet(Request $request, IuranSk $iuranSk)
    {
         $request->validate([
            'atlet'    => 'required',
            'sk_date'  => 'required|date',
            'sk_bayar' => 'required|between:0.1,999999999999.999'
        ]);

        if ($iuranSk->atlet()->where('atlet_id',$request->atlet)->exists())
        {
            return redirect()->back()->with('ErrorInputAtlet',
                '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    Data sudah ada!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
        }
        $iuranSk->atlet()->attach(
            $request->atlet,
            [
                'sk_date'  => $request->sk_date,
                'sk_bayar' => (float) str_replace(',','',$request->sk_bayar)
            ]);
        return redirect()->back()->with('AlertSuccessAtlet',
            '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                Data '.$iuranSk->atlet_name.' berhasil ditambahkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>');
    }

    public function removeAtlet(IuranSK $iuranSk, $atlet)
    {
        $iuranSk->atlet()->detach($atlet);
        return redirect()->back()->with('AlertSuccessAtlet','<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            Data berhasil dihapus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
    }
}
