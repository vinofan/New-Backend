@extends('app')

@section('content')
<div class="register-box">
  <div class="register-logo">
    <b>PPIN </b>RESET
  </div>
  <!-- /.register-logo -->
  <div class="register-box-body">
    <p class="register-box-msg">Reset your password</p>

    <form action="{{ url('/admin/reset') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="token" value="{{ $token }}">

        @if (count($errors) > 0)
            <span class="text-danger">
                <strong>{{ $errors->first() }}</strong>
            </span>
        @endif

      <div class="form-group has-feedback">
      
        <input type="text" class="form-control" name="email" placeholder="EMail" value="{{Input::old('email')}}"><br />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">

      	<input type="password" class="form-control" name="password" value="{{Input::old('password')}}" placeholder="Password"><br />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" name="password_confirmation" value="{{Input::old('password_confirmation')}}" placeholder="Retype password"><br />
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.register-box-body -->
</div>
<!-- /.register-box -->

@endsection
