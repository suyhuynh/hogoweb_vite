<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Core\Entities\Groups;
use Modules\Core\Http\Requests\SaveGroupRequest;
class GroupController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Groups::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'core::groups';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'core::admin.groups';
    protected $with = ['translate', 'seo'];
    protected $variableBoolean = ['is_layout'];

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveGroupRequest::class;

    public function createFormData()
    {
        $data = [
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
        $this->disableSearchSyncing();
        \DB::beginTransaction();
        $entity = $this->getModel()->create(
            $this->getRequest('store')->all()
        );
        \DB::commit();
        $this->searchable($entity);

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity);
        }
        return response()->json([
            'success' => true, 
            'resource' => trans('core::functions.'.request()->code).' '.trans('attributes.create_success'), 
            'url' => route("{$this->getRoutePrefix()}.edit", ['id' => $entity->id, 'code' => request()->code])
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
        $entity->update(
            $this->getRequest('update')->all()
        );
        \DB::commit();
        $this->searchable($entity);
        if (method_exists($this, 'redirectTo')) {
            return response()->json(['success' => true, 
                'resource' => trans('core::functions.'.$code).' '.trans('attributes.update_success'),
                'url' => route("{$this->getRoutePrefix()}.edit", ['id' => $entity->id, 'code' => request()->code])
        ]);
        }

        return response()->json(['success' => true, 
            'resource' => trans('core::functions.'.$code).' '.trans('attributes.update_success'),
            'url' => route("{$this->getRoutePrefix()}.edit", ['id' => $entity->id, 'code' => request()->code])
        ]);
    }
}
