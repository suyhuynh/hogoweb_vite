<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    /**
     * The routes that should be excluded from verification.
     *
     * @var array
     */
    protected $except = [
        'admin.login',
        'admin.post_login',
        'admin.logout',
        'admin.reset.*',
        'admin.crawls.*'
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Illuminate\Http\Response
     */

    public function handle($request, Closure $next)
    {
        if (auth()->check() || $this->inExceptArray($request)) {
            return $next($request);
        }

        if (auth()->check() && count($request->route()->getAction()['middleware']) >= 1) {
            return $next($request);
        }

        return redirect()->route('admin.login');
    }

    /**
     * Determine if the request URI is in except array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            $routeName = optional(request()->route())->getName();

            if (preg_match("/{$except}/", $routeName)) {
                return true;
            }
        }

        return false;
    }

}
