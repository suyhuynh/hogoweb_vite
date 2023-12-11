@extends('app::admin.layouts.master')

@section('navbar')
@component('app::admin.components.navbar')
@slot('buttons', ['update'])
@slot('edit', ['id' => $position->id])
@slot('resource', 'positions')
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-6 offset-md-3">
		@component('app::admin.components.card')
		@slot('buttons', ['update'])
		@slot('edit', ['id' => $position->id])
		@slot('resource', 'positions')
		@push('form')
		@include('user::admin.positions.form')
		@endpush
		@endcomponent
	</div>
</div>
@endsection