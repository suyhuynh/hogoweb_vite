@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['update'])
@slot('resource', 'users')
@slot('edit', ['id' => $user->id])
@endcomponent
@endsection

@section('content')
	@component('app::admin.components.card')
		@slot('buttons', ['update'])
		@slot('resource', 'users')
		@slot('edit', ['id' => $user->id])
		@push('form')
			@include('user::admin.users.tabs.general')
		@endpush
	@endcomponent
@endsection