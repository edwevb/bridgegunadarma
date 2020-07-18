<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
        $data_event = Event::orderBy('eve_date','Desc')->get();
        return view('admin.event.event',compact('data_event'));
    }

    public function validateEvent($request)
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
        return $request;
    }

    public function store(Request $request)
    {
        $this->validateEvent($request);

        $event = new Event;
        $event->eve_title     = $request->eve_title;
        $event->eve_date      = $request->eve_date;
        $event->eve_isi       = $request->eve_isi;
        $event->eve_loc       = $request->eve_loc;
        $event->kontak        = $request->kontak;
        $this->feeTeamOpen($request);
        $this->feeTeamU26($request);
        $this->feeTeamU21($request);
        $this->feePasOpen($request);
        $this->feePasMhs($request);
        $this->feePasU21($request);
        $this->prizepool($request);
        $event->eve_url       = $request->eve_url;
 
        if($request->hasFile('img_eve'))
        {
            $file     = $request->file('img_eve');
            $fileName = 'Event_'.$event->eve_date.'_'.$event->id.'.'.$file->getClientOriginalExtension();
            $file->move("assets/img/img_eve", $fileName);
            $event->img_eve = $fileName;
        }
        else{
            $event->img_eve = 'default.png';
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
        $this->validateEvent($request);

        Event::where('id', $event->id)
        ->update([
            'eve_title'     => $request->eve_title,
            'eve_date'      => $request->eve_date,
            'eve_isi'       => $request->eve_isi,
            'eve_loc'       => $request->eve_loc,
            'kontak'        => $request->kontak,
            'fee_team_open' => $this->feeTeamOpen($request),
            'fee_team_mhs'  => $this->feeTeamU26($request),
            'fee_team_u21'  => $this->feeTeamU21($request),
            'fee_pas_open'  => $this->feePasOpen($request),
            'fee_pas_mhs'   => $this->feePasMhs($request),
            'fee_pas_u21'   => $this->feePasU21($request),
            'prizepool'     => $this->prizepool($request),
            'eve_url'       => $request->eve_url,
        ]);
        
        if ($request->hasFile('img_eve'))
        {
            $file      = $request->file('img_eve');
            $imagePath = public_path("assets/img/img_eve/{$event->img_eve}");
            if (isset($event->img_eve) && $event->img_eve != 'default.png' && file_exists($imagePath)) 
            {
                unlink($imagePath);
            }
            if ($file->isValid())
            {
                $fileName = 'Event_'.$event->eve_date.'_'.$event->id.'.'.$file->getClientOriginalExtension();
                $file->move("assets/img/img_eve", $fileName);
                $event->img_eve = $fileName;
                $event->save();
            }
        }
        return redirect('/event')->with('AlertSuccess','Data '.$event->eve_title.' berhasil diperbaharui!');
    }

    public function destroy(Event $event)
    {
        if (Event::destroy($event->id))
        {
            $imagePath = public_path("assets/img/img_eve/{$event->img_eve}");
            if ($event->img_eve != 'default.png' && file_exists($imagePath)) 
            {
                unlink($imagePath);
            }
            return redirect('/event')->with('AlertSuccess','Data Event berhasil dihapus!');
        }
        return abort(500);
    }

    public function feeTeamOpen($request)
    {
        $check = $request->fee_team_open;
        if (empty($check) || $check == 0 || $check == 0.00) 
        {
            $fee_team_open = NULL;
            return $fee_team_open;
        }else{
            $event = new Event;
            $event->fee_team_open = (float) str_replace(",","", $request->fee_team_open);
            return $event->fee_team_open;
        }
    }

    public function feeTeamU26($request)
    {
        $check = $request->fee_team_mhs;
        if (empty($check) || $check == 0 || $check == 0.00) 
        {
            $fee_team_mhs = NULL;
            return $fee_team_mhs;
        }else{
            $event = new Event;
            $event->fee_team_mhs = (float) str_replace(",","", $request->fee_team_mhs);
            return $event->fee_team_mhs;
        }
    }

    public function feeTeamU21($request)
    {
        $check = $request->fee_team_u21;
        if (empty($check) || $check == 0 || $check == 0.00) 
        {
            $fee_team_u21 = NULL;
            return $fee_team_u21;
        }else{
            $event = new Event;
            $event->fee_team_u21 = (float) str_replace(",","", $request->fee_team_u21);
            return $event->fee_team_u21;
        }
    }

    public function feePasOpen($request)
    {
        $check = $request->fee_pas_open;
        if (empty($check) || $check == 0 || $check == 0.00) 
        {
            $fee_pas_open = NULL;
            return $fee_pas_open;
        }else{
            $event = new Event;
            $event->fee_pas_open = (float) str_replace(",","", $request->fee_pas_open);
            return $event->fee_pas_open;
        }
    }

    public function feePasMhs($request)
    {
        $check = $request->fee_pas_mhs;
        if (empty($check) || $check == 0 || $check == 0.00) 
        {
            $fee_pas_mhs = NULL;
            return $fee_pas_mhs;
        }else{
            $event = new Event;
            $event->fee_pas_mhs = (float) str_replace(",","", $request->fee_pas_mhs);
            return $event->fee_pas_mhs;
        }
    }

    public function feePasU21($request)
    {
        $check = $request->fee_pas_u21;
        if (empty($check) || $check == 0 || $check == 0.00) 
        {
            $fee_pas_u21 = NULL;
            return $fee_pas_u21;
        }else{
            $event = new Event;
            $event->fee_pas_u21 = (float) str_replace(",","", $request->fee_pas_u21);
            return $event->fee_pas_u21;
        }
    }

    public function prizepool($request)
    {
        $check = $request->prizepool;
        if (empty($check) || $check == 0 || $check == 0.00) 
        {
            $prizepool = NULL;
            return $prizepool;
        }else{
            $event = new Event;
            $event->prizepool = (float) str_replace(",","", $request->prizepool);
            return $event->prizepool;
        }
    }
}
