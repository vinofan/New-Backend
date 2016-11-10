<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Model\Admin;
use Auth;
use Redirect;
use App\User;



class LoginController extends Controller {
    public function index()
    {
        return view('admin.login');
    }


     /*
     * 验证用户登录
     */
    public function checkLogin(Request $request) {
        $errors = [];
        $data = $request->except(['_token']);
        //dd($data);
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $errorMessage = [
            'username.required' => '用户名不能为空',
            'password.required' => '密码不能为空',
        ];
        $this->validate($request , $rules , $errorMessage);


        $user = Admin::where('user_name', $data['username'])->first();
       
        if (count($user) == 0)
        {   
            $errors['username'] =  '用户名不存在';
        }elseif (!Hash::check($data['password'] , $user->user_passwd))
        {
            $errors['username'] =  '密码不正确';
        }
        if (count($errors) > 0)
        {
            return back()->withInput($data)->withErrors($errors);
        }

        Auth::login($user);
        return redirect('admin');
    }
}

