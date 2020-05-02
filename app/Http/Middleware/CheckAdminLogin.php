<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 判断是否登录
        if (!auth()->check()) {
            return redirect(route('admin.login'))->withErrors(['error' => '请登录']);
        }
        // 获取用户所拥有的权限
        $auth = is_array(session('admin.auth')) ? array_filter(session('admin.auth')) : [];
        $auth = config('rbac.allow_route');
        // 获取当前访问的路由
        $currentRoute = $request->route()->getName();
        // 普通管理员，验证是否有这条路由的权限
        if (auth()->user()->username != config('rbac.super') && !in_array($currentRoute, $auth)) {
            exit('您无权访问');
        }
        return $next($request);
    }
}
