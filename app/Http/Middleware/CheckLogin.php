<?php
namespace App\Http\Middleware;

use Closure;
use Cookie;
use Redirect;

/**
 * 检查用户登陆中间件
 * @author Robin
 *
 */
class CheckLogin
{

    /**
     * 构造函数
     */
    public function __construct()
    {
        // TODO
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 取得用户的Cookie
        $token = Cookie::get("TOKEN");
        // 如果有Cookie
        if(isset($token)) {
            // 将cookie值转为json对象数组
            //$user = json_decode($token);
            //echo $token->uname;
            //print_r($next($request));
            // 往下执行
            return $next($request);
        }
        else {
            // 如果取不到用户的cookie，跳转到用户登陆页面
            return redirect()->guest('auth/login');
        }
    }
}