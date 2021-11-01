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

<a href="{{route('items.create')}}" class="btn btn-success" style="margin-bottom: 20px;">Create Shipped Item</a>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Weight</th>
        <th scope="col">Dimension</th>
        <th scope="col">Insurance Amount</th>
        <th scope="col">Destination</th>
        <th scope="col">Fainal Delivery Date</th>
        <th scope="col">Retail Center Type</th>
        <th scope="col">Transportation Event Type</th>
        <th scope="col">created at</th>
        <th scope="col">Actions</th>

      </tr>
    </thead>
    <tbody>
    @foreach($items as $item)

      <tr>
        <th scope="row">{{ $item->id }}</th>
        <td>{{ $item->weight ? $item->weight : 'weight not found'}}</td>
        <td>{{$item->dimension ? $item->dimension : 'dimension not found'}}</td>
        <td>{{$item->insurance_amt ? $item->insurance_amt: 'insurance amount not found'}}</td>
        <td>{{$item->destination ? $item->destination : 'destination not found'}}</td>
        <td>{{$item->final_delivery_date ? $item->final_delivery_date : 'final delivery date not found'}}</td>
        <td>{{$item->retailCenterRelation->type ?? 'retail center not found'}}</td>
        <td>@foreach($item->transEventRelation as $value)   
        {{  $value->type }}-{{  $value->delivery_route}}
        <br>
        @endforeach
        </td>
        <td>{{$item->created_at->format('Y-m-d')}}</td>
        <td>
         
        <a href="{{ route('items.edit',['item' => $item->id]) }}"class="btn btn-primary" style="margin-bottom: 20px;">Edit Shipped Item</a>
        <button style="display:inline !important; margin-top:-20px !important" class="btn btn-danger" data-toggle="modal" data-target="#del_item_{{$item->id}}">Delete</button>
           </td>
          </tr>
           <div id="del_item_{{$item->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form style="display:inline !important" method="POST"  action="{{route('items.destroy', ['item' => $item->id])}}">
                  @csrf
                  @method('DELETE')
                  <div class="modal-body">
                      <h4>Do you want to delete this item?</h4>
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