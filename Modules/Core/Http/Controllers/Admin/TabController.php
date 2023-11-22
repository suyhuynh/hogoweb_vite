<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Core\Entities\Tab;
use Modules\Core\Http\Requests\SaveTabRequest;
class TabController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Tab::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'core::tabs.tab';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'core::admin.tabs';
    protected $transColunm = ['title'];

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveTabRequest::class;

    public function index(){
        $tabs = Tab::where('type', request()->code)->orderBy('order', 'asc')->get();
        return view("{$this->viewPath}.index", compact('tabs'));
    }

    public function store($code)
    {
        $this->disableSearchSyncing();
        \DB::beginTransaction();
        $data = $this->getRequest('store')->all();
        $data['type'] = $code;
        $entity = $this->getModel()->updateOrCreate(
            [
                'id' => @$data['id'],
            ], $data
        )->toArray();

        \DB::commit();
        $this->searchable($entity);

        return response()->json([
            'success' => true,
            'resource' => $this->getLabel().' '.trans('attributes.create_success'),
            'data' => $entity
        ]);
    }

    public function destroy()
    {
        \DB::beginTransaction();
            $data = Tab::find(request()->id);
            if(!empty($data->products)){
                $data->products()->delete();
            }
            // if(!empty($data->posts)){
            //     $data->posts->each->delete();
            // }
            

            $data->delete();
        \DB::commit();
        return response()->json([
            'success' => $data
        ]);
    }

    public function sort(Request $request){
        $data = $request->list;
        foreach ($data as $key => $value) {
            $menu = Tab::find($value['id']);
            $menu->order = $key;
            $menu->save();
        }
        return response()->json(['success' => true, 'resource' => trans('attributes.update_success')]); 
    }
}
