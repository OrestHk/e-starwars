<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <link rel="stylesheet" href="{{asset('assets/css/front.min.css')}}">
</head>
<body>
    @if(session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    @endif

    @include('front.partials.header')

    <div class="main-container">
        @yield('content')
    </div>

    @include('front.partials.footer')
    <div class="overlay"></div>

</body>
<script src="{{asset('assets/js/jquery-1.7.2.min.js')}}"></script>
<script src="{{asset('assets/js/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/cartJs.js')}}"></script>
<script src="{{asset('assets/js/front.min.js')}}"></script>
</html>
