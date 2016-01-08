@extends('admin.layouts.master_admin')

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
    {!! Form::label('price','price',['for'=>'price']) !!}<br>
    {!! Form::text('price',$product->price) !!}
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
  @foreach($tags as $tag)
    <div class="row ">
      {!! Form::label($tag->id,$tag->name,['class'=>'two columns']) !!}
      {!! Form::checkbox('tags[]',$tag->id,'',['class'=>'one column']) !!}
    </div>
  @endforeach


    {!! Form::label('publish_date','publié le') !!}
    {!! Form::input('date','publish_date') !!}
    {!! $errors->first('publish_date','<span class="error">:message</span>') !!}
    <br>
    {!! Form::submit('create',['class'=>'button button-primary']) !!}

    {!! Form::close() !!}

@endsection
