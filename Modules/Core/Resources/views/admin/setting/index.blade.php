@extends('app::admin.layouts.master')

@section('navbar')
    @component('app::admin.components.navbar')
        @slot('resource', 'setting')
    @endcomponent
@endsection

@section('content')
<div class="card">
    <div class="card-heading">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <strong>{{ trans('core::setting.'.request()->key.'.title') }}</strong>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 d-none d-md-block d-sm-block text-right">
                <button class="btn btn-success btn-sm btn-save"  v-on:click="updateSetting">
                    <i class="icon-floppy-disk"></i> {{ trans('resource.update') }}
                </button>
            </div>
        </div>
    </div>
    @php
        $nav_tabs = [
            [
                'key' => 'general',
                'icon' => 'icon-cog3',
                'title' => trans('core::setting.general.title')
            ],[
                'key' => 'account_send_mail',
                'icon' => 'icon-envelop2',
                'title' => trans('core::setting.account_send_mail.title')
            ],[
                'key' => 'social',
                'icon' => 'icon-users4',
                'title' => trans('core::setting.social.title')
            ],[
                'key' => 'login',
                'icon' => 'icon-user',
                'title' => trans('core::setting.login.title')
            ],[
                'key' => 'seo',
                'icon' => 'icon-earth',
                'title' => trans('core::setting.seo.title')
            ]
        ];
        if(auth()->user()->hasAccess('admin.products.index')){
            $nav_tabs[] = [
                'key' => 'product',
                'icon' => 'icon-price-tags',
                'title' => trans('core::setting.product.title')
            ];
        }
        if(auth()->user()->hasAccess('admin.orders.index')){
            $nav_tabs[] = [
                'key' => 'order',
                'icon' => 'icon-basket',
                'title' => trans('core::setting.order.title')
            ];
        }
        
        if(!empty(get_setting_config('package', 'Transport'))){
            $nav_tabs[] = [
                'key' => 'transport',
                'icon' => 'icon-truck',
                'title' => trans('core::setting.transport.title')
            ];
        }

        $nav_tabs = array_merge($nav_tabs, [
            [
                'key' => 'config_code',
                'icon' => 'icon-ticket',
                'title' => trans('core::setting.config_code.title')
            ],[
                'key' => 'cache',
                'icon' => 'icon-folder-remove',
                'title' => trans('core::setting.cache.delete_cache')
            ]
        ]);
    @endphp
    <div class="card-body">
        <div class="d-md-flex">
            <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-200 mb-md-0 border-bottom-0">
                @foreach($nav_tabs as $val)
                <li class="nav-item">
                    <a href="{{ route('admin.settings.index', [$val['key']]) }}" class="nav-link {{ request()->key ==  $val['key'] ? 'active' : ''}}" >
                        <i class="{{ $val['icon'] }} mr-1"></i>
                        {{ $val['title'] }}
                    </a>
                </li>
                @endforeach
            </ul>

            <div class="tab-content w-100">
                <div class="tab-pane fade show active" id="vertical-left-tab1">
                    @include('core::admin.setting.tabs.'.request()->key)
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-success btn-sm btn-save" v-on:click="updateSetting">
            <i class="icon-floppy-disk"></i> {{ trans('resource.update') }}
        </button>
    </div>
</div>

@endsection
@push('script')
<script type="text/javascript">
    var mix = {
        mixins: [mixin_data],
        data:{

        },
        methods: {
            updateSetting: function () {
                var vm = this;
                vm.isLoading = true;
                vm.form._token = $('meta[name=csrf-token]').attr('content');
                vm.form.type = '{{ request()->key }}';
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.settings.save') }}',
                    data: vm.form,                        
                }).done( function(res , status , xhr){
                    vm.isLoading = false;
                    if(res.success){
                        vm.alert.success = true;
                        vm.alert.title = res.resource;

                        helper.showNotification("{{ trans('attributes.success') }}", 'success', 1000);
                        return true;
                    }else{
                        vm.alert.danger = true;
                        vm.alert.title = res.resource;
                        if(jQuery.type( res.msg ) === "string"){
                            helper.showNotification(res.msg, 'danger', 1000);
                        }
                        else{
                            $.each( res.msg, function( key, value ) {
                                $("input[name="+key+"]", 'select[name="'+key+'"]').addClass('red-border');
                                helper.showNotification(value, 'danger', 1000);
                            });
                        }
                    }
                    return false;
                }).fail(function(err){
                    vm.alert.danger = true;
                    vm.alert.title = '{{ trans('attributes.error') }}';
                    if (typeof err.responseJSON.errors != 'undefined'){
                        $.each( err.responseJSON.errors, function( key, value ) {
                            $("input[name="+key+"]", 'select[name="'+key+'"]').addClass('red-border');
                            helper.showNotification(value, 'danger', 1000);
                        });
                    }
                    helper.showNotification("{{ trans('attributes.error') }}", 'danger', 1000);
                    vm.isLoading = false;
                })   

            },
        },
        watch:{

        },
        created: function () {

        }
    }
</script>
@endpush