<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Atlet;
use App\Materi;
use App\History;
use App\Masterpoint;
class UserPageController extends Controller
{
    public function _dashboard()
    {
        $data_ann = DB::table('tb_ann')->first();
        return view('user._dashboard',compact('data_ann'));
    }

    public function _materi()
    {
		$data_materi = Materi::orderBy('mat_date','DESC')->get();
		return view('user._materi',compact('data_materi'));
    }

    public function show_materi(Materi $materi)
    {
    	return view('user.detail_materi',compact('materi'));
    }

    public function _materiDownload(Materi $materi)
    {
        if($materi->file_mat != NULL)
        {
            $filepath = public_path("assets/file/file_mat/{$materi->file_mat}");
            if(file_exists($filepath))
            {
                return response()->download($filepath);
                // return response()->file($filepath);
            }
            return redirect()->back()->with('AlertDanger','File tidak tersedia. Silahkan download kembali lain waktu.');
        }
        return redirect()->back()->with('AlertWarning','File belum tersedia. Silahkan download kembali lain waktu.');
    }

    public function _history()
    {
		$data_history = History::orderBy('hist_date','DESC')->get();
		return view('user._history',compact('data_history'));
    }

    public function show_history(History $history)
    {
    	return view('user.detail_history',compact('history'));
    }

    public function _historyDownload(History $history)
    {
        if($history->hist_dist != NULL)
        {
            $filepath = public_path("assets/file/hist_dist/{$history->hist_dist}");
            if(file_exists($filepath))
            {
                return response()->download($filepath);
            }
            return redirect()->back()->with('AlertDanger','File tidak tersedia. Silahkan download kembali lain waktu.');
        }
        return redirect()->back()->with('AlertWarning','File belum tersedia. Silahkan download kembali lain waktu.');
    }

    public function _masterpoint()
    {
		$data_mpoint = Masterpoint::all();
        $data_mpoint->map(function($avg){
                            $avg->AvarageMasterpoint = $avg->AvarageMasterpoint();
                            return $avg;
                        });
        $data_mpoint = $data_mpoint->sortByDesc('AvarageMasterpoint');
		return view('user._masterpoint',compact('data_mpoint'));
    }

    public function show_masterpoint(Masterpoint $masterpoint)
    {
    	return view('user.detail_masterpoint',compact('masterpoint'));
    }
}
