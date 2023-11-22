@extends('app::admin.layouts.master')

@section('navbar')
<div class="page-header page-header-light" id="page-header-light" style="position: fixed;z-index: 1;width: calc(100% - 13.875rem);">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('admin.dashboard.index') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ trans('resource.home') }}</a>

				<a href="{{ route('admin.units.index', ['code' => request()->code]) }}" class="breadcrumb-item">{{ trans('core::functions.units.'.request()->code) }}</a>
				<span class="breadcrumb-item active">{{ trans('resource.create') }}</span>	
			</div>

			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>

		</div>
		<div class="header-elements d-none">
			<div class="breadcrumb justify-content-center">
				<a href="{{ route('admin.units.store', ['code' => request()->code]) }}" class="btn {{ config('erp.btn_class.store.class') }} btn-sm btn-actions btn-store" style="margin-left: 5px;">
					<b><span class="{{ config('erp.btn_class.store.icon') }}"></span> </b> 
					{{ trans("resource.store") }}
				</a>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-md-6 offset-md-3">
		@component('app::admin.components.card')
		@slot('buttons', ['store'])
		@slot('resource', 'units')
		@slot('edit', ['code' => request()->code])
		@push('form')
		@include('core::admin.units.form')
		@endpush
		@endcomponent
	</div>
</div>
@endsection