<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Question\Entities\QuestionAnswer;
use Modules\Core\Entities\Seo;
use Cache;

class Setting extends AppModel
{
	protected $module = 'core';
	protected $fillable = array(
        "type",
        "config",
        "updated_at",
        "created_at"           
    );
	protected $casts = [
        'config' => 'array',
    ];

    protected static function boot() {
        parent::boot();
        static::saving(function (self $entity) {
            $entity->config = json_decode(str_replace(['"true"','"false"'], ['true', 'false'], json_encode($entity->config)), true);
        });

        // static::saved(function (self $layout) {
        //     Cache::forget('check_addon');
        //     Cache::forget('check_apps');
        // });

        // static::deleting(function (self $entity) {
        //     Cache::forget('check_addon');
        //     Cache::forget('check_apps');
        // });
    }
}
