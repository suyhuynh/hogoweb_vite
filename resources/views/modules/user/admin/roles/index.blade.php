@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['create'])
@slot('resource', 'roles')
@endcomponent

@endsection


@section('content')
@component('app::admin.components.table')
@slot('title', trans('user::roles.table.list'))
@slot('route', route('admin.roles.index'))
@slot('resource', 'roles')
@slot('is_status', true)
@slot('checkbox', true)
@slot('thead', [
	trans('user::roles.table.title'),
	trans('user::roles.table.department'),
	trans('user::roles.table.position'),
])

@push('tbody')
	<td>@{{ item.title }}</td>
	<td>@{{ item.option.department_title }}</td>
	<td>@{{ item.option.position_title }}</td>
@endpush
@endcomponent
@endsection
