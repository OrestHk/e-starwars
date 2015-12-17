@extends('admin.layouts.master_admin')

@section('content')
    <div class="pagination">
        {!!$products->render()!!}
    </div>
    <a class="btn" href="{{url('admin/product/create')}}">New one</a>
    <table class="table table-hover table-bordered">
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
                <td>{{$product->publish_date}}</td>
                <td>{{$product->category_id ? $product->category->name : 'no Category'}}</td>
                <td>@forelse($product->tags as $tag)
                      {{$tag->name}}
                    @empty
                      <p>no tags</p>
                    @endforelse
                </td>

                <td>{!! Form::open(['url'=>'admin/product/'.$product->id, 'method'=>'DELETE', 'class'=>'form-delete']) !!}
                    <div class="form-group">
                        {!! Form::submit('delete', ['class'=>'btn']) !!}
                    </div>
                    {!! Form::close() !!}</td>
            </tr>
        @empty
            <p>No post</p>
        @endforelse
        </tbody>
    </table>
@stop
