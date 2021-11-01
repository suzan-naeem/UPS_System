@extends('layouts.app')

@section('title')Create Page @endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{route('items.store')}}">
    @csrf
    <div class="form-group">
      <label for="weight">Weight</label>
      <input type="number" name="weight" class="form-control" id="weight" aria-describedby="emailHelp">
    </div>
     <div class="form-group">
      <label for="dimension">Dimension</label>
      <input type="number" name="dimension" class="form-control" id="dimension" aria-describedby="emailHelp" >
    </div> 
    <div class="form-group">
      <label for="insurance">Insurance Amount</label>
      <input type="number" name="insurance_amt" class="form-control" id="insurance" aria-describedby="emailHelp" >
    </div> 
    <div class="form-group">
      <label for="destination">Destination</label>
      <input type="text" name="destination" class="form-control" id="destination" aria-describedby="emailHelp" >
    </div> 
    <div class="form-group">
      <label for="delivery">Final Delivery Date</label>
      <input type="date" name="final_delivery_date" class="form-control" id="delivery" aria-describedby="emailHelp" >
    </div> 

    <div class="form-group">
      <label  for="retail_item">Retail Center</label>
      <select name="retail_center_id" class="form-control" id="retail_item">
      <option>{{ $event->retailCenterRelation->type }}</option>
          @foreach ($retails as $retail)
          <option value="{{$retail->id}}">{{$retail->type}}-{{$retail->address}}</option>
          @endforeach
      </select>
    </div>

    <div class="form-group">
      <label  for="event_item">Transportation Event</label>
      <select multiple name="events[]" class="form-control" id="event_item">
          @foreach ($events as $event)
          <option value="{{$event->schedule_number}}">{{$event->type}}-{{$event->delivery_route}}</option>
          @endforeach
      </select>
    </div>
    
    <button type="submit" class="btn btn-success">Create Shipped Item</button>
  </form>

 

@endsection