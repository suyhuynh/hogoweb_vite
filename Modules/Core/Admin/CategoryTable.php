<?php
namespace Modules\Core\Admin;

use Modules\Core\Admin\AdminTable;

class CategoryTable extends AdminTable
{
	protected $rawColumns = ['title', 'url_design', 'url_default', 'status_text'];
	public function make() {
		$class = config('core.status_class');
		return $this->newTable()
		->editColumn('title', function ($entity){
			return '<a href="'.$entity->link.'" target="_blank">'.$entity->title.'</a>';
		})
		->addColumn('status_text', function ($entity) use ($class){
			return '<span class="font-weight-normal badge badge-flat border-'.@$class[$entity->status].' text-'.@$class[$entity->status].'">'.trans('website::pages.status.'.$entity->status).'</span>';
		})
		->addColumn('url_view', function ($entity){
			return $entity->link;
		})
		->addColumn('url_design', function ($entity){
			$html = '';
			if(auth()->user()->hasAccess('admin.layouts.design')){
				if ($entity->is_layout && !empty($entity->layout)) {
					$html = '<a v-tooltip title="'.trans('website::layouts.edit_design').'" href="'.route('admin.layouts.design', ['id' => $entity->layout->id]).'"><i class="icon-design"></i></a>';
				} else if ($entity->is_layout) {
					$html = '<a v-tooltip title="'.trans('website::layouts.create_design').'" href="'.route('admin.layouts.save_layout_theme', [
						'page_id' => $entity->id,
						'page_type' => get_class($entity),
						'type' => $entity->getTable(),
						'title' => $entity->title,
					]).'" class="save-layout"><span class=" font-weight-normal badge badge-flat border-success text--success">'.trans('website::layouts.create_design').'</span></a>';
				}
			}
			return $html;
		})
		;
	}
}