<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function index()
    {
        if (!$data_history = History::orderBy('hist_date','DESC')->get())
        {
            return abort(500);
        }
        
        $data_atlet = \App\Atlet::all();
        return view('admin.history.history', compact('data_history','data_atlet'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hist_title'      => 'required|string|max:128',
            'hist_date'       => 'required|date',
            'hist_loc'        => 'required|string',
            'hist_dist'       => 'nullable|file|max:10024',
            'hist_keterangan' => 'nullable'
        ]);
        if ($history = History::create($request->all()))
        {
            if ($request->hist_dist != NULL)
            {
                $file             = $request->file('hist_dist');
                $file_extension   = $file->getClientOriginalExtension();
                $fileName         = 'Distribusi'.$request->hist_date.'.'.$file_extension;
                $file->move("assets/file/hist_dist", $fileName);
                $history->hist_dist = $fileName;
            }else{
                $history->hist_dist = 'no_file';
            }
        }
        $history->save();
        return redirect('/history')->with('AlertSuccess','Data history berhasil ditambahkan!');
    }

    public function show(History $history)
    {
        $data_atlet = \App\Atlet::orderBy('atlet_name','ASC')->get();
        return view('admin.history.DetailHistory',compact('history','data_atlet'));
    }

    public function edit(History $history)
    {
        return view('admin.history.EditHistory', compact('history'));
    }

    public function update(Request $request, History $history)
    {
        $request->validate([
            'hist_title'      => 'required|string|max:128',
            'hist_date'       => 'required|date',
            'hist_loc'        => 'required|string',
            'hist_dist'       => 'nullable|file|max:10024',
            'hist_keterangan' => 'nullable'
        ]);

        $history->update($request->all());
        if ($request->hasFile('hist_dist'))
        {
            $file      = $request->file('hist_dist');
            $filePath = public_path("assets/file/hist_dist/{$history->hist_dist}");
            if (isset($history->hist_dist) && file_exists($filePath)) 
            {
                unlink($filePath);
            }
            if ($file->isValid())
            {
                $file_extension   = $file->getClientOriginalExtension();
                $fileName         = 'Distribusi'.$request->hist_date.'.'.$file_extension;
                $file->move("assets/file/hist_dist", $fileName);
                $history->hist_dist = $fileName;
                $history->save();
            }
        }
        return redirect('/history')->with('AlertSuccess','Data '.$history->hist_title.' berhasil diperbaharui!');
    }

    public function destroy(History $history)
    {
        if (History::destroy($history->id))
        {
            $filePath = public_path("assets/file/hist_dist/{$history->hist_dist}");
            if (file_exists($filePath)) 
            {
                unlink($filePath);
            }
            $history->atlet()->detach($history->atlet);
            return redirect('/history')->with('AlertSuccess','Data History berhasil dihapus!');
        }
        return abort(500);
    }

    public function addAtlet(Request $request, History $history)
    {
        if($history->atlet()->where('atlet_id',$request->atlet)->exists())
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
        // $history->atlet()->attach($request->atlet,['pivot'=>$request->pivot]);
        $history->atlet()->attach($request->atlet);
        return redirect()->back()->with('AlertSuccess',
            '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                Atlet berhasil ditambahkan
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>');
    }

    public function removeAtlet(History $history, $atlet)
    {
        $history->atlet()->detach($atlet);
        return redirect()->back()->with('AlertSuccess','<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            Data History berhasil dihapus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
    }

    public function download(History $history)
    {
        if($history->hist_dist != NULL)
        {
            $filepath = public_path("assets/file/hist_dist/{$history->hist_dist}");
            if(file_exists($filepath))
            {
                return response()->download($filepath);
                // return response()->file($filepath);
            }
            return redirect()->back()->with('AlertDanger','File tidak tersedia. Silahkan download kembali lain waktu.');
        }
        return redirect()->back()->with('AlertWarning','File belum tersedia. Silahkan download kembali lain waktu.');
    }
}
