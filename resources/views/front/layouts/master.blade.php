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
</html>
