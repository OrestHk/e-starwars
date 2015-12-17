@extends('front.layouts.master')

@section('title', $tag->name)

@section('content')
    <div class="products">
        @forelse($products as $product)
            @include('front.partials.product', array($product, $single = false))
        @empty
            <p>No products available yet.</p>
        @endforelse
    </div>
    <div class="pagination">
        {!!$products->render()!!}
    </div>
@endsection
