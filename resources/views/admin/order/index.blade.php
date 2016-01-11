@extends('admin.layouts.master_admin')
@section('title', 'order index')
@section('content')
 @if(!empty($orders))
    <table class="u-full-width" id="listOrder">
        <thead>
        <tr>
            <th>User name</th>
            <th>Total price</th>
            <th>Date publication</th>
            <th>Details</th>

        </tr>
        </thead>
        <tbody>
@endif
        @forelse($orders as $order)
            <tr>
                <td>{{$order->user->name}}</td>
                <td>{{$order->total_price}}</td>
                <td>{{$order->order_date}}</td>
                <td><a href="{{url('admin/order/'.$order->id)}}"> see more</a></td>
            </tr>
        @empty
            <p>No order history</p>
        @endforelse
        </tbody>
    </table>
    <div class="pagination">
        {!!$orders->render()!!}
    </div>
@stop
