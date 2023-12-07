<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Entities\Setting;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->lang = 'vi';
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        set_session_user_login(auth()->user());
        return view('core::dashboard', [
            'dataModules' => $this->getTotalRowByModule()
        ]);
    }

    private function getTotalRowByModule() {
        $data = [];
        $configModule = Config::where('type', 'module')->first();
        
        if (in_array('Page', $configModule->config)) {
            $data['page'] = \Modules\Page\Entities\Page::whereHas('translates', function($q){
                return $q->where('lang_code', currentLanguageCode());
            })->count();
        }

        if (in_array('Post', $configModule->config)) {
            $data['post'] = \Modules\Post\Entities\Post::whereHas('translates', function($q){
                return $q->where('lang_code', currentLanguageCode());
            })->count();

            if (in_array('Core', $configModule->config)) {
                $data['post_category'] = \Modules\Core\Entities\Category::whereHas('translates', function($q){
                    return $q->where('lang_code', currentLanguageCode());
                })->count();
            }
        }

        if (in_array('Contact', $configModule->config)) {
            $data['contact'] = \Modules\Contact\Entities\Contact::count();
        }

        return $data;
    }
}
