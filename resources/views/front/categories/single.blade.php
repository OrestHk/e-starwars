@extends('front.layouts.master')

@section('title', $category->name)

@section('content')
    <a class="cube main-cube category {{$category->slug}}" href="{{url('/categories/'.$category->slug)}}" title="{{$category->name}}">
        <div class="borders">
            <div class="top"></div>
            <div class="right"></div>
            <div class="bot"></div>
            <div class="left"></div>
        </div>
    </a>
    @include('front.partials.productsCol', $prods)
@endsection
