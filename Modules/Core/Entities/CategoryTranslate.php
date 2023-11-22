<?php

namespace Modules\Core\Entities;

use Modules\App\Entities\AppModel;

class CategoryTranslate extends AppModel
{
	protected $module = 'core';
	protected $fillable = array(
        'category_id',
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
