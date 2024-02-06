<?php
if (! function_exists('check_addon')) {
    function check_addon($package)
    {
        // $setting = Cache::store('file')->rememberForever('check_addon', function () {
        //     return \Modules\Core\Entities\Setting::where('type', 'package')->first();
        // });
        $setting = \Modules\Core\Entities\Setting::where('type', 'package')->first();

        return !empty($setting->where('config', 'like', '%'.$package.'%')->first());
    }
}

if (! function_exists('check_package')) {
    function check_package($package)
    {
        return !empty(\Modules\Core\Entities\Setting::where('type', 'package')->where('config', 'like', '%'.$package.'%')->first());
    }
}

if (! function_exists('check_apps')) {
    function check_apps($package)
    {
        // $setting = Cache::store('file')->rememberForever('check_apps', function () {
        //     return \Modules\Core\Entities\Setting::where('type', 'apps')->first();
        // });
        $setting = \Modules\Core\Entities\Setting::where('type', 'apps')->first();
        
        return !empty($setting) ? !empty($setting->where('config', 'like', '%'.$package.'%')->first()) : false;
    }
}

if (! function_exists('groups')) {
    function groups($type)
    {
        return \Modules\Core\Entities\Groups::where('type', $type)->with('translate')->select('id')->get()->pluck('translate.title', 'id');
    }
}
if (! function_exists('group_types')) {
    function group_types($type)
    {
        return \Modules\Core\Entities\GroupTypes::where('type', $type)->with('translate')->select('id')->get()->pluck('translate.title', 'id');
    }
}
if (! function_exists('categories')) {
    function categories($type)
    {
        return \Modules\Core\Entities\Category::where('type', $type)->with('translate', 'children')->select('id')->get()->pluck('translate.title', 'id');
    }
}

if (! function_exists('update_setting')) {
    function update_setting($type, $input = [])
    {
        $setting = \Modules\Core\Entities\Setting::where('type', $type)->first();
        if(!empty($setting) && !empty($setting->config)){
        	$input = array_merge($setting->config, $input);
        }
        return \Modules\Core\Entities\Setting::updateOrCreate([
        	'type' => $type
        ],[
        	'type' => $type,
        	'config' => $input
        ]);
    }
}
if (! function_exists('get_setting')) {
    function get_setting($type)
    {
        return \Modules\Core\Entities\Setting::where('type', $type)->first();
    }
}

if (! function_exists('get_config_by_type')) {
    function get_config_by_type($type)
    {
        $setting = \Modules\Core\Entities\Setting::where('type', $type)->first();

        return !empty($setting) ? $setting->config : null;
    }
}

if (! function_exists('get_setting_config')) {
    function get_setting_config($type, $value = '')
    {
        $data = \Modules\Core\Entities\Setting::where('type', $type)->first();
        if(!empty($data)){
            $data = $data->config;
        }
        return $data[$value] ?? $data;
    }
}

if (! function_exists('get_config_by_key')) {
    function get_config_by_key($key)
    {
        $data = \Modules\Core\Entities\Setting::where('type', 'layouts')->first();
        return !empty($data->config) ? in_array($key, $data->config) : false;
    }
}

if (! function_exists('get_folder_theme_mail')) {
    function get_folder_theme_mail()
    {
        $mails = get_setting_config('account_send_mail');
        return !empty($mails['theme_mail']['theme']) ? $mails['theme_mail']['theme'] : '01';
    }
}

if (! function_exists('get_extension_seo')) {
    function get_extension_seo()
    {
        $data = \Modules\Core\Entities\Setting::where('type', 'seo')->first();
        return !empty($data->config['extension']) ? $data->config['extension'] : '';
        
    }
}

if (! function_exists('get_contact_setting')) {
    function get_contact_setting()
    {
        $data = \Modules\Core\Entities\Setting::where('type', 'general')->first();
        return $data->config['contact']['contact_web'] ?? '';
    }
}

if (! function_exists('check_config_package')) {
    function check_config_package($package)
    {
        $data = \Modules\Core\Entities\Setting::where('type', 'package')->first();
        return !empty($data->config) ? in_array($package, $data->config) : false;
    }
}

if (! function_exists('has_addon_app')) {
    function has_addon_app($package)
    {
        $setting = \Modules\Core\Entities\Setting::where('type', 'apps')->first();
        return !empty($setting->config) ? in_array($package, $setting->config) : false;
    }
}

if (! function_exists('check_language')) {
    function check_language()
    {
        $setting = \Modules\Core\Entities\Setting::where('type', 'layouts')->first();
        
        return !empty($data->config) ? in_array('language', $data->config) : false;
    }
}

if (! function_exists('get_sort_product_config')) {
    function get_sort_product_config()
    {
        $data = \Modules\Core\Entities\Setting::where('type', 'product')->first();
        if(!empty($data)){
            $data = $data->config;
        }
        return $data[$value] ?? $data;
    }
}

if (! function_exists('get_config_code')) {
    function get_config_code($config)
    {
        $data = \Modules\Core\Entities\Setting::where('type', 'config_code')->first();
        return !empty($data->config[$config]) ? $data->config[$config] : '';
    }
}

if (! function_exists('get_payments')) {
    function get_payments($is_active = true)
    {
        $payments = [];
        $data = \Modules\Core\Entities\Setting::where('type', 'payment')->first();
        if(!empty($data->config)){
            if($is_active == true){
                $payments = collect($data->config)->where('status', 'active')->all();
            }else{
                $payments = $data->config;
            }
            
        }
        return $payments;
    }
}

if (! function_exists('visionApp')) {
    function visionApp(){
        return rand();
        return '1.0.3';
    }
}