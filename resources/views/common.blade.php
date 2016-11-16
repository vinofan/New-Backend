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
  <link rel="stylesheet" href="{{ asset('css/skins/skin-purple.min.css') }}">
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
            {{ $page_title or "Page Title" }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> home</a></li>
            <li class="active">Here</li>
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
</body>
</html>
