<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PPIN Tools</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
  <link rel="stylesheet" href="{{ asset('css/skins/skin-purple.min.css') }}">
  @if ( isset($route['css_path']))
  <link rel="stylesheet" href="{{ $route['css_path'] }}">
  @endif
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

<!-- Header -->
@include('common/header')
<!-- Left sidebar -->
@include('common/main_sidebar')
<!-- Content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{ $route['page_title'] or "Page Title" }}
            <small>{{ $route['page_description'] or null }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> home</a></li>
            @if ( $route['path'] != 'home' && $route['group_breadcrumb'])
            <li>{{ $route['group_breadcrumb'] }}</li>
            @endif
            @if ( $route['path'] != 'home' && $route['page_breadcrumb']) 
            <li class="active">{{ $route['page_breadcrumb'] }}</li>
            @endif
        </ol>
    </section>

    <section class="content">
        <!-- Page Content -->
        @yield('content')
    </section>
</div>

<!-- Footer -->
@include('common/footer')
<!-- Control Sidebar -->
@include('common/control_sidebar')
</div>

<script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-slider.js') }}"></script>
@if ( isset($route['js_path']))
<script src="{{ $route['js_path'] }}"></script>
@endif
</body>
</html>
