@extends('layouts.master_admin')

@section('content')


    {!! Form::open(['url'=>'admin/product/'.$product->id,'method'=>'PUT','files'=>true]) !!}
{{ csrf_field() }}
    {!! Form::label('name','name',['for'=>'name']) !!}<br>
    {!! Form::text('name',$product->name) !!}
    {!! $errors->first('name','<span class="error">:message</span>') !!}

    {!! Form::label('slug','slug',['for'=>'slug']) !!}<br>
    {!! Form::text('slug',$product->slug) !!}
    {!! $errors->first('slug','<span class="error">:slug</span>') !!}

    {!! Form::label('description','description',['for'=>'description']) !!}<br>
    {!! Form::textarea('description',$product->description) !!}
    {!! $errors->first('description','<span class="error">:message</span>') !!}

    {!! Form::label('text_short','text court',['for'=>'text_short']) !!}<br>
    {!! Form::textarea('text_short',$product->text_short) !!}
    {!! $errors->first('text_short','<span class="error">:message</span>') !!}

    {!! Form::label('category_id','categories',['for','category']) !!}
    {!! Form::select('category_id', $cats)!!}

    {!! Form::label('status','status',['for'=>'status']) !!}
    {!! Form::select('status',array(
                                'published'=>'published',
                                'unpublished'=>'unpublished',
                                'draft'=>'draft'),$product->status
                                ) !!}

    {!! $errors->first('status','<span class="error">:message</span>') !!}
    @if(!empty($product->picture))
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
