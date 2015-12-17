@extends('layouts.master_admin')

@section('content')


    {!! Form::open(['url'=>'admin/product/'.$product->id,'method'=>'PUT','files'=>true]) !!}

    {!! Form::label('name','name',['for'=>'name']) !!}<br>
    {!! Form::text('name',$product->name) !!}
    {!! $errors->first('name','<span class="error">:message</span>') !!}

    {!! Form::label('slug','slug',['for'=>'slug']) !!}<br>
    {!! Form::text('slug',$product->slug) !!}
    {!! $errors->first('slug','<span class="error">:slug</span>') !!}

    {!! Form::label('description','description',['for'=>'description']) !!}<br>
    {!! Form::textarea('description',$product->description) !!}
    {!! $errors->first('description','<span class="error">:message</span>') !!}

    {!! Form::label('short_text','text court',['for'=>'short_text']) !!}<br>
    {!! Form::textarea('short_text',$product->short_text) !!}
    {!! $errors->first('short_text','<span class="error">:message</span>') !!}


    {!! Form::label('category_id','categories',['for','category']) !!}
    {!! Form::select('category_id', $cats)!!}

    {!! Form::label('status','status',['for'=>'status']) !!}
    {!! Form::select('status',array(
                                'published'=>'published',
                                'unpublished'=>'unpublished',
                                'draft'=>'draft'),$product->status
                                ) !!}

      @foreach($tags as $tag)
      {!! Form::label($tag->id,$tag->name) !!}
      {!! Form::checkbox('tags[]',$tag->id) !!}
      @endforeach


    {!! $errors->first('status','<span class="error">:message</span>') !!}
    @if(!empty($product->picture()))
        <img src="{{url(IMG_PATH_FRONT.$product->picture->filename)}}">
    @endif
    {!! Form::label('image','image',['for'=>'image']) !!}
    {!! Form::file('image') !!}
    {!! Form::label('publish_at','publish_at') !!}
    {!! Form::input('date','publish_at',\Carbon\Carbon::now()->toDateString()) !!}

    {!! $errors->first('published_at','<span class="error">:message</span>') !!}
    <br>
    {!! Form::submit('update') !!}

    {!! Form::close() !!}
    @stop
