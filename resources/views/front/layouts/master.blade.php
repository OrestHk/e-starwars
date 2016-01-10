<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <link rel="stylesheet" href="{{asset('assets/css/front.min.css')}}">
    <script>
        pagData = {
            @if(isset($paginatUrl))
                url: '{{$paginatUrl}}',
            @endif
            @if(isset($page) && $page !== false)
                page: '{{$page}}'
            @endif
        };
    </script>
</head>
<body class="@if(isset($mobile) && $mobile != false) mobile @endif">
    @if(session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    @endif

    @include('front.partials.header')

    <div class="main-container @if(isset($class)) {{$class}} @endif @if(isset($empty)) empty @endif">
        @yield('content')
    </div>

    @include('front.partials.footer')
    <div class="overlay"></div>
    @if($splash)
        @include('front.partials.splash')
    @endif

</body>
<script src="{{asset('assets/js/front.min.js')}}"></script>
</html>
