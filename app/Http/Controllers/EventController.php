<?php

namespace App\Http\Controllers;

use App\Event;
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
            'prizepool'     => 'nullable|numeric|between:0.1,999999999999.999',
            'fee_team_open' => 'nullable|numeric|between:0.1,999999999999.999',
            'fee_team_mhs'  => 'nullable|numeric|between:0.1,999999999999.999',
            'fee_team_u21'  => 'nullable|numeric|between:0.1,999999999999.999',
            'fee_pas_open'  => 'nullable|numeric|between:0.1,999999999999.999',
            'fee_pas_mhs'   => 'nullable|numeric|between:0.1,999999999999.999',
            'fee_pas_u21'   => 'nullable|numeric|between:0.1,999999999999.999',
            'eve_url'       => 'nullable|string|max:128',
            'img_eve'       => 'nullable|image|max:2048'
        ]);

        if ($event = Event::create($request->all()))
        {   
            if($request->file('img_eve') == "")
            {
                $event->img_eve = 'default.png';
            }
            else{
                $file           = $request->file('img_eve');
                $fileName       = $event->eve_title.$event->eve_date.'.jpg'/*.getClientOriginalExtension()*/;
                $file->move("assets/img/img_eve", $fileName);
                $event->img_eve = $fileName;
            }
            $event->save();
            return redirect('/event')->with('AlertSuccess','Data Event berhasil ditambahkan!');
        }
        return abort(500); 
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
            'prizepool'     => 'nullable|numeric|between:0.1,999999999999.999',
            'fee_team_open' => 'nullable|numeric|between:0.1,999999999999.999',
            'fee_team_mhs'  => 'nullable|numeric|between:0.1,999999999999.999',
            'fee_team_u21'  => 'nullable|numeric|between:0.1,999999999999.999',
            'fee_pas_open'  => 'nullable|numeric|between:0.1,999999999999.999',
            'fee_pas_mhs'   => 'nullable|numeric|between:0.1,999999999999.999',
            'fee_pas_u21'   => 'nullable|numeric|between:0.1,999999999999.999',
            'eve_url'       => 'nullable|string|max:128',
            'img_eve'       => 'nullable|image|max:2048'
        ]);
        if ($event->update($request->all()))
        {
            if($request->file('img_eve') == NULL)
            {
                $event->img_eve = $event->img_eve;
            }
            else{
                $file           = $request->file('img_eve');
                $fileName       = $event->eve_title.$event->eve_date.'.jpg'/*.getClientOriginalExtension()*/;
                $file->move("assets/img/img_eve", $fileName);
                $event->img_eve = $fileName;
                $event->save();

                if($request->hasFile('img_eve'))
                {
                    $imageFile = public_path("assets/img/img_eve/{$event->img_eve}"); 
                    if ($request->exists($imageFile))
                    {
                         File::delete($imageFile);
                    }
                }
            }
            return redirect('/event')->with('AlertSuccess','Data '.$event->eve_title.' berhasil diperbaharui!');
        }
        return abort(500);
    }

    public function destroy(Event $event)
    {
        if (Event::destroy($event->id))
        {
            $imageFile = public_path("assets/img/img_eve/{$event->img_eve}");
            if (File::exists($imageFile))
            {
                unlink($imageFile);
            }
            return redirect('/materi')->with('AlertSuccess','Data Materi berhasil dihapus!');
        }
        return abort(500);
    }
}
