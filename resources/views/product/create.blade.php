@extends('layouts.master_admin')

@section('content')

    {!! Form::open(['url'=>'admin/product/','files'=>true]) !!}
{{ csrf_field() }}
    {!! Form::label('name','name',['for'=>'name']) !!}<br>
    {!! Form::text('name') !!}
    {!! $errors->first('name','<span class="error">:message</span>') !!}

    {!! Form::label('slug','slug',['for'=>'slug']) !!}<br>
    {!! Form::text('slug') !!}
    {!! $errors->first('slug','<span class="error">:slug</span>') !!}

    {!! Form::label('description','description',['for'=>'description']) !!}<br>
    {!! Form::textarea('description') !!}
    {!! $errors->first('description','<span class="error">:message</span>') !!}

    {!! Form::label('text_short','text_short',['for'=>'text_short']) !!}<br>
    {!! Form::textarea('text_short') !!}
    {!! $errors->first('text_short','<span class="error">:message</span>') !!}


    {!! Form::label('category_id','categories') !!}
    {!! Form::select('category_id', $cats)!!}

    {!! Form::label('status','status',['for'=>'status']) !!}
    {!! Form::select('status',array(
                                    'published'=>'published',
                                    'unpublished'=>'unpublished',
                                    'draft'=>'draft')
                                    )!!}

    {!! $errors->first('status','<span class="error">:message</span>') !!}

    {!! Form::label('image','image',['for'=>'image']) !!}
    {!! Form::file('image') !!}


        @foreach($tags as $tag)
        {!! Form::label($tag->id,$tag->name) !!}
        {!! Form::checkbox('tags[]',$tag->id) !!}
        @endforeach


    {!! Form::label('published_at','published_at') !!}
    {!! Form::input('date','published_at',\Carbon\Carbon::now()->toDateString()) !!}
    {!! $errors->first('publish_date','<span class="error">:message</span>') !!}
    <br>
    {!! Form::submit('create',['class'=>'button-primary']) !!}

    {!! Form::close() !!}

@endsection
