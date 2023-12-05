<?php

if (! function_exists('getDefaultLangCode')) {
    function getDefaultLangCode() {
        return empty($_SESSION['current_language']) ? env('LANGUAGE_CODE') : LocalLang::currentLanguage()['code'];
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

if(!function_exists('get_extension_seo')) {
    function get_extension_seo() {
        return '.html';
    }
}

if(!function_exists('checkRouteName')) {
    function checkRouteName($routeName) {
        return request()->route()->getName() == $routeName;
    }
}

if (!function_exists('formatUrl')) {
	function formatUrl($text)
	{
		$text = trim(mb_strtolower($text, 'UTF-8'));
		$text = trim(str_replace(['-', '_', '|', ' |', '–'], [' ', ' ', ''], $text));
		$text = str_replace(
			array('/', "\\", '"', '?', '<', '>', "^", "`", "'", "=", "!", ":", ",", "*", "&", '$', '|', '%', '#', "▄", "♥", '  ', ' - ', 'quot;', '’', "®", "©", 'î', "'", '39;', '.', '(', ')', '“', '”', '・', '／'),
			array('-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ' ', '-', '', '', '', '', 'i', '', '', '', '', '', '', ''),
			$text);
		$text = str_replace(
			array('_', '   ', '  ', ' ', '    ' ,'     ' ,'      ','       ','        ','         '),
			'-',
			$text);

		$chars = array("a", "A", "e", "E", "o", "O", "u", "U", "i", "I", "d", "D", "y", "Y");
		$uni[0] = array("á", "à", "ạ", "ả", "ã", "â", "ấ", "ầ", "ậ", "ẩ", "ẫ", "ă", "ắ", "ằ", "ặ", "ẳ", "� �", "ẵ");
		$uni[1] = array("Á", "À", "Ạ", "Ả", "Ã", "Â", "Ấ", "Ầ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ắ", "Ằ", "Ặ", "Ẳ", "� �");
		$uni[2] = array("é", "è", "ẹ", "ẻ", "ẽ", "ê", "ế", "ề", "ệ", "ể", "ễ");
		$uni[3] = array("É", "È", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ế", "Ề", "Ệ", "Ể", "Ễ");
		$uni[4] = array("ó", "ò", "ọ", "ỏ", "õ", "ô", "ố", "ồ", "ộ", "ổ", "ỗ", "ơ", "ớ", "ờ", "ợ", "ở", "ỡ", "� �");
		$uni[5] = array("Ó", "Ò", "Ọ", "Ỏ", "Õ", "Ô", "Ố", "Ồ", "Ộ", "Ổ", "Ỗ", "Ơ", "Ớ", "Ờ", "Ợ", "Ở", "Ỡ", "� �");
		$uni[6] = array("ú", "ù", "ụ", "ủ", "ũ", "ư", "ứ", "ừ", "ự", "ử", "ữ");
		$uni[7] = array("Ú", "Ù", "Ụ", "Ủ", "Ũ", "Ư", "Ứ", "Ừ", "Ự", "Ử", "Ữ");
		$uni[8] = array("í", "ì", "ị", "ỉ", "ĩ");
		$uni[9] = array("Í", "Ì", "Ị", "Ỉ", "Ĩ");
		$uni[10] = array("đ");
		$uni[11] = array("Đ");
		$uni[12] = array("ý", "ỳ", "ỵ", "ỷ", "ỹ");
		$uni[13] = array("Ý", "Ỳ", "Ỵ", "Ỷ", "Ỹ");
		$n = count($uni);
		for ($i = 0; $i < $n; ++$i) {
			$text = str_replace($uni[$i], $chars[$i], $text);
		}
		return $text;
	}
}

if(!function_exists('getArrayUnique')) {
    function getArrayUnique($arrayOld, $arrayNew, $isValue = true) {
        $data = array_unique(array_merge($arrayOld, $arrayNew));
		if ($isValue) {
			$data = array_values($data);
		}
		return $data;
    }
}

if(!function_exists('getCategories')) {
    function getCategories($type = 'post', $idNotIn = '') {
        $query = \Modules\Core\Entities\Category::with('translate:category_id,title,lang_code', 'children')
		->where('type', $type);
		if (!empty($idNotIn)) {
			$query = $query->where('id', '!=', $idNotIn);
		}

		return $query->select('id', 'parent_id')->get();
    }
}

if(!function_exists('getTreeCategories')) {
    function getTreeCategories($type = 'post', $idNotIn = '') {
        $query = \Modules\Core\Entities\Category::with('translate:category_id,title,lang_code,alias')
		->where('type', $type);
		if (!empty($idNotIn)) {
			$query = $query->where('id', '!=', $idNotIn);
		}

		showTreeCategories($query->get(), $result);
		return $result;
    }

	function showTreeCategories($categories, &$result, $parent_id = null, $char = '')
	{
		foreach ($categories as $key => $category)
		{
			if ($category->parent_id == $parent_id)
			{
				$result[] = [
					'id' => $category->id,
					'slug' => $category->translate->alias,
					'title' => $char . $category->translate->title,
				];
				unset($categories[$key]);
				showTreeCategories($categories, $result, $category->id, $char.'|--');
			}
		}
	}
}

if(!function_exists('getTreeEmagazines')) {
    function getTreeEmagazines($type = 'post', $idNotIn = '') {
        $query = \Modules\Core\Entities\Category::with('translate:category_id,title,lang_code,alias')
		->where(function ($query) {
			$query->where('id', 103)
				  ->orWhere('parent_id', 103);
		})
		->where('type', $type);
		if (!empty($idNotIn)) {
			$query = $query->where('id', '!=', $idNotIn);
		}

		showTreeEmagazines($query->get(), $result);
		return $result;
    }

	function showTreeEmagazines($categories, &$result, $parent_id = null, $char = '')
	{
		foreach ($categories as $key => $category)
		{
			if ($category->parent_id == $parent_id)
			{
				$result[] = [
					'id' => $category->id,
					'slug' => $category->translate->alias,
					'title' => $char . $category->translate->title,
				];
				unset($categories[$key]);
				showTreeEmagazines($categories, $result, $category->id, $char.'|--');
			}
		}
	}
}

if(!function_exists('getCategoryByIds')) {
    function getCategoryByIds($ids) {
        return \Modules\Core\Entities\Category::with(['translate:category_id,title,lang_code', 'children' => function ($query) {
			$query->with('children');
		}])
		->whereIn('id', $ids)
		->get();
    }
}

if(!function_exists('formatDateTime')) {
    function formatDateTime($date) {
		return !empty($date) ? date("Y-m-d H:i", strtotime($date)) : '';
    }
}

if(!function_exists('formatDate')) {
    function formatDate($date) {
		return !empty($date) ? date("Y-m-d", strtotime($date)) : '';
    }
}

if(!function_exists('getSettingConfig')) {
    function getSettingConfig($type) {
		return \Illuminate\Support\Facades\Cache::rememberForever($type, function () use($type){
			$config = \Modules\Core\Entities\Config::where('type', $type)->first();
			return !empty($config) ? $config->config : [];
		});
    }
}

if(!function_exists('checkModuleConfig')) {
    function checkModuleConfig($module) {
		$entityConfig = \Illuminate\Support\Facades\Cache::store('file')->rememberForever('module', function () {
            return \Modules\Core\Entities\Config::where('type', 'module')->first()->toArray();
        });

		return !empty($entityConfig['config']) ? in_array($module, $entityConfig['config']) : false;
    }
}

if (!function_exists('formatPrice')) {
	function formatPrice($price , $currency = 'đ')
	{
		$price = !empty($price) ? $price : 0;
		return number_format($price, 0, ",") . $currency;
	}
}

if (!function_exists('is_link_url')) {
    function is_link_url($string)
    {
        return filter_var($string, FILTER_VALIDATE_URL) !== false;
    }
}

if (!function_exists('set_session_customer_login')) {
    function set_session_customer_login($customer)
    {
		if (!empty($customer)) {
			$customer->letter = $customer->letter ?? '';
        	$_SESSION['customer_login'] = $customer->toArray();
		}
    }
}

if (!function_exists('remove_session_customer_login')) {
    function remove_session_customer_login()
    {
        unset($_SESSION['customer_login']);
    }
}

if (!function_exists('set_session_user_login')) {
    function set_session_user_login($user)
    {
        $_SESSION['user_login'] = $user->fullname;
    }
}

if (!function_exists('remove_session_user_login')) {
    function remove_session_user_login()
    {
        unset($_SESSION['user_login']);
    }
}

if (!function_exists('minify_html')) {
	function minify_html($html)
	{
		$search = array(
			'/(\n|^)(\x20+|\t)/',
			'/(\n|^)\/\/(.*?)(\n|$)/',
			'/\n/',
			'/\<\!--.*?-->/',
			'/(\x20+|\t)/',
			'/\>\s+\</',
			'/(\"|\')\s+\>/',
			'/=\s+(\"|\')/');

		$replace = array(
			"\n",
			"\n",
			" ",
			"",
			" ",
			"><",
			"$1>",
			"=$1");

		$html = preg_replace($search,$replace,$html);
		return $html;
	}
}
