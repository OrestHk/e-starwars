@extends('admin.layouts.master_admin')

@section('content')

    <p>{{$history->user->name}}</p>
    <p>{{$history->total_price}}</p>
    <p>{{$history->order_date}}</p>

    @foreach($productQt as $product)
        <p>{{$product->name}}</p>
        <p>{{$product->price}}</p>
        <p>{{$product->quantity}}</p>
    @endforeach

@stop
