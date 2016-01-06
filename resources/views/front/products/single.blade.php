@extends('front.layouts.master')

@section('title', $product->name)

@section('content')
    <div class="products-container">
        <div class="product-container single">
            @if(isset($product->picture))
            <div class="image table-element">
                <img src="{{url(IMG_PATH_FRONT.$product->picture->filename)}}" />
            </div>
            @endif
            <div class="category-container table-element">
                @if(isset($product->category))
                <a class="cube main-cube category {{$product->category->slug}}" href="{{url('/categories/'.$product->category->slug)}}" title="{{$product->category->name}}">
                    <div class="borders">
                        <div class="top"></div>
                        <div class="right"></div>
                        <div class="bot"></div>
                        <div class="left"></div>
                    </div>
                </a>
                @endif
            </div>
            <div class="container-infos table-element">
                <div class="about-top">
                    <a class="title" href="{{url('/products/'.$product->slug)}}">{{$product->name}}</a>
                    <p class="description">{{$product->description}}</p>
                    <div class="clear"></div>
                </div>
                @if(!empty($product->tags))
                <div class="tags">
                    @foreach($product->tags as $tag)
                        <a href="{{url('tags/'.$tag->slug)}}" class="tag cube {{$tag->slug}}" title="{{$tag->name}}">
                            <div class="borders">
                                <div class="top"></div>
                                <div class="right"></div>
                                <div class="bot"></div>
                                <div class="left"></div>
                            </div>
                        </a>
                    @endforeach
                </div>
                @endif
                @include('front.forms.addCart', $product)
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection
