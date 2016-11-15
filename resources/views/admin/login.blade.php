@extends('app')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <b>PPIN </b>LOGIN
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ url('/admin/login') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if (count($errors) > 0)
            <span class="text-danger">
                <strong>{{ $errors->first() }}</strong>
            </span>
        @endif
    
      <div class="form-group has-feedback">
      
      	<input type="text" class="form-control" name="name" placeholder="Username" value="{{Input::old('name')}}"><br />
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">

      	<input type="password" class="form-control" name="password" value="{{Input::old('password')}}" placeholder="Password"><br />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="{{ url('admin/password') }}" class="text-red">I forgot my password</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection