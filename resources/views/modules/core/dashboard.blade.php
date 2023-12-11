@extends('core::layouts.master')

@component('core::components.breadcrumb')
@slot('title', trans('core::cores.sidebar.dashboard'))
@slot('listBreadcrumb', [
[
'title' => trans('core::cores.sidebar.dashboard'),
'route' => route('admin.dashboard.index')
]
])
@endcomponent

@section('content')

<div class="row">
    @if(count($dataModules))
        @foreach($dataModules as $key => $total)
            <div class="col-lg-3 col-xs-6">
                @include('core::admin.partials.dashboard.' . $key, ['total' => $total])
            </div>
        @endforeach
    @endif
</div>
@endsection
