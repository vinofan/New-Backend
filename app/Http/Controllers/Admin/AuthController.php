<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

use Illuminate\Http\Request;

use Auth;
use Hash;
use App\Models\SysUser;

class AuthController extends Controller
{
	protected $registrar;

    public function getIndex()
    {
        return view('welcome');
    }

    public function getRegister()
    {
    	return view('admin.register');
    }

    public function postRegister(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'repassword' => 'same:password',
        ]);

        $data = $request->only('name', 'email', 'password');
        $properties = ['name' => $data['name'], 'email' => $data['email'], 'password' => Hash::make($data['password'])];

		Auth::login(SysUser::create($properties));

		return redirect($this->redirectPath());
    }

    public function getLogin()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required', 'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
                    ->withInput($request->only('name'))
                    ->withErrors([
                        'error' => 'username or password incorrect',
                    ]);
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect($this->loginPath());
    }

    public function getCheck()
    {
        if (Auth::check()) {
            return '1';
        }
        return '2';
    }


    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/admin/login';
    }
}
