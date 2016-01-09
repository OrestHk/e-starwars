@extends('admin.layouts.master_admin')

@section('content')
 @if(!empty($orders))
    <table class="u-full-width">
        <thead>
        <tr>
            <th>user name</th>
            <th>total price</th>
            <th>date publication</th>
            <th>details</th>

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
            <p>no order history</p>
        @endforelse
        </tbody>
    </table>
@stop
