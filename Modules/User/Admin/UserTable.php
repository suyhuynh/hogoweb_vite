<?php
namespace Modules\User\Admin;

use  Modules\Core\Admin\AdminTable;

class UserTable extends AdminTable
{
	protected $rawColumns = ['created_at', 'customer', 'type', 'status', 'change_password'];

	public function make() {
		$status = config('core.status_class');
		return $this->newTable()
		->addColumn('change_password', function ($entity) {
			$html = '';
			if(auth()->user()->hasAccess('admin.users.edit') ){
				$html = '<a href="'.route('admin.users.change_password', ['id' => $entity->id]).'" class="badge badge-flat border-warning bg-danger"><i class="icon-pencil7"></i> '.trans('user::users.change_password').'</a>';
			}
			return $html;
		})
		->addColumn('position', function ($entity) {
			return @$entity->position->title;
		})
		->addColumn('department', function ($entity) {
			return @$entity->department->title;
		})
		->addColumn('status_text', function ($entity) use ($status){
			return '<span class=" font-weight-normal badge badge-flat border-'.@$status[$entity->status].' text-'.@$status[$entity->status].'">'.trans('user::users.status.'.$entity->status).'</span>';
		})
		;
	}
}