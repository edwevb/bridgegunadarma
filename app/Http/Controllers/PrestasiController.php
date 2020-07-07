<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Prestasi;

class PrestasiController extends Controller
{
    public function index()
    {
        $data_prestasi = Prestasi::orderBy('pre_date','DESC')->get();
        return view('admin.prestasi.prestasi', ['data_prestasi'=>$data_prestasi]);
    }

    public function validatePrestasi($request)
    {
        $request->validate([
            'pre_title' => 'required|string|max:128',
            'pre_date'  => 'required|date',
            'pre_isi'   => 'required',
            'img_pre'   => 'nullable|image|max:2048'
        ]);
        return $request;
    }

    public function store(Request $request)
    {
        $this->validatePrestasi($request);

        if ($prestasi = Prestasi::create($request->all()))
        {
            if($request->hasFile('img_pre'))
            {
                $file     = $request->file('img_pre');
                $fileName = '(BridgeGunadarma)'.$prestasi->pre_date.'.'.$file->getClientOriginalExtension();
                $file->move("assets/img/img_pre", $fileName);
                $prestasi->img_pre = $fileName;
            }
            else{
                $prestasi->img_pre = 'default.png';
            }
            $prestasi->save();
            return redirect('/prestasi')->with('AlertSuccess','Data Prestasi berhasil ditambahkan!');
        }
    }

    public function show(Prestasi $prestasi)
    {
        $data_atlet = \App\Atlet::orderBy('atlet_name','ASC')->get();
        $sort_atlet = $prestasi->atlet()->orderBy('atlet_name', 'ASC')->get();
        return view('admin.prestasi.DetailPrestasi',compact('prestasi','data_atlet','sort_atlet'));
    }

    public function edit(Prestasi $prestasi)
    {
        return view('admin.prestasi.EditPrestasi',compact('prestasi'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $this->validatePrestasi($request);
        
        $prestasi->update($request->all());
        if ($request->hasFile('img_pre'))
        {
            $file      = $request->file('img_pre');
            $imagePath = public_path("assets/img/img_pre/{$prestasi->img_pre}");
            if (isset($prestasi->img_pre) && $prestasi->img_pre != 'default.png' && file_exists($imagePath)) 
            {
                unlink($imagePath);
            }
            if ($file->isValid())
            {
                $fileName = '(BridgeGunadarma)'.$prestasi->pre_date.'.'.$file->getClientOriginalExtension();
                $file->move("assets/img/img_pre", $fileName);
                $prestasi->img_pre = $fileName;
                $prestasi->save();
            }
        }
        return redirect('/prestasi')->with('AlertSuccess','Data '.$prestasi->pre_title.' berhasil diperbaharui!');
    }

    public function destroy(Prestasi $prestasi)
    {
        if (Prestasi::destroy($prestasi->id))
        {
            $imagePath = public_path("assets/img/img_pre/{$prestasi->img_pre}");
            if ($prestasi->img_pre != 'default.png' && file_exists($imagePath)) 
            {
                unlink($imagePath);
            }
            $prestasi->atlet()->detach($prestasi->atlet);
            return redirect('/prestasi')->with('AlertSuccess','Data Prestasi berhasil dihapus!');
        }
        return abort(500);
    }

    public function addAtlet(Request $request, Prestasi $prestasi)
    {
        $request->validate([
            'atlet'    => 'required',
        ]);

        if($prestasi->atlet()->where('atlet_id',$request->atlet)->exists())
        {
            return redirect()->back()->with('ErrorInput',
                '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    Atlet sudah ada !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
        }
        // With pivot 
        // $prestasi->atlet()->attach($request->atlet,['pivot'=>$request->pivot]);
        $prestasi->atlet()->attach($request->atlet);
        return redirect()->back()->with('AlertSuccess',
            '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                Atlet berhasil ditambahkan !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>');
    }

    public function removeAtlet(Prestasi $prestasi, $atlet)
    {
        $prestasi->atlet()->detach($atlet);
        return redirect()->back()->with('AlertSuccess','<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            Atlet berhasil dihapus !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
    }
}
