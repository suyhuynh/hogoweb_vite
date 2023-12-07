<?php

namespace Modules\Core\Entities;

use Modules\Core\Entities\AppModel;
use Modules\Website\Entities\PostContent;
use Modules\Product\Entities\ProductContent;
use Illuminate\Database\Eloquent\Builder;

class Tab extends AppModel
{
	protected $module = 'core';
	// protected $fillable = array(
 //        'title',
 //        'taxonomy',
 //        'type',
 //        'order',
 //        'status',
 //        'created_by',
 //        'created_at'           
 //    );
    protected $guarded = [];
	const UPDATED_AT = null;
    
    protected static function boot() {
        parent::boot();
        static::creating(function (self $tab) {
            $tab->created_by = auth()->user()->id;
        });

        static::addGlobalScope('order_by', function (Builder $tab) {
            $tab->orderBy('order', 'asc');
        });
    }

    public function getTitleAttribute($val)
    {
        return $this['title_'.current_language()] ?? $val;
    }

    public function posts()
    {
        return $this->hasMany(PostContent::class, 'tab_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(ProductContent::class, 'tab_id', 'id');
    }
}
