@extends('front.layouts.master')

@section('title', '404')

@section('content')
    <div class="main-error">
        <p>This is not the page you are looking for.</p>
        <img src="{{asset('assets/images/404.gif')}}" alt="404" />
    </div>
@endsection
