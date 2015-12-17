@extends('admin.layouts.master_admin')

@section('content')

    {!! Form::open(['url'=>'admin/product/','files'=>true]) !!}

    {!! Form::label('name','name',['for'=>'name']) !!}<br>
    {!! Form::text('name') !!}
    {!! $errors->first('name','<span class="error">:message</span>') !!}

    {!! Form::label('slug','slug',['for'=>'slug']) !!}<br>
    {!! Form::text('slug') !!}
    {!! $errors->first('slug','<span class="error">:slug</span>') !!}

    {!! Form::label('description','description',['for'=>'description']) !!}<br>
    {!! Form::textarea('description') !!}
    {!! $errors->first('description','<span class="error">:message</span>') !!}

    {!! Form::label('short_text','short_text',['for'=>'short_text']) !!}<br>
    {!! Form::textarea('short_text') !!}
    {!! $errors->first('short_text','<span class="error">:message</span>') !!}


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


    {!! Form::label('publish_date','publié le') !!}
    {!! Form::input('date','publish_date') !!}
    {!! $errors->first('publish_date','<span class="error">:message</span>') !!}
    <br>
    {!! Form::submit('create',['class'=>'button-primary']) !!}

    {!! Form::close() !!}

@endsection
