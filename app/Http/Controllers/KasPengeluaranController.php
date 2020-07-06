<?php

namespace App\Http\Controllers;

use App\Pengeluaran;
use Illuminate\Http\Request;
use PDF;
class KasPengeluaranController extends Controller
{

    public function index()
    {
        if (!$data_pengeluaran = Pengeluaran::orderBy('p_date','ASC')->get())
        {
            return abort(500);
        }
        return view('admin.pengeluaran.pengeluaran', compact('data_pengeluaran'));
    }

    public function validatePengeluaran($request)
    {
        $request->validate([
            'p_title' => 'required|max:256',
            'p_date'  => 'required|date',
            'p_biaya' => 'required|between:0.1,999999999999.999'
        ]);
        return $request;
    }

    public function store(Request $request)
    {
        $this->validatePengeluaran($request);

        Pengeluaran::create([
            'p_title'       => $request->p_title,
            'p_date'        => $request->p_date,
            'p_biaya'       => (float) str_replace(",","",$request->p_biaya),
            'p_keterangan'  => $request->p_keterangan
        ]);

        return redirect('/pengeluaran')->with('AlertSuccess','Data Pengeluaran berhasil ditambahkan!');
    }

    public function show(Pengeluaran $pengeluaran)
    {
        return view('admin.pengeluaran.DetailPengeluaran',compact('pengeluaran'));
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        return view('admin.pengeluaran.EditPengeluaran', compact('pengeluaran'));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $this->validatePengeluaran($request);

        Pengeluaran::where('id', $pengeluaran->id)
                    ->update([
                        'p_title'      => $request->p_title,
                        'p_date'       => $request->p_date,
                        'p_biaya'      => (float) str_replace(",","",$request->p_biaya),
                        'p_keterangan' => $request->p_keterangan
                    ]);

        return redirect('/pengeluaran')->with('AlertSuccess','Data Pengeluaran berhasil diperbaharui!');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        Pengeluaran::destroy($pengeluaran->id);
        return redirect('/pengeluaran')->with('AlertSuccess','Data Pengeluaran berhasil dihapus!');
    }
}
