<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Question\Entities\QuestionAnswer;
use Modules\Core\Entities\Seo;
use Modules\Core\Admin\GroupTable;
use Modules\Website\Entities\Layout;

class GroupTranslate extends AppModel
{
	protected $module = 'core';
	protected $fillable = array(
        'group_id',
        'lang_code',
        'title',
        'description',
        'content',
        'img',
        'alias',
        'galleries',
        'created_at',
    );

    protected $casts = [
        'galleries' => 'array'
    ];

    const UPDATED_AT = null;
}
