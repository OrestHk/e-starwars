<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Basic Page Needs
    �������������������������������������������������� -->
    <meta charset="utf-8">
    <title>Your page title here :)</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
    �������������������������������������������������� -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT
    �������������������������������������������������� -->
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

    <!-- CSS
    �������������������������������������������������� -->
    <link rel="stylesheet" href="{{asset('assets/css/back.min.css')}}">

    <!-- Favicon
    �������������������������������������������������� -->
    <link rel="icon" type="image/png" href="{{asset('assets/images/favicon.png')}}">

</head>
<body>

<!-- Primary Page Layout
�������������������������������������������������� -->
<div class="container">
    <div class="row">
      <div class="twelve columns">
        @include('admin.partials.admin_menu')
      </div>
    </div>
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

<!-- End Document
  �������������������������������������������������� -->

</body>
</html>
