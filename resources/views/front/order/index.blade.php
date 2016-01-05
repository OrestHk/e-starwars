@extends('front.layouts.master')

@section('title', 'your order')

@section('content')
    <div id="orderList">
        @forelse($products as $product)
            <p>model : {{$product->name}}</p>
            <img src="{{url(IMG_PATH_FRONT.$product->picture->filename)}}" />
            <p>price : {{$product->price}}</p>
            <p>quantity : {{$product->final_price / $product->price}}</p>
            <p>total product cost : {{$product->final_price}}</p>
        @empty
            <p>no order</p>
        @endforelse
        <p>total cost: {{$cost}}</p>
    </div>

    <form action="{{url('validationOrder')}}" id="orderValidation">
        <input type="text" name="name" placeholder="name" required id="CustomerName">
        <input type="email" name="name" placeholder="email" required id="CustomerMail">
        <input type="submit" id="valideOrder" value="BUY">
    </form>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
