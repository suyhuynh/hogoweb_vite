<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Core\Entities\Setting;
use Modules\Core\Http\Requests\SaveSettingRequest;

class SettingController extends Controller
{
    public function index(Request $request){
        $data = Setting::where('type', $request->key)->first();
        return view('core::admin.setting.index', compact('data'));
    }
    public function save(Request $request)
    {
        $data = $request->all();
        if(!empty($request->type)){
            unset($data['type']);
            unset($data['_token']);
        }
        return response()->json([
            'success' => true,
            'data' =>  Setting::updateOrCreate([
                'type' => $request->type
            ],[
                'config' => $data
            ])
        ]);
    }
}
