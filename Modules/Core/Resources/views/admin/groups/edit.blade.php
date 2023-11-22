@extends('app::admin.layouts.master')

@section('navbar')
<div class="page-header page-header-light" id="page-header-light" style="position: fixed;z-index: 1;width: calc(100% - 13.875rem);">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('admin.dashboard.index') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ trans('resource.home') }}</a>

				<a href="{{ route('admin.groups.index', ['code' => request()->code]) }}" class="breadcrumb-item">{{ trans('core::functions.group.'.request()->code) }}</a>
				<span class="breadcrumb-item active">{{ trans('resource.create') }}</span>	
			</div>

			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>

		</div>
		<div class="header-elements d-none">
			<div class="breadcrumb justify-content-center">
				<a href="{{ route('admin.groups.update', ['id' => $groups->id,'code' => request()->code]) }}" class="btn {{ config('erp.btn_class.update.class') }} btn-sm btn-actions btn-store" style="margin-left: 5px;">
					<b><span class="{{ config('erp.btn_class.update.icon') }}"></span> </b> 
					{{ trans("resource.store") }}
				</a>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		@component('app::admin.components.card')
		@slot('buttons', ['update'])
		@slot('edit', ['id' => $groups->id, 'code' => request()->code])
		@slot('edit_design', $groups->is_layout)
		@slot('resource', 'groups')
		@slot('seo', $seo)
		@push('form')
		@include('core::admin.groups.form')
		@endpush
		@endcomponent
	</div>
</div>
@endsection