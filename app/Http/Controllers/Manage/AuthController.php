<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Models\Admin\IMAdmin;

use Auth;
use Cookie;

class AuthController extends Controller
{

    /*public function __construct() {
        $this->middleware('admin_login', ['except' => 'getLogout']);
    }*/

    public function getLogin(){
        echo 'adfa';
        return view("auth.login");
    }


    public function postLogin(Request $request){

        $this->validate($request,[
            'email'=>'required',
            'password'=>'required',
        ]);

        $admin = IMAdmin::where( 'uname','=',$request->input('email') )->first();
        //->where( 'pwd','=',md5($request->input('password')))

        if($admin){
            $password = md5($request->input('password'));
            if($password != $admin->pwd){
                return  Redirect::back()->withInput()->withErrors('密码不正确');
            }else{
                $cookie_admin = ['uname'=>$admin->uname];
                Cookie::queue("TOKEN", json_encode($cookie_admin), 3600);
                return Redirect::intended('/');
            }
        }else{
            return Redirect::back()->withInput()->withErrors('为找到用户名');
        }
    }


    public function getLogout(){
        Cookie::queue("TOKEN", '', -1);

        return redirect()->intended('/');
    }


}
