@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['store'])
@slot('resource', 'users')
@endcomponent
@endsection

@section('content')
	@component('app::admin.components.card')
		@slot('buttons', ['store'])
		@slot('resource', 'users')
		@push('form')
			@include('user::admin.users.tabs.general')
		@endpush
	@endcomponent
@endsection