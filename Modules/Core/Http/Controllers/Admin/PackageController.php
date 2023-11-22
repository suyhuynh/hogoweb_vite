<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Core\Entities\Setting;
use Modules\Core\Http\Requests\SaveCategoryRequest;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $data = [];
        $setting = Setting::where('type', 'package')->first();
        $data['packages'] = [];
        if(!empty($setting->config)){
            if(in_array('web', $setting->config)){
                $setting->config = array_merge($setting->config, ['page', 'post', 'website']);
            }
            $data['packages'] = array_merge($data['packages'], $setting->config);
        }
        
        $data['color'] = [
            'primary-600',
            'success-600',
            'info-600',
            'pink-600',
            'violet-600',
            'purple-600',
            'indigo-600',
            'blue-600',
            'teal-600',
            'green-600',
            'orange-600',
            'brown-600',
            'grey-600',
            'slate-600',
        ];
        return view('core::admin.setting.package', $data);
    }

    public function package(Request $request)
    {
        $setting = Setting::where('type', 'package')->first();
        $input = [$request->key];
        if(!empty($setting->config)){
            if(in_array($request->key, $setting->config)){
                $input = array_diff($setting->config, $input);
            }else{
                $input = array_merge($input, $setting->config);
                \Artisan::call('module:migrate', ['module' => $request->key, '--force' => true]);
            }
        }else{
            \Artisan::call('module:migrate', ['module' => $request->key, '--force' => true]);
        }

        $setting = Setting::updateOrCreate(
            [
                'type' => 'package'
            ],
            [
                'config' => $input
            ]
        );
        return response()->json(['success' => true, 'resource' => trans('attributes.update_success')]);
    }
}
