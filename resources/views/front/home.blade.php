@extends('front.layouts.master')

@section('title', 'Welcome fellow bounty hunter')

@section('content')
    <div class="products">
        @forelse($products as $product)
            @include('front.partials.product', array($product, $single = false))
        @empty
            <p>No products available yet.</p>
        @endforelse
    </div>
@endsection
