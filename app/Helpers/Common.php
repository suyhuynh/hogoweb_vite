<?php

use Modules\Core\Services\Config;
use Modules\Language\Services\LocalLang;

if (! function_exists('getDefaultLangCode')) {
    function getDefaultLangCode() {
        return empty($_SESSION['current_language']) ? env('LANGUAGE_CODE') : LocalLang::currentLanguage()['code'];
    }
}

if (! function_exists('currentLanguage')) {
    function currentLanguage() {
        return 'vn';
    }
}

if (! function_exists('getDefaultLangTimezone')) {
    function getDefaultLangTimezone() {
        return empty($_SESSION['current_language']) ? env('LANGUAGE_TIMEZONE') : LocalLang::currentLanguage()['locale'];
    }
}

if (! function_exists('encrypt')) {

    function encrypt($email , $pass) {
        $email = str_replace(' ', '', $_POST['email']);
        $email = mb_strtolower($email, 'UTF-8');
        $email = trim($email);
        $email = addslashes($email);

        $salt="cetusjapan";
        $encrypt = sha1($pass);
        $letters = array("d", "e", "c", "a", "b", "f", "u");
        $a_salt=str_split($salt);
        $encrypt = str_replace($letters, $a_salt, $encrypt);

        $encrypt = md5($encrypt.$email);
        return $encrypt;
    }
}

if (! function_exists('getSettingConfigLangCode')) {

    function getSettingConfigLangCode($lang_code) {
        return Config::loadTemplateEmail($lang_code);
    }
}

if (! function_exists('getTopPosts')) {

    function getTopPosts($posts) {
        $tops = [];
        for ($i=0; $i < 3; $i++) { 
            if (!empty($posts[$i])) {
                $tops[] = $posts[$i];
                unset($posts[$i]);
            }
        }

        return [
            'tops' => $tops,
            'posts' => $posts,
        ];
    }
}

if (! function_exists('formatTagUrl')) {

    function formatTagUrl($tag) {
        $entity = \Spatie\Tags\Tag::findFromString($tag);
        return !empty($entity) ? $entity->slug : formatUrl($tag);
    }
}

if (! function_exists('setTopPosts')) {
    function setTopPosts($posts, $postTopOrders) {
        $keyMin = -1;
        $totalPosts = count($posts) - 1;
        $totalPostTop = 1;
        $listPostItems = collect();

        $configTopPosts = config('post.advertising');
        foreach($configTopPosts as $key => $val) {
            if (!empty($postTopOrders[$key])) {
                $items = $postTopOrders[$key]->sortByDesc('start_date');
                foreach($items as $post) {
                    $listPostItems->push($post->post);
                    $totalPostTop++;
                }
            } else {
                if ($totalPostTop <= $key) {
                    $keyMin = $keyMin + 1;
                    if ($keyMin <= $totalPosts ) {
                        $listPostItems->push($posts[$keyMin]);
                    }
                }
                
            }
        }

        if (count($posts) > $keyMin) {
            for($i = $keyMin; $i > $keyMin; $i++) {
                $listPostItems->push($posts[$i]);
            }
        }
        return $listPostItems;
    }
}

if (! function_exists('getPostAds')) {
    function getPostAds($column, $categoryIds = []) {
        return \Modules\Advertising\Entities\AdPost::with(['post' => function ($q) {
            return $q->where('status', 'publish')->with('translate:post_id,title,alias,description,img', 'creator', 'category');
        }])
        ->whereHas('post', function($q) use($categoryIds) {
            $q = $q->where('status', 'publish');
            if (count($categoryIds)) {
                $q = $q->whereIn('category_id', $categoryIds);
            }

            return $q;
        })
        ->where($column, '>', 0)
        ->orderBy('start_date', 'desc')
        ->get();
    }
}