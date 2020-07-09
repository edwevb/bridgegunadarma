<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Atlet;
use PDF;
class AtletController extends Controller
{
    public function index()
    {
        $data_atlet = Atlet::orderBy('atlet_name','ASC')->get();
        return view('admin.atlet.atlet', ['data_atlet'=>$data_atlet]);
    }

    //Cara 1
    // $atlet             = new Atlet;
     // $atlet->nik        = $request->nik;
     // $atlet->save();

     //Cara 2
     /*Atlet::create([
        'nik'        => $request->nik,
        'atlet_name' => $request->atlet_name,
     ]);*/

    public function validateAtlet($request)
    {
        $request->validate([
            'nik'        => 'required|alpha_num|max:17',
            'atlet_name' => 'required|alpha_spaces|max:64',
            'tgl_lahir'  => 'required|date',
            'gender'     => 'required|alpha|max:6',
            'telp'       => 'required|numeric|digits_between:1,14',
            'email'      => 'required|email|max:64',
            'alamat'     => 'nullable|string|max:256',
            'fakultas'   => 'required|alpha_spaces|max:64',
            'jurusan'    => 'required|alpha_spaces|max:64',
            'angkatan'   => 'nullable|numeric|digits:4',
            'fb'         => 'nullable|string|max:128',
            'twt'        => 'nullable|string|max:128',
            'ig'         => 'nullable|string|max:128',
            'img_atlet'  => 'nullable|image|max:2048'
        ]);
        return $request;
    }

    public function store(Request $request)
    {   
        $this->validateAtlet($request);

        if ($atlet = Atlet::create($request->all()))
        {
            if($request->hasFile('img_atlet'))
            {
                $file     = $request->file('img_atlet');
                $fileName = $atlet->nik.'.'.$file->getClientOriginalExtension();
                $file->move("assets/img/img_atlet", $fileName);
                $atlet->img_atlet = $fileName;
            }
            else{
                $atlet->img_atlet = 'default.png';
            }
            $atlet->save();
            return redirect('/atlet')->with('AlertSuccess','Data Atlet berhasil ditambahkan!');
        }
    }

    public function show(Atlet $atlet)
    {
        $data_prestasi = \App\Prestasi::orderBy('pre_date','DESC')->get();
        $data_history  = \App\History::orderBy('hist_date','DESC')->get();
        $sort_prestasi = $atlet->prestasi()->orderBy('pre_date', 'DESC')->get();
        $sort_history  = $atlet->history()->orderBy('hist_date', 'DESC')->get();
        $data_mpoint   = \App\Masterpoint::all();
        return view('admin.atlet.DetailAtlet',compact('atlet','data_prestasi','data_history','data_mpoint','sort_history','sort_prestasi'));
    }

    public function edit(Atlet $atlet)
    {
        return view('admin.atlet.EditAtlet',compact('atlet'));
    }

    public function update(Request $request, Atlet $atlet)
    {
        $this->validateAtlet($request);

        $atlet->update($request->all());
        if ($request->hasFile('img_atlet'))
        {
            $file      = $request->file('img_atlet');
            $imagePath = public_path("assets/img/img_atlet/{$atlet->img_atlet}");
            if (isset($atlet->img_atlet) && $atlet->img_atlet != 'default.png' && file_exists($imagePath)) 
            {
                unlink($imagePath);
            }
            if ($file->isValid())
            {
                $fileName   = $atlet->nik.'.'.$file->getClientOriginalExtension();
                $file->move("assets/img/img_atlet", $fileName);
                $atlet->img_atlet = $fileName;
                $atlet->save();
            }
        }
        return redirect('/atlet')->with('AlertSuccess','Data '.$atlet->atlet_name.' berhasil diperbaharui!');
    }

    public function destroy(Atlet $atlet)
    {
        if (Atlet::destroy($atlet->id))
        {
            $imagePath = public_path("assets/img/img_atlet/{$atlet->img_atlet}");
            if ($atlet->img_atlet != 'default.png' && file_exists($imagePath)) 
            {
                unlink($imagePath);
            }
            $atlet->masterpoint()->delete($atlet->masterpoint);
            $atlet->prestasi()->detach($atlet->prestasi, $atlet->history, $atlet->iuranSk);
            return redirect('/atlet')->with('AlertSuccess','Data Atlet berhasil dihapus!');
        }
        return abort(500);
    }

    public function addPrestasi(Request $request, Atlet $atlet)
    {
        $request->validate([
            'prestasi'    => 'required',
        ]);

        if ($atlet->prestasi()->where('prestasi_id',$request->prestasi)->exists())
        {
            return redirect()->back()->with('ErrorInputPre',
                '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    Data Prestasi sudah ada!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
        }
        $atlet->prestasi()->attach($request->prestasi);
        return redirect()->back()->with('AlertSuccessPre',
            '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                Data Prestasi '.$atlet->atlet_name.' berhasil ditambahkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>');
    }

    public function removePrestasi(Atlet $atlet, $prestasi)
    {
        $atlet->prestasi()->detach($prestasi);
        return redirect()->back()->with('AlertSuccessPre','<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            Data Prestasi '.$atlet->atlet_name.' berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
    }

    public function addHistory(Request $request, Atlet $atlet)
    {
        $request->validate([
            'history'    => 'required',
        ]);

        if ($atlet->history()->where('history_id',$request->history)->exists())
        {
            return redirect()->back()->with('ErrorInputHist',
                '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    Data Pelatihan sudah ada!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
        }
        $atlet->history()->attach($request->history);
        return redirect()->back()->with('AlertSuccessHist',
            '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                Data Pelatihan '.$atlet->atlet_name.' berhasil ditambahkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>');
    }

    public function removeHistory(Atlet $atlet, $history)
    {
        $atlet->history()->detach($history);
        return redirect()->back()->with('AlertSuccessHist','<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            Data Pelatihan '.$atlet->atlet_name.' berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
    }

    public function exportPdf()
    {
        $atlet = Atlet::orderBy('atlet_name','ASC')->get();
        $atletPdf = PDF::loadview('admin.atlet.PdfAtlet',['atlet' => $atlet])->setPaper('a4', 'landscape');
        return $atletPdf->download('AtletBridgeGunadarma.pdf');
    }
}
