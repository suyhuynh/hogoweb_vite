<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Entities\Seo;
use Modules\Core\Entities\GroupTypeTranslate;

class GroupTypes extends AppModel
{
	protected $module = 'core';
	protected $fillable = array(
        "order",
        'is_layout',
        'header_id',
        'footer_id',
        "type",
        "author",
        "published_at",
        "status",
        "created_by",
        "updated_at",
        "created_at"           
    );
	
    protected $casts = [
        'is_layout' => 'boolean',
    ];
    
    protected $appends = [
        'title'
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
        return route('admin.group_types.edit', ['id' => $this->id]);
    }
    
    public function translate() {
        return $this->hasOne(GroupTypeTranslate::class, 'group_type_id', 'id')->where('lang_code', current_language())->withDefault(['title' => '', 'description' => '', 'img' => '', 'alias' => '']);
    }

    public function translates() {
        return $this->hasMany(GroupTypeTranslate::class, 'group_type_id', 'id');
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
    
    public function questions()
    {
        return $this->hasMany('Modules\Question\Entities\Question', 'group_type_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany('Modules\Website\Entities\Post', 'category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('Modules\Product\Entities\Product', 'category_id', 'id');
    }
    
	protected static function boot() {
        parent::boot();
        static::creating(function (self $group_type) {
            $group_type->created_by = auth()->user()->id;
            $group_type->type = request()->code;
        });
        static::saved(function (self $entity) {
            $entity->updateOrCreateSeo();
            $entity->updateOrCreateTranslate();
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
        $query = $this->newQuery()->with('translate:group_type_id,img,title,description')->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->whereHas('translate', function($q) use ($keyword){
                $q->where('title', 'like', '%'.$keyword.'%');
            });
        }
        $query = $query->where('type', $request->code);
        return $query;
    }
}
