@extends('core::layouts.master')

@component('core::components.breadcrumb')
    @slot('title', trans('core::cores.config.title'))
    @slot('listBreadcrumb', [
        [
            'title' => trans('core::cores.config.title'),
            'route' => route('admin.config.index')
        ]
    ])
@endcomponent

@component('core::components.form')
    @slot('resource', 'config')
    @slot('class', 'col-md-12 col-sm-12 col-xs-12 col-12')
    @slot('name', trans('core::cores.config.title'))
    @slot('button', 'store')
    @slot('form', [
        'route' => ['admin.config.store', 'key' => $requestKey],
        'method' => 'post',
        'files' => true,
        'id' => 'quickForm',
        'class' => 'needs-validation'
    ])

    @slot('content')
        <div class="row">
            <div class="col-md-3 col-sm-3 col-sx-12 col-12">
                @foreach(config('core.config_site.type') as $key => $val)
                    <a href="{{ route('admin.config.index', ['key' => $key]) }}" class="btn btn-block btn-sm btn-flat {{ ($requestKey == $key) ? 'btn-success' : 'btn-info' }}" style="font-weight: 600;text-align: left;">{{ $val }}</a>
                @endforeach
            </div>
            <div class="col-md-9 col-sm-9 col-sx-12 col-12">
                @include('core::admin.config.tab.' . $requestKey)
            </div>
        </div>
    @endslot

@endcomponent