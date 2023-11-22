@extends('app::admin.layouts.master')
@section('navbar')
<div class="page-header page-header-light" id="page-header-light" style="position: fixed;z-index: 1;width: calc(100% - 13.875rem);">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard.index') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ trans('resource.home') }}</a>
                <span class="breadcrumb-item active">
                    {{ trans('core::packages.admin_app') }}
                </span>             
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="{{ route('admin.settings.admin_app') }}" class="btn {{ config('erp.btn_class.update.class') }} btn-sm btn-actions btn-update" style="margin-left: 5px;">
                    <b><span class="{{ config('erp.btn_class.update.icon') }}"></span> </b> 
                    {{ trans('attributes.update') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-heading">
                <strong style="text-transform: uppercase;">
                    {{ trans('core::packages.admin_app') }}
                </strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>{{ trans('core::packages.app.navbar_logo_background') }}:</label>
                            <form_color :color="form.navbar_logo_background" v-model="form.navbar_logo_background" /> 
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>{{ trans('core::packages.app.navbar_background') }}:</label>
                            <form_color :color="form.navbar_background" v-model="form.navbar_background" /> 
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>{{ trans('core::packages.app.navbar_background_hover') }}:</label>
                            <form_color :color="form.navbar_background_hover" v-model="form.navbar_background_hover" /> 
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>{{ trans('core::packages.app.navbar_color') }}:</label>
                            <form_color :color="form.navbar_color" v-model="form.navbar_color" /> 
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>{{ trans('core::packages.app.navbar_color_hover') }}:</label>
                            <form_color :color="form.navbar_color_hover" v-model="form.navbar_color_hover" /> 
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12"><hr></div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>{{ trans('core::packages.app.navbar_top_background') }}:</label>
                            <form_color :color="form.navbar_top_background" v-model="form.navbar_top_background" /> 
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>{{ trans('core::packages.app.navbar_top_background_hover') }}:</label>
                            <form_color :color="form.navbar_top_background_hover" v-model="form.navbar_top_background_hover" /> 
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>{{ trans('core::packages.app.navbar_top_color') }}:</label>
                            <form_color :color="form.navbar_top_color" v-model="form.navbar_top_color" /> 
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>{{ trans('core::packages.app.navbar_top_color_hover') }}:</label>
                            <form_color :color="form.navbar_top_color_hover" v-model="form.navbar_top_color_hover" /> 
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-right">
            <button v-on:click="update('{{ route('admin.settings.admin_app', ['reset' => true]) }}')" class="btn btn-warning btn-sm btn-actions btn-store" style="margin-left: 5px;">
                <b><span class="icon-reset"></span> </b> 
                {{ trans('attributes.reset') }}
            </button>
            <button v-on:click="update('{{ route('admin.settings.admin_app') }}')" class="btn btn-success btn-sm btn-actions btn-store" style="margin-left: 5px;">
                <b><span class="icon-floppy-disk"></span> </b> 
                {{ trans('attributes.update') }}
            </button>

        </div>
    </div>
</div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    var mix = {
        data: {
            data: [],
            isLoading: false,
            form: {!! json_encode($setting->config) !!}
        },
        methods: {

        },
        watch:{

        },
        created: function () {

        }
    }
</script>
@endpush