@extends('admin.layouts.master_admin')

@section('content')
    <ul class="AdminStuff">
        <li><a href="{{url('admin/product')}}">administrer les produits</a></li>
        <li><a href="{{url('admin/history')}}">voir les commandes</a></li>
    </ul>
@stop
