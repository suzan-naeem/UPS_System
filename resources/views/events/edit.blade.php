@extends('layouts.app')

@section('title')Edit Page @endsection

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
<form method="POST" action="{{route('events.update',['event' => $event->schedule_number])}}">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="type">Type</label>
      <input type="text" name="type" class="form-control" id="type" aria-describedby="emailHelp" value="{{ $event->type }}">
    </div>
    <div class="form-group">
      <label for="delivery">Delivery Route</label>
      <input type="text" name="delivery_route" class="form-control" id="delivery" aria-describedby="emailHelp" value="{{ $event->delivery_route }}">
    </div>

    <div class="form-group">
      <label  for="event_item">Shipped Item<</label>
      <select multiple name="items[]" class="form-control" id="event_item">
          @foreach ($items as $item)
          <option {{in_array($item->id,$transEv)? 'selected' : ''}} value="{{$item->id}}">{{$item->weight}}-{{$item->dimension}}-{{$item->destination}}</option>
          @endforeach
      </select>
    </div>
   
    <button type="submit" class="btn btn-primary">Update Transportation Event</button>
  </form>

@endsection