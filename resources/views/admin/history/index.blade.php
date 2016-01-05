@extends('admin.layouts.master_admin')

@section('content')
 @if(!empty($histories))
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
        @forelse($histories as $history)
            <tr>
                <td>{{$history->user->name}}</td>
                <td>{{$history->total_price}}</td>
                <td>{{$history->order_date}}</td>
                <td><a href="{{url('admin/history/'.$history->id)}}"> see more</a></td>
            </tr>
        @empty
            <p>no order history</p>
        @endforelse
        </tbody>
    </table>
@stop
