@extends('app::admin.layouts.master')

@push('style')
<link href="{{ asset('/public/admin/assets/js/nestable/jquery.nestable.css') }}" rel="stylesheet" />
<style type="text/css">
    #accordion-group .card{
        border-radius: 0;
    }
    #accordion-group .card:last-child {
        border-bottom: 1px solid rgba(0,0,0,.125) !important;
    }
    .create-menu li:first-child a{
        border-top: 1px dashed #48a79b;
    }
    .create-menu li a{
        padding: 5px;
        display: block;
        cursor: pointer;
        position: relative;
        border-bottom: 1px dashed #48a79b;
    }
    .create-menu li a i{
        position: absolute;
        right: 0;
        top: 20%;
    }
    #menuViewSet .dd3-content a{
        border: 1px solid;
        width: 25px;
        height: 25px;
        display: inline-block;
        text-align: center !important;
        line-height: 25px;
        border-radius: 50px;
        font-size: 12px;
    }
    #menuViewSet .dd3-content a i{
        font-size: 12px;
    }
    #menuViewSet .dd3-content{
        height: 35px;
    }
    .dd3-handle{
        width: 35px;
        height: 35px;
    }
    .dd3-handle:before{
        top: 6px;
    }
    #menuViewSet .dd3-content .save-layout{
        width: auto;
        padding: 0 10px;
    }
    #menuViewSet .dd3-content .status-tiem{
        position: absolute;
        right: 5px;
    }
</style>
@endpush

@section('navbar')
<div class="page-header page-header-light" id="page-header-light" style="position: fixed;z-index: 1;width: calc(100% - 13.875rem);">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('admin.dashboard.index') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ trans('resource.home') }}</a>
				<span class="breadcrumb-item active">
					{{ trans('core::functions.'.request()->code) }}
				</span>				
			</div>

			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
		<div class="header-elements d-none">
			<div class="breadcrumb justify-content-center">
				<a href="{{ route('admin.categories.create', ['code' => request()->code]) }}" class="btn {{ config('erp.btn_class.create.class') }} btn-sm btn-actions btn-create" style="margin-left: 5px;">
					<b><span class="{{ config('erp.btn_class.create.icon') }}"></span> </b> 
					{{ trans("resource.create") }}
				</a>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')

@php
function menuCategory($data_categories){
    $html = '<ol class="dd-list">';
    foreach ($data_categories as $category) {
        $html .=  '<li class="dd-item dd3-item" id="dataID'.$category->id.'" data-id="'.$category->id.'" data-code="'.$category->order.'">
        <div class="dd-handle dd3-handle"></div>
        <div class="dd3-content">'.$category->translate->title;
        if(auth()->user()->hasAccess('admin.layouts.design')){
            if ($category->is_layout && !empty($category->layout)) {
                $html .= '<a class="ml-2" v-tooltip title="'.trans('website::layouts.edit_design').'" href="'.route('admin.layouts.design', ['id' => $category->layout->id]).'"><i class="icon-design"></i></a>';
            } else if ($category->is_layout) {
                $html .= '<a v-tooltip title="'.trans('website::layouts.create_design').'" href="'.route('admin.layouts.save_layout_theme', [
                    'page_id' => $category->id,
                    'page_type' => get_class($category),
                    'type' => $category->getTable(),
                    'title' => $category->title,
                ]).'" class="save-layout ml-2">'.trans('website::layouts.create_design').'</a>';
            }
        }
        $html .=  '
        <a href="'.$category->link.'" target="_blank" class="text-info"><i class="icon-eye"></i></a>

        <a class="text-primary text-right edit" href="'.$category->router_edit.'"><i class="fa fa-edit"></i></a>
        <a class="text-right text-danger delete" v-on:click="destroy('.$category->id.')" data-id="'.$category->id.'" title="Xóa" href="javascript:void(0)">
        <i class="fa fa-trash"></i>
        </a>
        <a v-on:click="updateStatusItem('.$category->id.')" class="status-tiem category_'.$category->id.' '.(($category->status == 1) ? 'text-success' : 'text-warning').'" v-tooltip title="'.trans('resource.status').'">
        <i class="icon-switch"></i>
        </a>
        </div>';
        if(!empty($category->children) && count($category->children)){
            $html .= menuCategory($category->children);
        }
        $html .= '</li>';
    }
    $html .= '</ol>';
    return $html;
}
@endphp
@php ($param = !empty($param) ? $param : [])
<div class="row table-data">
    <div class="col-md-12">
        <div class="card">
            <div class="card-heading">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <p style="margin-top: 8px;margin-bottom: 0;text-transform: uppercase;"><strong>{{ trans('core::functions.'.request()->code) }}</strong></p>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <button type="button" class="btn btn-success btn-sm" v-on:click="saveData()">
                        <i v-if="isDataLoad" class="fa fa-spinner fa-pulse fa-fw">
                        </i>
                        <i v-else class="fa fa-save"></i>
                        {{ trans('attributes.save') }}
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="menuViewSet" class="custom-dd-empty dd" style="width: 100%;max-width: 100%;">
                {!! menuCategory($categories) !!}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('script')
<script src="{{ asset('/public/admin/assets/js/nestable/jquery.nestable.js') }}"></script>
<script type="text/javascript">
    var mix = {
        data: {
            data: [],
            isDataLoad: false,
            isLoading: false,
            ids: [],
            check_all: false,
            pagination:{
                limit : 0,
                current : 1,
                numRow: 10,
                page : 1,
                total: 0,
                keyword: '',
            },
        },
        methods: {
            updateStatusItem: function(id) {
                var vm = this;
                var status_code = 1;
                if($('.category_'+id).hasClass('text-warning')){
                    $('.category_'+id).removeClass('text-warning').addClass('text-success');
                }else{
                    $('.category_'+id).removeClass('text-success').addClass('text-warning');
                }
                var callbacktrue = function () {
                    vm.isLoading = true;
                    var formdata = new FormData;
                    formdata.append('id' , id);
                    helper.post( '{{ route("admin.categories.status", ['code' => request()->code]) }}' , formdata ,15000)
                    .done( function(res , status , xhr){
                        vm.isLoading = false;
                        if(res.success){
                            helper.showNotification('{{ trans('attributes.success') }}', 'success', 1000);
                        }else{
                            helper.showNotification('{{ trans('attributes.error') }}', 'danger', 1000);
                        }
                        
                    })
                    .fail(function(err){
                        vm.isLoading  = false;
                        helper.showNotification('{{ trans('attributes.error') }}', 'danger', 1000);
                    })
                };
                var callbackfalse = function () {};
                helper.confirmDialogMulti(
                    '{{ trans('attributes.alert') }}',
                    '{{ trans('validation.status_alert', ['resource' => trans('core::categorys.module')]) }}', 
                    'red', 
                    '{{ trans('attributes.alert_cancel') }}', 
                    'btn btn-danger waves-effect w-md waves-light', 
                    '{{ trans('attributes.alert_success') }}', 
                    'btn btn-success btn-rounded w-md waves-effect waves-light', 
                    callbackfalse,
                    callbacktrue
                );
            },
            destroy: function(id = '') {    
                var vm = this;
                if(id != ''){
                    vm.ids.push(id);
                }
                var callbacktrue = function(){
                    vm.isLoading = true;
                    var formdata = new FormData;
                    formdata.append('ids' , vm.ids.toString());
                    helper.post( '{{ route("admin.categories.destroy", ['code' => request()->code]) }}' , formdata ,15000)
                    .done( function(res , status , xhr){
                        vm.isLoading = false;
                        if(res.success){
                            vm.load();
                            vm.ids = [];
                            helper.showNotification('{{ trans('attributes.success') }}', 'success', 1000);
                        }else{
                            helper.showNotification('{{ trans('attributes.error') }}', 'danger', 1000);
                        }
                    })
                    .fail(function(err){
                        vm.isLoading  = false;
                        helper.showNotification('{{ trans('attributes.error') }}', 'danger', 1000);
                    })
                };
                var callbackfalse = function(){};
                helper.confirmDialogMulti(
                    '{{ trans('attributes.alert') }}',
                    '{{ trans('validation.delete_alert', ['resource' => trans('core::categorys.module')]) }}', 
                    'red', 
                    '{{ trans('attributes.alert_cancel') }}', 
                    'btn btn-danger waves-effect w-md waves-light', 
                    '{{ trans('attributes.alert_success') }}', 
                    'btn btn-success btn-rounded w-md waves-effect waves-light', 
                    callbackfalse,
                    callbacktrue
                    );
            },
            saveData: function(){
                var vm = this;
                vm.isDataLoad = true;
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.categories.save_arrange', ['code' => request()->code]) }}",
                    dataType: 'json',
                    data: {
                        list: $('.dd').nestable('serialize'),
                        _token: $('meta[name=csrf-token]').attr('content')
                    }
                }).done( function(res){
                    vm.isDataLoad = false;
                    helper.showNotification('Đã lưu', 'success', 1000);
                })
                .fail(function(err){
                    vm.isDataLoad = false;
                })
            },
        },
        mounted() {
            var _this = this;
            $('#menuViewSet').nestable({
                maxDepth: 5,
            });
            $('.save-layout').on('click', function(event) {
                event.preventDefault();
                var url = $(this).attr('href');
                var callbacktrue = function(){
                    var formdata = new FormData;
                    helper.post(url , formdata ,15000)
                    .done( function(res , status , xhr){
                        window.location = res.link;
                    })
                    .fail(function(err){
                        vm.isLoading  = false;
                        helper.showNotification('{{ trans('attributes.error') }}', 'danger', 1000);
                    })
                };
                var callbackfalse = function(){};
                helper.confirmDialogMulti(
                    '{{ trans('attributes.alert') }}',
                    '{{ trans('message.alert_create_layout') }}', 
                    'red', 
                    '{{ trans('attributes.alert_cancel') }}', 
                    'btn btn-danger waves-effect w-md waves-light', 
                    '{{ trans('attributes.alert_success') }}', 
                    'btn btn-success btn-rounded w-md waves-effect waves-light', 
                    callbackfalse,
                    callbacktrue
                    );
            });
        },
        watch:{
            'pagination.page': function (newval, oldval) {
                if( newval != oldval){
                    this.load();
                }
            },
            'pagination.numRow': function (newval, oldval) {
                if( newval != oldval){
                    this.load(1);
                }
            },
            'check_all': function (newval, oldval) {
                var vm = this;
                if(this.check_all){
                    for (var i = 0; i < vm.data.length; i++) {
                        vm.ids.push(vm.data[i].id);
                    }
                }
                else{
                    vm.ids = [];
                }
            },
        },
        created: function () {

        }
    }
</script>
@endpush