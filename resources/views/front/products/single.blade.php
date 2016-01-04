@extends('front.layouts.master')

@section('title', $product->name)

@section('content')
    <div class="products">
        @include('front.partials.product', array($product, $single = true))
    </div>
@endsection
