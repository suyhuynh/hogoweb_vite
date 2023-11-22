<?php

namespace App\Http\Middleware;

use Closure, Config;
use Modules\Language\Services\LocalLang;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // $typeImage = explode('.', url()->full());
        // if (in_array(strtolower($typeImage[count($typeImage) - 1]), ['jpg', 'png', 'gif', 'webp', 'svg', 'js', 'css'])) {
        //     die();
        // }

        // $locale = $request->segment(1);
        // $currentLanguage = LocalLang::currentLanguage();
        // // // if ($locale != $currentLanguage['code']) {
        // // //     $currentLanguage = LocalLang::getLanguageByLangCode($locale);
        // // // }
        // \App::setLocale($currentLanguage['code']);
        // Config::set('app.timezone',  $currentLanguage['locale']);

        return $next($request);
    }
}