@extends('front.layouts.master')

@section('title', 'All your products here')

@section('content')
    @include('front.partials.productsCol', $prods)
    <div class="pagination">
        {!!$products->render()!!}
    </div>
@endsection
