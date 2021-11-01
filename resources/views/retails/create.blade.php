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
<form method="POST" action="{{route('retails.store')}}">
    @csrf
    <div class="form-group">
      <label for="type">Type</label>
      <input type="text" name="type" class="form-control" id="type" aria-describedby="emailHelp">
    </div>
     <div class="form-group">
      <label for="address">Adderss</label>
      <input type="text" name="address" class="form-control" id="address" aria-describedby="emailHelp" >
    </div> 
    
    <button type="submit" class="btn btn-success">Create Retail Center</button>
  </form>

 

@endsection