@extends('admin.layouts.master_admin')
@section('title', 'edit product')
@section('content')


    {!! Form::open(['url'=>'admin/product/'.$product->id,'method'=>'PUT','files'=>true]) !!}
    <div class="row">
        <div class="four columns">
            {!! Form::label('name','name',['for'=>'name']) !!}<br>
            {!! Form::text('name',$product->name) !!}
            {!! $errors->first('name','<span class="error">:message</span>') !!}
        </div>
        <div class="four columns">
            {!! Form::label('slug','slug',['for'=>'slug']) !!}<br>
            {!! Form::text('slug',$product->slug) !!}
            {!! $errors->first('slug','<span class="error">:slug</span>') !!}
        </div>
        <div class="four columns">
            {!! Form::label('price','price',['for'=>'price']) !!}<br>
            {!! Form::number('price',$product->price) !!}<span class="currency">€</span>
            {!! $errors->first('price','<span class="error">:price</span>') !!}
        </div>
    </div>


    {!! Form::label('description','description',['for'=>'description']) !!}<br>
    {!! Form::textarea('description',$product->description,['class'=>'u-full-width']) !!}
    {!! $errors->first('description','<span class="error">:message</span>') !!}

    {!! Form::label('short_text','text court',['for'=>'short_text']) !!}<br>
    {!! Form::textarea('short_text',$product->short_text,['class'=>'u-full-width']) !!}
    {!! $errors->first('short_text','<span class="error">:message</span>') !!}


    <div class="row">
        <div class="four columns">
            {!! Form::label('category_id','categories',['for','category']) !!}
            {!! Form::select('category_id', $cats,$product->category_id)!!}
        </div>
        <div class="four columns">
            {!! Form::label('status','status',['for'=>'status']) !!}
            {!! Form::select('status',array(
                                        'published'=>'published',
                                        'unpublished'=>'unpublished'), $product->status
                                        ) !!}
            {!! $errors->first('status','<span class="error">:message</span>') !!}
        </div>
        <div class="four columns">
            {!! Form::label('image','image',['for'=>'image']) !!}
            {!! Form::file('image') !!}
        </div>
    </div>

    <div class="row">
        @foreach($tags as $tag)
            <div class="two columns ">
                {!! Form::label($tag->id,$tag->name) !!}
                {!! Form::checkbox('tags[]',$tag->id, $product->hasTag($tag->id)) !!}
            </div>
        @endforeach
    </div>
    <div class="row">
        @if(!empty($product->picture->filename))
            <img height="250px"src="{{url(IMG_PATH_FRONT.$product->picture->filename)}}">
        @endif
    </div>

    {!! Form::label('publish_date','plublier à') !!}
    {!! Form::input('date','publish_date',\Carbon\Carbon::now()->toDateString()) !!}

    {!! $errors->first('publish_date','<span class="error">:message</span>') !!}

    {!! Form::submit('update',['class'=>'button button-primary rightBtn']) !!}

    {!! Form::close() !!}
@stop
