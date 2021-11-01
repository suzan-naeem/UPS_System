@extends('layouts.app')

@section('title')Index Page @endsection

@section('content')

<br>
@if(session()->has('error'))
<span>{{ session('error')}}</span>
@endif
@if(session()->has('message'))
<span>{{ session('message')}}</span>
@endif
<br>

<a href="{{route('events.create')}}" class="btn btn-success" style="margin-bottom: 20px;">Create Transportation Event</a>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">type</th>
        <th scope="col">Delivery Route</th>
        <th scope="col">Shipped Item</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
        
      </tr>
    </thead>
    <tbody>
    @foreach($events as $event)
   
      <tr>
        <th scope="row">{{ $event->schedule_number}}</th>
        <td>{{ $event->type ? $event->type : 'type not found'}}</td>
        <td>{{ $event->delivery_route ? $event->delivery_route : 'delivery route not found'}}</td>
        <td>@foreach($event->shippedItemRelation as $value)   
        {{  $value->weight }}-{{  $value->dimension}}-{{  $value->destination}}
        <br>
        @endforeach
        </td>
        <td>{{$event->created_at->format('Y-m-d')}}</td>
        <td>
        <a href="{{ route('events.edit',['event' => $event->schedule_number]) }}"class="btn btn-primary" style="margin-bottom: 20px;">Edit </a>
        <button style="display:inline !important; margin-top:-20px !important" class="btn btn-danger" data-toggle="modal" data-target="#del_event_{{$event->schedule_number}}">Delete</button>
           </td>
          </tr>
           <div id="del_event_{{$event->schedule_number}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form style="display:inline !important" method="POST"  action="{{route('events.destroy', ['event' => $event->schedule_number])}}">
                  @csrf
                  @method('DELETE')
                  <div class="modal-body">
                      <h4>Do you want to delete this transportation event with schedule number {{$event->schedule_number}}   ?</h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                      <input class="btn btn-danger" type="submit" value="Yes">
                    </div>
                </form>
          </div>
        </div>
      </div>
        
    @endforeach
    </tbody>
</table>

@endsection