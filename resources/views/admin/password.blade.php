@extends('app')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <b>Password </b>Reset
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Change your password</p>

    <form action="{{ url('/admin/password') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if (count($errors) > 0)
            <span class="text-danger">
              <strong>{{ $errors->first() }}</strong>
            </span>
        @endif
    
      <div class="form-group has-feedback">
      
      	<input type="text" class="form-control" name="email" placeholder="EMail" value="{{Input::old('email')}}"><br />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Send Reset Link</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@endsection