<?php

namespace App\Http\Middleware;

use Closure, Config;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // $currentLanguage = [
        //     'code' => 'ja',
        //     'locale' => 'Asia/Tokyo'
        // ];

        // \App::setLocale($currentLanguage['code']);
        // Config::set('app.timezone',  $currentLanguage['locale']);

        return $next($request);
    }
}