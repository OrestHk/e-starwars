@extends('admin.layouts.master_admin')

@section('content')
<div id="recapOrder">
    <h3>user info</h3>
    <div id="userRecapOrder">
        <p>name : {{$history->user->name}}</p>
        <p>email : {{$history->user->email}}</p>
        <p>total price : {{$history->total_price}}</p>
        <p>order date : {{$history->order_date}}</p>
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
