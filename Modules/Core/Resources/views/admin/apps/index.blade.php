@extends('app::admin.layouts.master')

@section('navbar')
    @component('app::admin.components.navbar')
        @slot('resource', 'apps')
    @endcomponent
@endsection

@section('content')
    <div class="row apps">
        @if(!empty($data['packages']))
            @foreach($data['packages'] as $package => $apps)
                <div class="col-md-12 col-sm-12 col-xs-12 col-12">
                    <h2 class="border-bottom font-weight-bold" style="font-size: 14px">
                        {{ trans('core::apps.'.$package) }}
                    </h2>
                </div>
                @foreach($apps as $key => $val)
                    <div class="col-md-6 col-lg-4 col-sm-6 col-xs-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="image">
                                    <img src="{{ $val['image'] }}" title="title" class="img-responsive img-thumbnail">
                                </div>
                                <div class="title text-success">
                                    {!! $val['title'] !!}
                                </div>
                                <div class="description text-justify">
                                    {!! $val['description'] !!}
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                @if(!in_array($key,$data['apps']))
                                    <button type="button" class="btn btn-sm btn-success" v-on:click="install('{{ $key }}')">
                                        <i class="icon-download4"></i> {{ trans('core::apps.install') }}
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm btn-danger" v-on:click="uninstall('{{ $key }}')">
                                        <i class="icon-bin"></i> {{ trans('core::apps.uninstall') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        @endif
    </div>
@endsection
@push('script')
<style type="text/css">
    .apps .img-thumbnail{
        width: 100%;
        height: 160px;
        object-fit: cover;
        object-position: center;
    }
    .apps .title{
        text-align: center;
        padding: 8px 0;
        font-weight: bold;
        text-transform: uppercase;
    }
    .apps .description{
        height: 200px;
        height: 95px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;

    }
</style>
<script type="text/javascript">
    var mix = {
        data: {
            data: {!! json_encode($data['apps']) !!},
            reload: false,
        },
        methods: {
            install: function(key) {
                var vm = this;
                vm.isLoading = true;
                var formdata = new FormData;
                formdata.append('key' , key);
                helper.post('{{ route("admin.apps.install") }}', formdata ,15000)
                .done( function(res , status , xhr){
                    vm.isLoading = false;
                    if(res.success){
                        vm.reload = true;
                        helper.showNotification('{{ trans('attributes.success') }}', 'success', 1000);
                    }else{
                        helper.showNotification('{{ trans('attributes.error') }}', 'danger', 1000);
                    }
                })
                .fail(function(err){
                    vm.isLoading  = false;
                    helper.showNotification('{{ trans('attributes.error') }}', 'danger', 1000);
                })
            },
            uninstall: function(key) {
                var vm = this;
                vm.isLoading = true;
                var formdata = new FormData;
                formdata.append('key' , key);
                helper.post('{{ route("admin.apps.uninstall") }}', formdata ,15000)
                .done( function(res , status , xhr){
                    vm.isLoading = false;
                    if(res.success){
                        vm.reload = true;
                        helper.showNotification('{{ trans('attributes.success') }}', 'success', 1000);
                    }else{
                        helper.showNotification('{{ trans('attributes.error') }}', 'danger', 1000);
                    }
                })
                .fail(function(err){
                    vm.isLoading  = false;
                    helper.showNotification('{{ trans('attributes.error') }}', 'danger', 1000);
                })
            },
        },
        mounted() {
            var _this = this;
        },
        watch:{
            'reload': function (newval, oldval) {
                setTimeout(function(){
                    window.location.href = window.location.href

                }, 500);
            }
        },
        created: function () {

        }
    }
</script>
@endpush