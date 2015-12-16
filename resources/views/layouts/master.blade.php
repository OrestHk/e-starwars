<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Basic Page Needs
    末末末末末末末末末末末末末末末末末末末末末末末末末 -->
    <meta charset="utf-8">
    <title>Your page title here :)</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
    末末末末末末末末末末末末末末末末末末末末末末末末末 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT
    末末末末末末末末末末末末末末末末末末末末末末末末末 -->
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

    <!-- CSS
    末末末末末末末末末末末末末末末末末末末末末末末末末 -->
    <link rel="stylesheet" href="{{asset('assets/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/skeleton.css')}}">

    <!-- Favicon
    末末末末末末末末末末末末末末末末末末末末末末末末末 -->
    <link rel="icon" type="image/png" href="{{asset('assets/images/favicon.png')}}">

</head>
<body>

<!-- Primary Page Layout
末末末末末末末末末末末末末末末末末末末末末末末末末 -->
<div class="container">
    <nav>
        @include('partials.main_menu')
    </nav>
    <div class="row">
        <div class="one-half column" style="margin-top: 10%">
            @yield('content','default value')
        </div>
    </div>
</div>

<!-- End Document
  末末末末末末末末末末末末末末末末末末末末末末末末末 -->
</body>
</html>
