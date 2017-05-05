<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Cookie;

class ApiVisitLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //当前时间
        $now = Carbon::now()->format('Y-m-d H:i:s');

        //获取IP
        $ip = $request->ip();

        //请求路径
        $url = $request->getUri();

        //请求方式
        $method = $request->getMethod();

        //来源地址
        $http_referer = $request->server('HTTP_REFERER');

        //客户端浏览器和操作系统信息
        $user_agent = $request->server('HTTP_USER_AGENT');

        //是否第一次访问
        $first_access_flag = Cookie::get('m_last_visit_time') ? 1 : 0;

        $log = '[' . $now . '] ' . json_encode(compact('now', 'ip', 'url', 'method', 'http_referer', 'user_agent', 'first_access_flag'), JSON_UNESCAPED_UNICODE);

        $path = storage_path('log/api_visit_log/' . Carbon::now()->format('Y-m-d') . '.log');
        $dir  = dirname($path);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        file_put_contents($path, $log . "\n", FILE_APPEND);

        //记录访问cookie
        $cookie = Cookie::forever('m_last_visit_time', $now);

        return $next($request)->withCookie($cookie);
    }
}
