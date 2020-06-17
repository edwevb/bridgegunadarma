<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        $data_ann      = DB::table('tb_ann')->first();
        $data_atlet    = \App\Atlet::count();
        $data_prestasi = \App\Prestasi::count();
        $data_materi   = \App\Materi::count();
        $data_history  = \App\History::count();
        $data_event    = \App\Event::count();
        $data_pesan    = \App\Pesan::count();
        return view('admin.dashboard.dashboard',
            compact(
                'data_ann',
                'data_atlet',
                'data_prestasi',
                'data_materi',
                'data_history',
                'data_event',
                'data_pesan'
            )); 
    }

    public function update(Request $request, $id)
    {
        $affected = DB::table('tb_ann')
              ->where('id', $id)
              ->update([
                    'ann_title' => $request->ann_title,
                    'ann_date'  => now(),
                    'ann_isi'   => $request->ann_isi
                    ]);
        return redirect('/dashboard')->with('AlertSuccess','Announcement berhasil diperbaharui!');
    }

    public function passwordForm(\App\User $user)
    {
        if ($user->id != auth()->user()->id)
        {
            return abort(403,'Access Forbidden');
        }
        return view('user.password',compact('user'));
    }

    public function changePassword(Request $request, \App\User $user)
    {
        $request->validate([
            'password'         => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password'
        ]);

        \App\User::where('id', $user->id)
            ->update([
                'password' => bcrypt($request->password)
            ]);
        Auth::logout();
        return redirect('/login')->with('AlertSuccess','Password berhasil diperbaharui! Silahkan Login kembali');
    }
}
