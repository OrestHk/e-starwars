@extends('front.layouts.master')

@section('title', 'Welcome fellow bounty hunter')

@section('content')
    @include('front.partials.productsCol', $prods)
@endsection
