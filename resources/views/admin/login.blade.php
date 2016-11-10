<html>

	<body">
		<h1>登录界面</h1>
		
	</body>

	<form class="m-t" role="form" method="post" action="{{ url('/admin/check_login') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="text" class="form-control" name="username" placeholder="Username" value="{{Input::old('username')}}" required=""><br />
		<input type="password" class="form-control" name="password" value="{{Input::old('password')}}" placeholder="Password" required=""><br />
		<button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
	</form>
</html>