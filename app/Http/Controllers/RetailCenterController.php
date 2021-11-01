<?php

namespace App\Http\Controllers;

use App\Models\RetailCenter;
use Illuminate\Http\Request;

class RetailCenterController extends Controller
{
    
    public function index()
    {
        return view('retails.index', ['retails' => RetailCenter::all()]);
    }

  
    public function create()
    {
        return view('retails.create');
    }

  
    public function store(Request $request)
    {
        RetailCenter::create($request->all());
        session()->flash('message','created successsfully');
        return redirect()->route('retails.index');
    }

  
    public function edit($centerId)
    {
        $retail = RetailCenter::find($centerId);
        if($retail == null){ 
            session()->flash('error','center not found');
            return back();
        } 
        return view('retails.edit',['retail' => $retail]);
    }

    public function update(Request $request, $centerId)
    {
        $singleCenter = RetailCenter::findOrFail($centerId);
        if($singleCenter == null){ 
            session()->flash('error','center not found');
            return back();
        } 
        $singleCenter->update([
            'type' => $request->type,
            'address' => $request->address,
            
        ]);
        session()->flash('message','updated successsfully');
        return redirect()->route('retails.index');
    }

   
    public function destroy($retailId)
    {
        $singleretail = RetailCenter::findOrFail($retailId);
        if($singleretail == null){ 
            session()->flash('error','center not found');
            return back();
        } 
        $singleretail->delete();
        session()->flash('message','deleted successsfully');
        return redirect()->route('retails.index');
    }
}
