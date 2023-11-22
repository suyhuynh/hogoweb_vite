<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Core\Entities\Category;
use Modules\Core\Http\Requests\SaveCategoryRequest;
class CategoryController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'core::categorys';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'core::admin.categorys';
    protected $with = ['translate', 'seo'];
    protected $variableBoolean = ['is_layout'];

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveCategoryRequest::class;

    public function index(Request $request)
    {
        $categories = Category::with('children')->where(function ($query) {
            return $query->with('children')->where('parent_id', 0)
                ->orWhereNull('parent_id');
        })
        ->withoutGlobalScopes()
        ->where('type', request()->code)
        ->orderBy('order', 'asc')
        ->get();

        return view("{$this->viewPath}.index", compact('categories'));
    }

    public function getResourceData()
    {
        $query_category = Category::where('type', request()->code)->with('translate');
        if(!empty(request()->id)){
            $query_category = $query_category->where('id', '<>', request()->id);   
        }
        return [
            'categorys' => $query_category->get()->pluck('translate.title', 'id')
        ];
    }

    public function createFormData()
    {
        $data = [
            'parent_id' => '',
            'group_ids' => [],
            'group_type_ids' => [],
            'is_layout' => false,
            'header_id' => 0,
            'footer_id' => 0,
            'translate' => [
                'title' => '',
                'description' => '',
                'img' => '',
                'galleries' => [],
                'file' => '',
                'alias' => '',
            ],
            'seo' => [
                'img' => '',
                'title' => '',
                'description' => '',
                'keyword' => '',
                'alias' => '',
                'status' => false,
            ]
        ];
        return [$this->getResourceName() => $data];
    }

    public function store()
    {
        $data = $this->getRequest('store')->all();
        $data['is_layout'] = $data['is_layout'] === 'false' ? false : true;
        $this->disableSearchSyncing();
        \DB::beginTransaction();
            $entity = $this->getModel()->create($data);
        \DB::commit();
        $this->searchable($entity);

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity);
        }
        return response()->json([
            'success' => true, 
            'resource' => trans('core::functions.'.request()->code).' '.trans('attributes.create_success'), 
            'url' => route("{$this->getRoutePrefix()}.index", ['code' => request()->code])
        ]);
    }

    public function edit($code, $id)
    {
        $data = array_merge([
            $this->getResourceName() => $this->getEntity($id),
        ], $this->getFormData('edit', $id), $this->getResourceData(), $this->getConfig());
        return view("{$this->viewPath}.edit", $data);
    }

    public function update($code, $id)
    {
        $entity = $this->getEntity($id);
        \DB::beginTransaction();
        $this->disableSearchSyncing();
        $data = $this->getRequest('update')->all();
        $data['is_layout'] = $data['is_layout'] === 'false' ? false : true;
        $entity->update($data);
        \DB::commit();
        $this->searchable($entity);
        if (method_exists($this, 'redirectTo')) {
            return response()->json(['success' => true, 'resource' => trans('core::functions.'.$code).' '.trans('attributes.update_success'), 'url' => route("{$this->getRoutePrefix()}.edit", ['id' => $entity->id, 'code' => request()->code])]);
        }

        return response()->json(['success' => true, 'resource' => trans('core::functions.'.$code).' '.trans('attributes.update_success'), 'url' => route("{$this->getRoutePrefix()}.edit", ['id' => $entity->id, 'code' => request()->code])]);
    }

    public function status(Request $request)
    {
        $category = $this->getModel()->withoutGlobalScope('active')->findOrFail(@$request->id);
        $category->status = ($category->status == 1) ? -1 : 1;
        return response()->json([
            'success' => $category->save()
        ]);
    }

    public function saveArrange(Request $request){
        if(!empty($request->list)){
            $data = $request->list;
            foreach ($data as $key => $value) {
                $category = Category::find($value['id']);
                $category->parent_id = 0;
                $category->order = $key+1;
                $category->save();
                if(!empty($value['children']) && count($value['children'])){
                    $this->storeChildren($value['children'], $value['id']);
                }
            }
        }
        return response()->json(['success' => true, 'resource' => trans('attributes.update_success')]); 
    }

    public function storeChildren($data, $parent_id)
    {
        foreach ($data as $key => $value) {
            $category = Category::find($value['id']);
            $category->parent_id = $parent_id;
            $category->order = $key+1;
            $category->save();
            if(!empty($value['children']) && count($value['children'])){
                $this->storeChildren($value['children'], $value['id']);
            }
        }
    }

}
