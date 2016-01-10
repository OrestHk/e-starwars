<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/back.min.css')}}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>

</head>
    <body>

    <div class="container">
        @include('admin.partials.admin_menu')
        <div class="row" id="adminMainContener">
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="twelve columns">
                @yield('content','default value')
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/back.min.js')}}"></script>
    </body>
</html>
