<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Core\Entities\Setting;
use Modules\Core\Http\Requests\SaveCategoryRequest;
class AdminAppController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->lang = 'vi';
    }

    public function adminApp(Request $request)
    {
        $setting = Setting::where('type', 'admin')->first();
        return view('core::admin.setting.admin_app', ['setting' => $setting]);
    }

    public function updateAdminApp(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        if($request->reset){
            $input = [
                'navbar_logo_background' => '#252b38',
                'navbar_background' => '#2a3140',
                'navbar_background_hover' => 'rgba(255,255,255,.1)',
                'navbar_color' => '#fff',
                'navbar_color_hover' => '#fff',
                'navbar_top_background' => '#FFFFFF',
                'navbar_top_background_hover' => 'rgba(0,0,0,.04)',
                'navbar_top_color' => '#333',
                'navbar_top_color_hover' => '#333'
            ];
        }
        Setting::where('type', 'admin')->update(['config' => json_encode($input), 'created_by' => auth()->id()]);
        session(['color_admin' => $input]);
        return response()->json(['success' => true, 'resource' => trans('attributes.update_success')]);
    }
}
