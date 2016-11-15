<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Contracts\Auth\PasswordBroker;

use Illuminate\Http\Request;

use Auth;
use App;
use Password;
use Hash;
use App\Models\SysUser;

class AuthController extends Controller
{
	protected $registrar;

    protected $passwords;

    public function getIndex()
    {
        return view('welcome');
    }

    public function getRegister()
    {
        if(Auth::check()) {
            $user = Auth::user();
            if ($user->auth == 'ADMIN'){
                return view('admin.register');
            }

            return view('errors.503');
        }

        abort(404);
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

    public function getPassword()
    {
        return view('admin.password');
    }

    public function postPassword(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        
        $response = Password::sendResetLink($request->only('email'), function($m)
        {
            $m->subject('Your Password Reset Link');
        });

        switch ($response)
        {
            case PasswordBroker::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));

            case PasswordBroker::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    public function getReset($token = null)
    {
        if (is_null($token))
        {
            throw new NotFoundHttpException;
        }
        return view('admin.reset')->with('token', $token);
    }

    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $user = new SysUser;
        $password = $credentials['password'];

        $response = Password::reset($credentials, function($user, $password)
        {
            $user->password = bcrypt($password);

            $user->save();

            Auth::login($user);
        });

        switch ($response)
        {
            case PasswordBroker::PASSWORD_RESET:
                return redirect($this->redirectPath());

            default:
                return redirect()->back()
                            ->withInput($request->only('email'))
                            ->withErrors(['email' => trans($response)]);
        }

    }

    public function getCheck()
    {
        if (Auth::check()) {
            return '1';
        }
        return '2';
    }

    public function getGetuser()
    {
        //$user = SysUser::where('email', 'kevinfan@megainformationtech.com')->first();

        $res = Password::getUser(['email' => 'kevinfan@megainformationtech.com']);

        dd($res);
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
