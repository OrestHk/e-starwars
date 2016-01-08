@extends('front.layouts.master')

@section('title', 'Your order')

@section('content')
    @if(isset($products))
    <div id="orderList">
        <div class="ordersContainer">
            <div class="orderTitle">
                <p class="remove"></p>
                <p class="image">Image</p>
                <p class="name">Name</p>
                <p class="price">Price</p>
                <p class="quantity">Quantity</p>
                <p class="totalPrice">Total price</p>
            </div>
            @foreach($products as $product)
                <div class="orderContainer product-{{$product->id}}">
                    <div class="remove cell" data-id="{{$product->id}}">
                        <span></span>
                    </div>
                    <div class="image cell">
                        <a href="{{url('/product/'.$product->slug)}}"><img src="{{url(IMG_PATH_FRONT.$product->picture->filename)}}" /></a>
                    </div>
                    <p class="name cell"><a href="{{url('/product/'.$product->slug)}}">{{$product->name}}</a></p>
                    <p class="price cell">
                        <span class="amount">{{$product->price}}</span>
                        <span class="currency">€</span>
                    </p>
                    <p class="quantity cell">{{$product->quantity}}</p>
                    <p class="totalPrice cell">
                        <span class="amount">{{$product->final_price}}</span>
                        <span class="currency">€</span>
                        <span class="remove"></span>
                    </p>
                </div>
            @endforeach
        </div>
        @if(isset($cost))
            <p class="finalPrice">Total: <span class="amount">{{$cost}}</span><span class="currency">€</span></p>
        @endif
        <form action="{{url('validationOrder')}}" id="orderValidation">
            <div class="container-btn text">
                <input type="text" name="email" placeholder="Name" required id="CustomerName" class="btn">
                <div class="top"></div>
                <div class="right"></div>
                <div class="bot"></div>
                <div class="left"></div>
            </div>
            <div class="container-btn text">
                <input type="email" name="name" placeholder="Email" required id="CustomerMail" class="btn">
                <div class="top"></div>
                <div class="right"></div>
                <div class="bot"></div>
                <div class="left"></div>
            </div>
            <div class="container-btn submit">
                <input type="submit" class="btn" id="valideOrder" value="BUY">
                <div class="top"></div>
                <div class="right"></div>
                <div class="bot"></div>
                <div class="left"></div>
            </div>
            <div class="clear"></div>
            <p class="error"></p>
        </form>
    </div>
    @endif
    <div class="empty">
        <p>Your cart is empty at the moment<br />Check out our merchs :</p>
        <a class="cube main-cube category helmets" href="{{url('/category/helmets')}}" title="Helmets">
            <div class="borders">
                <div class="top"></div>
                <div class="right"></div>
                <div class="bot"></div>
                <div class="left"></div>
            </div>
        </a>
        <a class="cube main-cube category lasers" href="{{url('/category/lasers')}}" title="Lasers">
            <div class="borders">
                <div class="top"></div>
                <div class="right"></div>
                <div class="bot"></div>
                <div class="left"></div>
            </div>
        </a>
    </div>
    <p class="confirm">You'll be told the place of the delivery soon.</p>
@endsection
