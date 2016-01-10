@extends('admin.layouts.master_admin')
@section('title', 'product index')
@section('content')

    <a class="button button-primary" href="{{url('admin/product/create')}}">Add product</a>
    <table class="u-full-width">
        <thead>
        <tr>
            <th>Status</th>
            <th>Name</th>
            <th>Publication date</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Delete</th>
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

                <td>
                    <div class="form-group">
                        {!! Form::button('delete', ['class'=>'btn-delete', 'data-id' => $product->id]) !!}
                    </div>
                </td>
            </tr>
        @empty
            <p>No post</p>
        @endforelse
        </tbody>
    </table>
    <div class="delete-conf">
        {!! Form::open(['url' => "admin/product/", 'method' => 'delete', 'data-url' => url('admin/product/')]) !!}
            <p>Are you sure you want to delete this post ?</p>
            <input type="hidden" name="id" value="" id="">
            <button class="aboart btn btn-success">Aboart</button>
            <input type="submit" class="btn btn-danger" value="Confirm">
        {!! Form::close() !!}
    </div>
    <div class="pagination">
        {!!$products->render()!!}
    </div>
@stop
