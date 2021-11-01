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
<form method="POST" action="{{route('retails.update',['retail' => $retail->id])}}">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="type">Type</label>
      <input type="text" name="type" class="form-control" id="type" aria-describedby="emailHelp" value="{{ $retail->type }}">
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <textarea name="address" class="form-control" id="address">{{ $retail->address }} </textarea>
    </div>
   
    <button type="submit" class="btn btn-primary">Update Center</button>
  </form>

@endsection