<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Prestasi;

class PrestasiController extends Controller
{
    public function index()
    {
        if (!$data_prestasi = Prestasi::orderBy('pre_date','DESC')->get())
        {
            return abort(404);
        }
        return view('admin.prestasi.prestasi', ['data_prestasi'=>$data_prestasi]);
    }

    public function store(Request $request)
    {
        //Validate form input
        $request->validate([
            'pre_title' => 'required|string|max:128',
            'pre_date'  => 'required|date',
            'pre_isi'   => 'required',
            'img_pre'   => 'nullable|image|max:2048'
        ]);

        if ($prestasi = Prestasi::create($request->all()))
        {
            if($request->file('img_pre') == NULL)
            {
                $prestasi->img_pre = 'default.png';
            } 
            else
            {
                $file              = $request->file('img_pre');
                $fileName          = '(BridgeGunadarma)'.$prestasi->pre_date.'.'.$file->getClientOriginalExtension();
                $file->move("assets/img/img_pre", $fileName);
                $prestasi->img_pre = $fileName;
            }
            $prestasi->save();
            return redirect('/prestasi')->with('AlertSuccess','Data Prestasi berhasil ditambahkan!');
        }
        return abort(404);
    }

    public function show(Prestasi $prestasi)
    {
        $data_atlet = \App\Atlet::orderBy('atlet_name','ASC')->get();
        return view('admin.prestasi.DetailPrestasi',compact('prestasi','data_atlet'));
    }

    public function edit(Prestasi $prestasi)
    {
        return view('admin.prestasi.EditPrestasi',compact('prestasi'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        //Validate form input
        $request->validate([
            'pre_title' => 'required|string|max:128',
            'pre_date'  => 'required|date',
            'pre_isi'   => 'required',
            'img_pre'   => 'nullable|image|max:2048'
        ]);

        if ($request->img_pre != NULL)
        {
            if ($prestasi->exists('img_pre') && $prestasi->img_pre != 'default.png') 
            {
                $imageFile = public_path("assets/img/img_pre/".$prestasi->img_pre);
                File::delete($imageFile);
            }
        }
        $prestasi->update($request->all());
        if ($request->img_pre != NULL) 
        {
            $file       = $request->file('img_pre');
            $fileName   = '(BridgeGunadarma)'.$prestasi->pre_date.'.'.$file->getClientOriginalExtension();
            $file->move("assets/img/img_pre", $fileName);
            $prestasi->img_pre = $fileName;
            $prestasi->save();
        }
        else
        {
            $request->img_pre = $prestasi->img_pre;
        }
        
        return redirect('/prestasi')->with('AlertSuccess','Data '.$prestasi->atlet_name.' berhasil diperbaharui!');
    }

    public function destroy(Prestasi $prestasi)
    {
        if (Prestasi::destroy($prestasi->id))
        {
            $imageFile = public_path("assets/img/img_pre/{$prestasi->img_pre}");
            if (File::exists($imageFile))
            {
                unlink($imageFile);
            }
            $prestasi->atlet()->detach($prestasi->atlet);
            return redirect('/prestasi')->with('AlertSuccess','Data Prestasi berhasil dihapus!');
        }
        return abort(500);
    }

    public function addAtlet(Request $request, Prestasi $prestasi)
    {
        if($prestasi->atlet()->where('atlet_id',$request->atlet)->exists())
        {
            return redirect()->back()->with('ErrorInput',
                '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    Data atlet sudah ada
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
                Atlet berhasil ditambahkan
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>');
    }

    public function removeAtlet(Prestasi $prestasi, $atlet)
    {
        $prestasi->atlet()->detach($atlet);
        return redirect()->back()->with('AlertSuccess','<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            Data prestasi berhasil dihapus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
    }
}
