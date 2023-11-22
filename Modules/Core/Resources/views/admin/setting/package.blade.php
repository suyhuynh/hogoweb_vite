@extends('app::admin.layouts.master')
@section('navbar')
<div class="page-header page-header-light" id="page-header-light" style="position: fixed;z-index: 1;width: calc(100% - 13.875rem);">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard.index') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ trans('resource.home') }}</a>
                <span class="breadcrumb-item active">
                    {{ trans('core::packages.package') }}
                </span>             
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none">
                <i class="icon-more"></i>
            </a>
        </div>
        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="{{ route('admin.settings.package') }}" class="btn {{ config('erp.btn_class.update.class') }} btn-sm btn-actions btn-update" style="margin-left: 5px;">
                    <b><span class="{{ config('erp.btn_class.update.icon') }}"></span> </b> 
                    {{ trans('attributes.save') }}
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
                <strong class="text-uppercase">
                    {{ trans('core::packages.package') }}
                </strong>
            </div>
            <div class="card-body">
                @php
                    $i= -1; 
                    $count_color = count($color);
                @endphp
                @foreach(trans('core::packages.lists') as $item)
                    @php
                        $i++;
                        if($i > $count_color){
                            $i = 0;
                        }
                    @endphp
                <fieldset>
                    <legend class="text-uppercase font-size-sm font-weight-bold">
                        {{ $item['title'] }}
                    </legend>
                    <div class="row">
                        @foreach($item['packages'] as $key => $value)
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="card bg-{{ $color[$i] }}">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <strong class="text-uppercase">
                                            {{ $value['title'] }}
                                        </strong>
                                    </div>
                                    <p style="height: 50px;">{{ $value['description'] }}</p>
                                </div>

                                <div class="container-fluid">
                                    <div id="members-online">
                                        <ul class="text-right list-inline">
                                            @if(!in_array($key, $packages))
                                                <li>
                                                    <button v-on:click="package('{{ $key }}')" class="btn-sm btn-package">
                                                        <i class="icon-unlocked2 mr-1"></i> 
                                                        {{ trans('core::packages.active') }}
                                                    </button>
                                                </li>
                                            @else
                                                <li>
                                                    <button v-on:click="package('{{ $key }}')" class="btn-sm btn-package un-active">
                                                        <i class="icon-lock2 mr-1"></i> 
                                                        {{ trans('core::packages.un_active') }}
                                                    </button>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </fieldset>
                @endforeach
                
            </div>
            <div class="card-footer text-right">
                <button v-on:click="update('{{ route('admin.settings.package', ['reset' => true]) }}')" class="btn btn-warning btn-sm btn-actions btn-store" style="margin-left: 5px;">
                    <b><span class="icon-reset"></span> </b> 
                    {{ trans('attributes.reset') }}
                </button>
                <button v-on:click="update('{{ route('admin.settings.package') }}')" class="btn btn-success btn-sm btn-actions btn-store" style="margin-left: 5px;">
                    <b><span class="icon-floppy-disk"></span> </b> 
                    {{ trans('attributes.save') }}
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
        },
        methods: {
            package: function (key) {
                $.ajax({
                    type: "POST",
                    url: '{{ route("admin.settings.package") }}',
                    data: {_token: $('meta[name=csrf-token]').attr('content'), key: key},
                }).done( function(res , status , xhr){
                    if(res.success){
                        helper.showNotification("{{ trans('attributes.success') }}", 'success', 1000);
                        location.reload();
                        return true;
                    }else{
                        helper.showNotification(res.msg, 'danger', 1000);
                        return false;
                    }
                    
                }).fail(function(err){
                    helper.showNotification("{{ trans('attributes.error') }}", 'danger', 1000);
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