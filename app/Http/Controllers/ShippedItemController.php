<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippedItem;
use App\Models\RetailCenter;
use App\Models\TransportationEvent;
use App\Models\ItemTransportation;

class ShippedItemController extends Controller
{
   
    public function index()
    {
        return view('items.index', ['items' => ShippedItem::all()]);
    }

    public function create()
    {
       
        return view('items.create',[
            'retails' => RetailCenter::all(),
            'events' => TransportationEvent::all()
        ]);
    }

   
    public function store(Request $request)
    {
        $shippedItem =  ShippedItem::create( $request->all());
        foreach($request->events as $value){
            $item = new ItemTransportation();
            $item->transportation_event_schedule_num = $value;
            $item->shipped_item_id = $shippedItem->id;
            $item->save(); 
        }
        session()->flash('message','created successsfully');
        return redirect()->route('items.index');
    }

   
    public function edit($itemId)
    {
        $item = ShippedItem::find($itemId);
        if($item == null){ 
            session()->flash('error','item not found');
            return back();
        } 
        $transArray = Array();
        foreach($item->transEventRelation as $value){
         array_push($transArray,$value->schedule_number); 
        }
        return view('items.edit',['item' => $item , 'retails' => RetailCenter::all() , 'transEv' => $transArray , 'events' => TransportationEvent::all()]);

    }

   
    public function update(Request $request, $itemId)
    {
        $singleItem = ShippedItem::findOrFail($itemId);
        if($singleItem == null){ 
            session()->flash('error','item not found');
            return back();
        } 
        $singleItem->update([
            'weight' => $request->weight,
            'dimension' => $request->dimension,
            'insurance_amt' => $request->insurance_amt,
            'destination' => $request->dimension,
            'final_delivery_date' => $request->final_delivery_date,
            'retail_center_id' => $request->retail_center_id,

        ]);
        foreach(ItemTransportation::where('shipped_item_id','=',$itemId)->get() as $value){
            $value->delete();
        }
        foreach($request->events as $value){
            $item = new ItemTransportation();
            $item->transportation_event_schedule_num = $value;
            $item->shipped_item_id = $singleItem->id;
            $item->save();    
        }
        session()->flash('message','updated successsfully');
        return redirect()->route('items.index');
    }

    public function destroy($itemId)
    {
        $singleItem = ShippedItem::findOrFail($itemId);
        if($singleItem == null){ 
            session()->flash('error','item not found');
            return back();
        } 
        $singleItem->delete();
        session()->flash('message','deleted successsfully');
        return redirect()->route('items.index');
    }
}
