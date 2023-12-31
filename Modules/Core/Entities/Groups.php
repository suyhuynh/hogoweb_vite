<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Question\Entities\QuestionAnswer;
use Modules\Core\Entities\Seo;
use Modules\Core\Entities\GroupTranslate;
use Modules\Core\Admin\GroupTable;
use Modules\Website\Entities\Layout;

class Groups extends AppModel
{
	protected $module = 'core';
	protected $fillable = array(
        "type",
        'is_layout',
        'header_id',
        'footer_id',
        "order",
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
        'title',
    ];

    protected $with = [
        'translate'
    ];

    public function getTitleAttribute()
    {
        return $this->translate->title;
    }
    
    public function translate() {
        return $this->hasOne(GroupTranslate::class, 'group_id', 'id')->where('lang_code', current_language())->withDefault(['title' => '', 'description' => '', 'img' => '', 'alias' => '']);
    }

    public function translates() {
        return $this->hasMany(GroupTranslate::class, 'group_id', 'id');
    }

    public function layout()
    {
        return $this->morphOne(Layout::class, 'page')->with('widgets')->orderBy('order');
    }

    public function header()
    {
        return $this->belongsTo(Layout::class, 'header_id', 'id')->with('widgets');
    }

    public function footer()
    {
        return $this->belongsTo(Layout::class, 'footer_id', 'id')->with('widgets');
    }

	protected static function boot() {
        parent::boot();
        static::creating(function (self $entity) {
            $entity->created_by = auth()->user()->id;
            $entity->type = request()->code;
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
        $query = $this->newQuery()->with('translate:group_id,img,title,description')->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->whereHas('translate', function($q) use ($keyword){
                $q->where('title', 'like', '%'.$keyword.'%');
            });
        }
        $query = $query->where('type', $request->code);
        return $query;
    }

    public function getLinkAttribute()
    {
        return $this->getURLFull();
    }

    public function getRouterEditAttribute()
    {
        return route('admin.groups.edit', ['id' => $this->id]);
    }

    public function table($request)
    {
        $query = $this->search($request);
        return new GroupTable($query);
    }
}
