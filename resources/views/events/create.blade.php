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
<form method="POST" action="{{route('events.store')}}">
    @csrf
    <div class="form-group">
      <label for="num">Schedule Number</label>
      <input type="number" name="schedule_number" class="form-control" id="num" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
      <label for="type">Type</label>
      <input type="text" name="type" class="form-control" id="type" aria-describedby="emailHelp">
    </div>
     <div class="form-group">
      <label for="delivery">Adderss</label>
      <input type="text" name="delivery_route" class="form-control" id="delivery" aria-describedby="emailHelp" >
    </div> 

    <div class="form-group">
      <label  for="event_item">Shipped Item</label>
      <select multiple name="items[]" class="form-control" id="event_item">
          @foreach ($items as $item)
          <option value="{{$item->id}}">{{$item->weight}}-{{$item->dimension}}-{{$item->destination}}</option>
          @endforeach
      </select>
    </div>
    
    <button type="submit" class="btn btn-success">Create Transportation Event</button>
  </form>

 

@endsection