<?php

namespace App\Http\Controllers;

use App\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $data_materi = Materi::orderBy('mat_date','DESC')->get();
        return view('admin.materi.materi',['data_materi'=>$data_materi]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mat_title' => 'required|max:128',
            'mat_date'  => 'required|date',
            'file_mat'  => 'required|file|max:10024'
        ]);

        if ($materi = Materi::create($request->all()))
        {
            $file             = $request->file('file_mat');
            $file_extension   = $file->getClientOriginalExtension();
            $fileName         = '(BridgeFile)'.$request->mat_title.'.'.$file_extension;
            $file->move("assets/file/file_mat", $fileName);
            $materi->file_mat = $fileName;
            $materi->save();
        }
        return redirect('/materi')->with('AlertSuccess','Data Materi berhasil ditambahkan!');
    }

    public function show(Materi $materi)
    {
        return view('admin.materi.DetailMateri',compact('materi'));
    }

    public function edit(Materi $materi)
    {
        return view('admin.materi.EditMateri',compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
         $request->validate([
            'mat_title' => 'required|max:128',
            'mat_date'  => 'required|date',
            'file_mat'  => 'nullable|file|max:10024'
        ]);

        $materi->update($request->all());
        if ($request->hasFile('file_mat'))
        {
            $file      = $request->file('file_mat');
            $filePath = public_path("assets/file/file_mat/{$materi->file_mat}");
            if (isset($materi->file_mat) && file_exists($filePath)) 
            {
                unlink($filePath);
            }
            if ($file->isValid())
            {
                $file_extension   = $file->getClientOriginalExtension();
                $fileName         = '(BridgeFile)'.$request->mat_title.'.'.$file_extension;
                $file->move("assets/file/file_mat", $fileName);
                $materi->file_mat = $fileName;
                $materi->save();
            }
        }
        return redirect('/materi')->with('AlertSuccess','Data '.$materi->mat_title.' diperbaharui!');
    }

    public function destroy(Materi $materi)
    {
        if (Materi::destroy($materi->id))
        {
            $filePath = public_path("assets/file/file_mat/{$materi->file_mat}");
            if (file_exists($filePath)) 
            {
                unlink($filePath);
            }
            return redirect('/materi')->with('AlertSuccess','Data Materi berhasil dihapus!');
        }
        return abort(500); 
    }

    public function download(Materi $materi)
    {
        if($materi->file_mat != NULL)
        {
            $filepath = public_path("assets/file/file_mat/{$materi->file_mat}");
            if(file_exists($filepath))
            {
                return response()->download($filepath);
                // return response()->file($filepath);
            }
            return redirect()->back()->with('AlertDanger','File belum tersedia. Silahkan download kembali lain waktu.');
        }
        return redirect()->back()->with('AlertWarning','File belum tersedia. Silahkan download kembali lain waktu.');
    }

}
