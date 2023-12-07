<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Entities\Seo;
use Modules\Core\Entities\CategoryTranslate;
use Modules\Core\Admin\CategoryTable;

class Category extends AppModel
{
	protected $module = 'core';
	protected $fillable = array(
        'type',
        'layout_id',
        'parent_id',
        'group_ids',
        'group_type_ids',
        'order',
        'published_at',
        'status',
        'is_layout',
        'header_id',
        'footer_id',
        'created_by',
        'updated_at',
        'created_at'       
    );

	protected $casts = [
        'group_ids' => 'array',
        'group_type_ids' => 'array',
        'is_layout' => 'boolean',
    ];

    protected $appends = [
        'title',
        'link'
    ];

    protected $with = [
        'translate'
    ];

    public function getTitleAttribute()
    {
        return $this->translate->title;
    }

    public function getLinkAttribute()
    {
        return $this->getURLFull();
    }

    public function getRouterEditAttribute()
    {
        return route('admin.categories.edit', ['id' => $this->id, 'code' => $this->type]);
    }

    public function translate() {
        return $this->hasOne(CategoryTranslate::class, 'category_id', 'id')->where('lang_code', current_language())->withDefault(['title' => '', 'description' => '', 'img' => '', 'alias' => '']);
    }

    public function translates() {
        return $this->hasMany(CategoryTranslate::class, 'category_id', 'id');
    }

    public function layout()
    {
        return $this->morphOne('Modules\Website\Entities\Layout', 'page')->with('widgets')->orderBy('order');
    }

    public function header()
    {
        return $this->belongsTo('Modules\Website\Entities\Layout', 'header_id', 'id')->with('widgets');
    }

    public function footer()
    {
        return $this->belongsTo('Modules\Website\Entities\Layout', 'footer_id', 'id')->with('widgets');
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id', 'id')->orderBy('order', 'asc');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id', 'id')->orderBy('order', 'asc');
    }

    public function questions()
    {
        return $this->hasMany('Modules\Question\Entities\Question', 'category_id', 'id');
    }

    public function bank_interest_rates()
    {
        return $this->hasMany('Modules\Bank\Entities\BankInterestRate', 'category_id', 'id')->with('bank');
    }

    public function posts()
    {
        return $this->hasMany('Modules\Website\Entities\Post', 'category_id', 'id')->orderBy('order', 'desc');
    }
    
    public function products()
    {
        return $this->hasMany('Modules\Product\Entities\Product', 'category_id', 'id')->orderBy('order', 'desc');
    }

    public function catalogue()
    {
        return $this->hasMany('Modules\Product\Entities\CatalogueProduct', 'category_id', 'id')->orderBy('order', 'desc');
    }

    protected static function boot() {
        parent::boot();
        static::creating(function (self $category) {
            $category->created_by = auth()->user()->id;
            $category->type = request()->code;
        });
        static::saved(function (self $category) {
            $category->updateOrCreateSeo();
            $category->updateOrCreateTranslate();
        });
        self::deleting(function($entity){
            $entity->seo()->delete();
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }
    
    public function tableQuestion($request)
    {
        $numRow = !empty($request->numRow) ? $request->numRow : 10;
        $query = $this->search($request);
        $query = $query->where('lang', getLangCode());
        if(!empty($status = request()->filter['status'])){
            $query = $query->where('status', $status);
        }
        return $query->orderBy('created_at', 'desc')
        ->orderBy('status', 'desc')
        ->paginate($numRow);
    }


    public function search($request)
    {
        $query = $this->newQuery()->with('parent', 'translate:category_id,img,title,description,alias')->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->whereHas('translate', function($q) use ($keyword){
                $q->where('title', 'like', '%'.$keyword.'%');
            });
        }
        $query = $query->where('type', $request->code);
        return $query;
    }

    public function table($request)
    {
        $query = $this->search($request);
        return new CategoryTable($query);
    }

    public function getMapData($param)
    {
        return [
            'question_href' => route('admin.questions.create', ['cat_id' => $param->id]),
            'parent' => @$param->parent->title,
            'url_view' => $this->setURLFull($param)
        ];
    }

    public function getCategoryStaffIds() {
        $ids = collect();
        $ids->push($this->id);
        if(!empty($this->children) && count($this->children)){
            $ids = $ids->merge($this->children->pluck('id')->toArray());
        }
        return $ids->all();
    }
}
