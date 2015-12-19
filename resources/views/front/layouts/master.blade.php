<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
</head>
<body>

    @include('front.partials.header')

    <div class="content">
        @yield('content')
    </div>

    @include('front.partials.footer')

</body>
<script src="{{asset('assets/js/jquery-1.7.2.min.js')}}"></script>
<script src="{{asset('assets/js/cartJs.js')}}"></script>
</html>
