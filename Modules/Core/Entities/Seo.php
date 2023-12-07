<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Question\Entities\QuestionAnswer;
use DB;
class Seo extends AppModel
{
	protected $fillable = array(
		'taxonomy_id',
		'taxonomy_type',
		'lang_code',
		'type',
		'alias',
		'img',
		'title',
		'description',
		'keyword',
		'published_at',
		'status',
		'updated_at',
		'created_at'           
	);
    
	public function pages()
    {
        return $this->morphTo(__FUNCTION__, 'taxonomy_type', 'taxonomy_id');
    }

    public function entity()
    {
        return $this->morphTo(__FUNCTION__, 'taxonomy_type', 'taxonomy_id');
    }

	protected static function boot() {
        parent::boot();
        static::creating(function (self $seo) {
            // $seo->published_at = date('Y-m-d H:i:s');
        });
        static::saved(function (self $seo) {
            // $seo->status = (request()->seo['status'] === 'true') ? 1 : 0;
            // DB::table($seo->type)->where('id', $seo->taxonomy_id)->update(['alias' => $seo->alias]);
        });

    }
}
