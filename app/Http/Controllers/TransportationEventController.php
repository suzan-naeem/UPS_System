<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransportationEvent;
use App\Models\ShippedItem;
use App\Models\ItemTransportation;

class TransportationEventController extends Controller
{

    public function index()
    {
        return view('events.index', ['events' => TransportationEvent::all()]);
    }

    public function create()
    {
        return view('events.create',['items' => ShippedItem::all()]);
    }

    public function store(Request $request)
    {
        $transevent = TransportationEvent::create($request->all());
 
        foreach($request->items as $value){
            $item = new ItemTransportation();
            $item->shipped_item_id = $value;
            $item->transportation_event_schedule_num = $transevent->schedule_number;
            $item->save();
            
        }
        session()->flash('message','created successsfully');
        return redirect()->route('events.index');
    }

    
   
    public function edit($eventId)
    {
        $event = TransportationEvent::find($eventId);
        if($event == null){ 
            session()->flash('error','transportation event not found');
            return back();
        } 
        $itemArray = Array();
        foreach($event->shippedItemRelation as $value){
         array_push($itemArray,$value->id); 
        }
        return view('events.edit',['event' => $event , 'transEv' => $itemArray , 'items' => ShippedItem::all()]);

    }

   
    public function update(Request $request, $eventId)
    {
        $singleEvent = TransportationEvent::findOrFail($eventId);
        if($singleEvent == null){ 
            session()->flash('error','transportation event not found');
            return back();
        } 
        $singleEvent->update([
            'type' => $request->type,
            'delivery_route' => $request->delivery_route,
        ]);
        foreach(ItemTransportation::where('transportation_event_schedule_num','=',$eventId)->get() as $value){
            $value->delete();
           }
        foreach($request->items as $value){
            $item = new ItemTransportation();
            $item->shipped_item_id = $value;
            $item->transportation_event_schedule_num = $singleEvent->schedule_number;
            $item->save();    
        }
        session()->flash('message','updated successsfully');
        return redirect()->route('events.index');
    }

  
    public function destroy($eventId)
    {
        $singleEvent= TransportationEvent::where('schedule_number', '=' ,$eventId)->first();
        if($singleEvent == null){ 
            session()->flash('error','transportation event not found');
            return back();
        } 
        $singleEvent->delete();
        session()->flash('message','deleted successsfully');
        return redirect()->route('events.index');
    }
}
