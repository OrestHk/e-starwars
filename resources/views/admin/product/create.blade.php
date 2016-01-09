@extends('admin.layouts.master_admin')
@section('title', 'new product')
@section('content')

    {!! Form::open(['url'=>'admin/product/','files'=>true]) !!}
    <div class="row">
        <div class="four columns">
            {!! Form::label('name','name',['for'=>'name']) !!}
            {!! Form::text('name') !!}
            {!! $errors->first('name','<span class="error">:message</span>') !!}
        </div>

        <div class="four columns">
            {!! Form::label('slug','slug',['for'=>'slug']) !!}
            {!! Form::text('slug') !!}
            {!! $errors->first('slug','<span class="error">:slug</span>') !!}
        </div>
        <div class="four columns">
            {!! Form::label('price','price',['for'=>'price']) !!}
            {!! Form::text('price') !!}<span class="currency">€</span>
            {!! $errors->first('price','<span class="error">:price</span>') !!}
        </div>
    </div>


    {!! Form::label('description','description',['for'=>'description']) !!}
    {!! Form::textarea('description','',['class'=>'u-full-width']) !!}
    {!! $errors->first('description','<span class="error">:message</span>') !!}

    {!! Form::label('short_text','short_text',['for'=>'short_text']) !!}
    {!! Form::textarea('short_text','',['class'=>'u-full-width']) !!}
    {!! $errors->first('short_text','<span class="error">:message</span>') !!}

    <div class="row">
        <div class="four columns">
            {!! Form::label('category_id','categories') !!}
            {!! Form::select('category_id', $cats)!!}

        </div>
        <div class="four columns">
            {!! Form::label('status','status',['for'=>'status']) !!}
            {!! Form::select('status',array(
                                            'published'=>'published',
                                            'unpublished'=>'unpublished',
                                            'draft'=>'draft')
            )!!}
            {!! $errors->first('status','<span class="error">:message</span>') !!}
        </div>
        <div class="four columns">
            {!! Form::label('image','image',['for'=>'image']) !!}
            {!! Form::file('image') !!}
        </div>
    </div>
    <div class="row ">
        @foreach($tags as $tag)

            <div class="two columns ">
                {!! Form::label($tag->id,$tag->name) !!}
                {!! Form::checkbox('tags[]',$tag->id) !!}
            </div>
        @endforeach
    </div>

    {!! Form::label('publish_date','publié le') !!}
    {!! Form::input('date','publish_date') !!}
    {!! $errors->first('publish_date','<span class="error">:message</span>') !!}

    {!! Form::submit('create',['class'=>'button button-primary rightBtn']) !!}

    {!! Form::close() !!}

@endsection
