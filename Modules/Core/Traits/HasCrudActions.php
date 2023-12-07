<?php

namespace Modules\Core\Traits;

use Illuminate\Http\Request;
use Modules\Support\Search\Searchable;
use Illuminate\Support\Facades\DB;

trait HasCrudActions
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('query')) {
            return $this->getModel()
                ->search($request->get('query'))
                // ->query()
                ->limit($request->get('limit', 10))
                ->get();
        }

        if ($request->has('table')) {
            return $this->getModel()->table($request);
        }

        return view("{$this->viewPath}.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array_merge([
            $this->getResourceName() => $this->getModel(),
        ], $this->getFormData('create'));

        return view("{$this->viewPath}.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->disableSearchSyncing();
        $dataRequest = $this->filterRequest($this->getRequest('store'));
        DB::beginTransaction();
            $entity = $this->getModel()->create($dataRequest);
            $this->saveRelationship($entity, $dataRequest);
            $this->searchable($entity);
        DB::commit();
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity);
        }

        return response()->json([
            'success' => true,
            'resource' => trans('core::cores.msg.resource_saved', ['resource' => $this->getLabel()]), 
            'url' => isset(request()->onload) ? route("{$this->getRoutePrefix()}.edit", ['id' => $entity->id]) : route("{$this->getRoutePrefix()}.index")
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = $this->getEntity($id);

        if (request()->wantsJson()) {
            return $entity;
        }
        return view("{$this->viewPath}.show")->with($this->getResourceName(), $entity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array_merge([
            $this->getResourceName() => $this->getEntity($id),
        ], $this->getFormData('edit', $id));

        return view("{$this->viewPath}.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $entity = $this->getEntity($id);

        $this->disableSearchSyncing();

        $dataRequest = $this->filterRequest($this->getRequest('update'));

        DB::beginTransaction();
            $entity->update($dataRequest);
            $this->saveRelationship($entity, $dataRequest);
        DB::commit();

        $this->searchable($entity);

        return response()->json([
            'success' => true,
            'resource' => trans('core::cores.msg.resource_saved', ['resource' => $this->getLabel()]),
            'url' => !isset(request()->onload) ? route("{$this->getRoutePrefix()}.index") : ''
        
        ]);
    }

    /**
     * Update status the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus()
    {
        return response()->json([
            'success' => $this->getModel()->withoutGlobalScope('active')->whereIn('id', explode(',', request()->ids))->update(['status' => request()->key])
        ]);
    }

    /**
     * Destroy resources by given ids.
     *
     * @param string $ids
     * @return void
     */
    public function destroy($ids)
    {
        return response()->json([
            'success' => $this->getModel()->withoutGlobalScope('active')->whereIn('id', explode(',', $ids))->delete()
        ]);
    }

    /**
     * Get an entity by the given id.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function getEntity($id)
    {
        return $this->getModel()
            ->with($this->relations())
            ->withoutGlobalScope('active')
            ->findOrFail($id);
    }

    /**
     * Get the relations that should be eager loaded.
     *
     * @return array
     */
    private function relations()
    {
        return collect($this->with ?? [])->mapWithKeys(function ($relation) {
            return [$relation => function ($query) {
                return $query->withoutGlobalScope('active');
            }];
        })->all();
    }

    /**
     * Get form data for the given action.
     *
     * @param string $action
     * @param mixed ...$args
     * @return array
     */
    protected function getFormData($action, ...$args)
    {
        if (method_exists($this, 'formData')) {
            return  $this->formData(...$args);
        }

        if ($action === 'create' && method_exists($this, 'createFormData')) {
            return $this->createFormData();
        }

        if ($action === 'edit' && method_exists($this, 'editFormData')) {
            return $this->editFormData(...$args);
        }

        return [];
    }

    /**
     * Get name of the resource.
     *
     * @return string
     */
    protected function getResourceName()
    {
        if (isset($this->resourceName)) {
            return $this->resourceName;
        }

        return lcfirst(class_basename($this->model));
    }

    /**
     * Get label of the resource.
     *
     * @return void
     */
    protected function getLabel()
    {
        return trans($this->label);
    }

    /**
     * Get route prefix of the resource.
     *
     * @return string
     */
    protected function getRoutePrefix()
    {
        if (isset($this->routePrefix)) {
            return $this->routePrefix;
        }

        return "admin.{$this->getModel()->getTable()}";
    }


    protected function getModel()
    {
        return new $this->model;
    }

    /**
     * Get request object
     *
     * @param string $action
     * @return \Illuminate\Http\Request
     */
    protected function getRequest($action)
    {
        if (! isset($this->validation)) {
            return request();
        }

        if (isset($this->validation[$action])) {
            return resolve($this->validation[$action]);
        }

        return resolve($this->validation);
    }

    /**
     * Disable search syncing for the entity.
     *
     * @return void
     */
    protected function disableSearchSyncing()
    {
        if ($this->isSearchable()) {
            $this->getModel()->disableSearchSyncing();
        }
    }

    /**
     * Determine if the entity is searchable.
     *
     * @return bool
     */
    protected function isSearchable()
    {
        return in_array(Searchable::class, class_uses_recursive($this->getModel()));
    }

    /**
     * Make the given model instance searchable.
     *
     * @return void
     */
    protected function searchable($entity)
    {
        if ($this->isSearchable($entity)) {
            $entity->searchable();
        }
    }

    public function restore($ids)
    {
        return $this->getModel()->whereIn('id', explode(',', $ids))->restore();
    }

    public function forceDelete($ids)
    {
        return $this->getModel()->whereIn('id', explode(',', $ids))->forceDelete();
    }
    
    /**
     * saveRelationship
     *
     * @param  object $entity
     * @param  array $data
     * @return void
     */
    public function saveRelationship($entity, $data = []) {
        return '';
    }
    
    /**
     * Filter request
     *
     * @param  object $data
     * @return array
     */
    public function filterRequest($data) {
        return $data->toArray();
    }
}
