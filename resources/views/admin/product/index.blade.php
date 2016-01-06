@extends('admin.layouts.master_admin')

@section('content')

    <a class="button button-primary" href="{{url('admin/product/create')}}">New one</a>
    <table class="u-full-width">
        <thead>
        <tr>
            <th>status</th>
            <th>name</th>
            <th>date publication</th>
            <th>Category</th>
            <th>tags</th>
            <th>delete</th>
        </tr>
        </thead>
        <tbody>

        @forelse($products as $product)
            <tr class="{{($product->status=='published')? 'success' : 'info'}}">
                <td>{{$product->status}}</td>
                <td><a href="{{url('admin/product/'.$product->id.'/edit')}}">{{$product->name}}</a></td>
                <td>{{$product->dateConfert()}}</td>
                <td>{{$product->category ? $product->category->name : 'no Category'}}</td>
                <td>@forelse($product->tags as $tag)
                      <p class="tags">{{$tag->name}}</p>
                    @empty
                      <p>no tags</p>
                    @endforelse
                </td>

                <td>{!! Form::open(['url'=>'admin/product/'.$product->id, 'method'=>'DELETE', 'class'=>'form-delete']) !!}
                    <div class="form-group">
                        {!! Form::submit('delete', ['class'=>'btn-delete']) !!}
                    </div>
                    {!! Form::close() !!}</td>
            </tr>
        @empty
            <p>No post</p>
        @endforelse
        </tbody>
    </table>
    <div class="pagination">
        {!!$products->render()!!}
    </div>
@stop
