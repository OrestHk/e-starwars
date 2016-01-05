<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <link rel="stylesheet" href="{{asset('assets/css/front.min.css')}}">
</head>
<body>

    @include('front.partials.header')

    <div class="main-container @if($class) {{$class}} @endif">
        @yield('content')
    </div>

    @include('front.partials.footer')
    <div class="overlay"></div>
    @if($splash)
        @include('front.partials.splash')
    @endif

</body>
<script src="{{asset('assets/js/jquery-1.7.2.min.js')}}"></script>
<script src="{{asset('assets/js/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/cartJs.js')}}"></script>
<script src="{{asset('assets/js/front.min.js')}}"></script>
</html>
