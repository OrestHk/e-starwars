@extends('admin.layouts.master_admin')
@section('title', 'order details')
@section('content')
<div id="recapOrder">
    <h3>user info</h3>
    <div id="userRecapOrder">
        <p>name : {{$order->user->name}}</p>
        <p>email : {{$order->user->email}}</p>
        <p>total price : {{$order->total_price}}</p>
        <p>order date : {{$order->order_date}}</p>
    </div>
    <h3>order info</h3>
    <div id="productRecapOrder">
        @foreach($productQt as $product)
            <div>
                <p>name : {{$product->name}}</p>
                <p>price : {{$product->price}}</p>
                <p>quantity : {{$product->quantity}}</p>
                <p>total : {{$product->quantity * $product->price}}</p>
            </div>
        @endforeach
    </div>
</div>
@stop
