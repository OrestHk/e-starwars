@extends('admin.layouts.master_admin')
@section('title', 'order details')
@section('content')
<div id="recapOrder">
    <h3>User info :</h3>
    <div id="userRecapOrder">
        <p>Name : {{$order->user->name}}</p>
        <p>Email : {{$order->user->email}}</p>
        <p>Total price : {{$order->total_price}}</p>
        <p>Order date : {{$order->order_date}}</p>
    </div>
    <h3>Order info :</h3>
    <div id="productRecapOrder">
        @foreach($productQt as $product)
            <div>
                <p>Name : <a href="{{url('/product/'.$product->slug)}}" target="_blank">{{$product->name}}</a></p>
                <p>Price : {{$product->price}}<span class="currency">€</span></p>
                <p>Quantity : {{$product->quantity}}</p>
                <p>Total : {{$product->quantity * $product->price}}<span class="currency">€</span></p>
            </div>
        @endforeach
    </div>
</div>
@stop
