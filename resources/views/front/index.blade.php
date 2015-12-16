@extends('layouts.master')

@section('content')
    @foreach($products as $product)
        <article>
            <a href="{{url('product',$product->slug)}}">Title: {{$product->title}}</a>
            <p>Category :{{$product->category->name}}</p>
            <p>
                @foreach($product->tags as $tag)
                    {{$tag->name}} /
                @endforeach
            </p>
            <p>{{$product->short_text}}</p>
        </article>
    @endforeach
@endsection
