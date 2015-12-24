@extends('front.layouts.master')

@section('title', 'your order')

@section('content')
  <div id="orderList">

  </div>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
