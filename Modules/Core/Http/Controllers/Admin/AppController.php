<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Entities\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AppController extends Controller
{
    public function index()
    {
        $data = [];
        $packages = Setting::whereIn('type', ['package', 'apps'])->pluck('config', 'type');
        foreach ($packages['package'] as $package) {
            $trans = trans('core::apps.apps.'.$package);
            if(is_array($trans)){
                $data['packages'][$package] = $trans;
            }
        }
        $data['apps'] = !empty($packages['apps']) ? $packages['apps'] : [];
        return view('core::admin.apps.index', compact('data'));
    }

    public function install(Request $request)
    {
        $setting = Setting::where('type', 'apps')->first();
        if(empty($setting)){
            $setting = Setting::create(['type' => 'apps', 'config' => []]);
        }
        $setting->config = array_merge($setting->config, [$request->key]);

        switch ($request->key) {
            case 'post_document_file':
                $this->postDocumentFile();
                break;
            case 'product_document_file':
                $this->productDocumentFile();
                break;
            case 'coupon':
                if(!Schema::hasTable('coupons')){
                    Schema::create('coupons', function (Blueprint $table) {
                        $table->increments('id');
                        $table->char('type')->nullable();
                        $table->char('code')->nullable();
                        $table->dateTime('from_date')->nullable();
                        $table->dateTime('to_date')->nullable();
                        $table->double('discount')->nullable();
                        $table->double('discount_max')->nullable();
                        $table->text('order')->nullable();
                        $table->text('option')->nullable();
                        $table->unsignedInteger('max_amount_use')->nullable()->default(0);
                        $table->unsignedInteger('created_by')->nullable()->default(0);
                        $table->tinyInteger('status')->default(1);
                        $table->timestamps();
                        $table->index(['id', 'created_at']);
                    });
                    break;
                }
        }
        return response()->json([
            'success' => $setting->save()
        ]);
    }

    public function uninstall(Request $request)
    {
        $setting = Setting::where('type', 'apps')->first();
        $data = $setting->config;
        if (($key = array_search($request->key, $data)) !== false) {
            unset($data[$key]);
        }
        $setting->config = $data;
        return response()->json([
            'success' => $setting->save()
        ]);
    }

    private function postDocumentFile(){
        if (!Schema::hasColumn('posts', 'file_demo')){
            Schema::table('posts', function (Blueprint $table)
            {
                $table->string('file_demo')->nullable()->after('id');
                $table->string('file_full')->nullable()->after('file_demo');
            });
        }
    }

    private function productDocumentFile(){
        if (!Schema::hasColumn('products', 'file_demo')){
            Schema::table('products', function (Blueprint $table)
            {
                $table->string('file_demo')->nullable()->after('id');
                $table->string('file_full')->nullable()->after('file_demo');
            });
        }
    }
}
