@extends('front.layouts.master')

@section('title', 'your order')

@section('content')
  <div id="orderList"></div>

  <form action="{{url('validationOrder')}}" id="orderValidation">
      <input type="text" name="name" placeholder="name" required id="CustomerName">
      <input type="email" name="name" placeholder="email" required id="CustomerMail">
      <input type="submit" id="valideOrder" value="BUY">
  </form>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
