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

<a href="{{route('retails.create')}}" class="btn btn-success" style="margin-bottom: 20px;">Create Center</a>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">type</th>
        <th scope="col">address</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
        
      </tr>
    </thead>
    <tbody>
    @foreach($retails as $retail)
   
      <tr>
        <th scope="row">{{ $retail->id }}</th>
        <td>{{ $retail->type ? $retail->type : 'type not found'}}</td>
        <td>{{ $retail->address ? $retail->address : 'address not found'}}</td>
        <td>{{$retail->created_at->format('Y-m-d')}}</td>
        <td>
        <a href="{{ route('retails.edit',['retail' => $retail->id]) }}"class="btn btn-primary" style="margin-bottom: 20px;">Edit Center</a>
        <button style="display:inline !important; margin-top:-20px !important" class="btn btn-danger" data-toggle="modal" data-target="#del_retail_{{$retail->id}}">Delete</button>
           </td>
          </tr>
           <div id="del_retail_{{$retail->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form style="display:inline !important" method="POST"  action="{{route('retails.destroy', ['retail' => $retail->id])}}">
                  @csrf
                  @method('DELETE')
                  <div class="modal-body">
                      <h4>Do you want to delete retail center with type {{$retail->type}} ?</h4>
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