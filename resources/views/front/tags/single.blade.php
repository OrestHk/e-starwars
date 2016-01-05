@extends('front.layouts.master')

@section('title', $tag->name)

@section('content')
    @include('front.partials.productsCol', $prods)
    <div class="pagination">
        {!!$products->render()!!}
    </div>
@endsection
