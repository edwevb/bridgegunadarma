<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
        if (!$data_event = Event::orderBy('eve_date','ASC')->get())
        {
            return abort(500);
        }
        return view('admin.event.event',compact('data_event'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'eve_title'     => 'required|string|max:128',
            'eve_date'      => 'required|date',
            'eve_isi'       => 'required|string',
            'eve_loc'       => 'required|string|max:256',
            'kontak'        => 'nullable|string',
            'prizepool'     => 'nullable|between:0,999999999999.999',
            'fee_team_open' => 'nullable|between:0,999999999999.999',
            'fee_team_mhs'  => 'nullable|between:0,999999999999.999',
            'fee_team_u21'  => 'nullable|between:0,999999999999.999',
            'fee_pas_open'  => 'nullable|between:0,999999999999.999',
            'fee_pas_mhs'   => 'nullable|between:0,999999999999.999',
            'fee_pas_u21'   => 'nullable|between:0,999999999999.999',
            'eve_url'       => 'nullable|string|max:128',
            'img_eve'       => 'nullable|image|max:2048'
        ]);
        $event = new Event;
        $event->eve_title     = $request->eve_title;
        $event->eve_date      = $request->eve_date;
        $event->eve_isi       = $request->eve_isi;
        $event->eve_loc       = $request->eve_loc;
        $event->kontak        = $request->kontak;
        $event->fee_team_open = (float) str_replace(",","",$request->fee_pas_open);
        $event->fee_team_mhs  = (float) str_replace(",","",$request->fee_team_mhs);
        $event->fee_team_u21  = (float) str_replace(",","",$request->fee_team_u21);
        $event->fee_pas_open  = (float) str_replace(",","",$request->fee_pas_open);
        $event->fee_pas_mhs   = (float) str_replace(",","",$request->fee_pas_mhs);
        $event->fee_pas_u21   = (float) str_replace(",","",$request->fee_team_u21);
        $event->prizepool     = (float) str_replace(",","",$request->prizepool);
        $event->eve_url       = $request->eve_url;
 
        if($request->file('img_eve') == NULL)
        {
            $event->img_eve = 'default.png';
        }
        else
        {
            $file           = $request->file('img_eve');
            $fileName       = $event->eve_title.$event->eve_date.'.'.$file->getClientOriginalExtension();
            $file->move("assets/img/img_eve", $fileName);
            $event->img_eve = $fileName;
        }
        $event->save();
        return redirect('/event')->with('AlertSuccess','Data Event berhasil ditambahkan!');
    }

    public function show(Event $event)
    {
        return view('admin.event.DetailEvent', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.event.EditEvent',compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'eve_title'     => 'required|string|max:128',
            'eve_date'      => 'required|date',
            'eve_isi'       => 'required|string',
            'eve_loc'       => 'required|string|max:256',
            'kontak'        => 'nullable|string',
            'prizepool'     => 'nullable|between:0,999999999999.999',
            'fee_team_open' => 'nullable|between:0,999999999999.999',
            'fee_team_mhs'  => 'nullable|between:0,999999999999.999',
            'fee_team_u21'  => 'nullable|between:0,999999999999.999',
            'fee_pas_open'  => 'nullable|between:0,999999999999.999',
            'fee_pas_mhs'   => 'nullable|between:0,999999999999.999',
            'fee_pas_u21'   => 'nullable|between:0,999999999999.999',
            'eve_url'       => 'nullable|string|max:128',
            'img_eve'       => 'nullable|image|max:2048'
        ]);

       if ($request->img_eve != NULL)
        {
            if ($event->exists('img_eve') && $event->img_eve != 'default.png') 
            {
                $imageFile = public_path("assets/img/img_eve/".$event->img_eve);
                File::delete($imageFile);
            }
        }
        Event::where('id', $event->id)
        ->update([
            'eve_title'     => $request->eve_title,
            'eve_date'      => $request->eve_date,
            'eve_isi'       => $request->eve_isi,
            'eve_loc'       => $request->eve_loc,
            'kontak'        => $request->kontak,
            'fee_team_open' => (float) str_replace(",","",$request->fee_team_open),
            'fee_team_mhs'  => (float) str_replace(",","",$request->fee_team_mhs),
            'fee_team_u21'  => (float) str_replace(",","",$request->fee_team_u21),
            'fee_pas_open'  => (float) str_replace(",","",$request->fee_pas_open),
            'fee_pas_mhs'   => (float) str_replace(",","",$request->fee_pas_mhs),
            'fee_pas_u21'   => (float) str_replace(",","",$request->fee_pas_u21),
            'prizepool'     => (float) str_replace(",","",$request->prizepool),
            'eve_url'       => $request->eve_url,
        ]);

        if ($request->img_eve != NULL) 
        {
            $file       = $request->file('img_eve');
            $fileName   = '(BridgeGunadarma)'.$event->eve_date.'.'.$file->getClientOriginalExtension();
            $file->move("assets/img/img_eve", $fileName);
            $event->img_eve = $fileName;
            $event->save();
        }
        $request->img_eve = $event->img_eve;
        return redirect('/event')->with('AlertSuccess','Data '.$event->eve_title.' berhasil diperbaharui!');
    }

    public function destroy(Event $event)
    {
        if (Event::destroy($event->id))
        {
            $imageFile = public_path("assets/img/img_eve/{$event->img_eve}");
            if($event->img_eve != NULL)
            {
                if (File::exists($imageFile))
                {
                    unlink($imageFile);
                }
            }
            return redirect('/materi')->with('AlertSuccess','Data Materi berhasil dihapus!');
        }
        return abort(500);
    }
}
