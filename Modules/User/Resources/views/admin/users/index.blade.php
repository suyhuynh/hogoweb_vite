@extends('app::admin.layouts.master')

@section('navbar')
	@component('app::admin.components.navbar')
		@slot('buttons', ['create'])
		@slot('resource', 'users')
	@endcomponent
@endsection

@section('content')
	@component('app::admin.components.table')
		@slot('title', trans('user::users.table.list'))
		@slot('route', route('admin.users.index'))
		@slot('resource', 'users')
		@slot('checkbox', true)
		@slot('thead', [
			trans('user::users.table.user'),
			trans('user::users.table.position').'/'.trans('user::users.table.department'),
			'',
		])

		@push('tbody')
			<td>
				@{{ item.fullname }}<br>
				@{{ item.email }}<br>
				@{{ item.phone }}
			</td>
			<td>
				@{{ item.position }}<br>
				@{{ item.department }}
			</td>
			<td v-html="item.change_password"></td>
		@endpush
	@endcomponent
@endsection
