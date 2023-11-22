@extends('app::admin.layouts.master')

@push('style')
<link href="{{ asset('/public/admin/assets/js/nestable/jquery.nestable.css') }}" rel="stylesheet" />
<style type="text/css">
	.dd3-handle{
		cursor: grabbing;
	}
</style>
@endpush

@section('navbar')
@component('app::admin.components.navbar')
@slot('resource', 'tabs')
@endcomponent
@endsection

@section('content')

<div class="row">
	<div class="col-md-4 col-xs-12 col-sm-5">
		@include('core::admin.tabs.form')
	</div>
	<div class="col-md-8 col-xs-12 col-sm-7" v-if="data.length">
		<div class="card">
			<div class="card-body">
				<div id="menuViewSet" class="custom-dd-empty dd">
					<ol class="dd-list">
						<li class="dd-item dd3-item" v-for="(item, key) in data" :id="'id'+item.id" :data-id="item.id" :data-code="item.order">
							<div class="dd-handle dd3-handle"></div>
							<div class="dd3-content">
								@{{ item.title }} 
								<a v-on:click="getData(item)" href="javascript:void(0)" class="text-success ml-1">
									<i class="icon-pencil7"></i>
								</a>
								<a v-on:click="destroy(key, item.id)" href="javascript:void(0)" class="text-danger ml-1">
									<i class="icon-trash"></i>
								</a>
							</div>
						</li>
					</ol>
				</div>
				<div class="text-right">
					<button type="button" class="btn btn-success" @click="saveData()">
						<i v-if="isDataLoad" class="fa fa-spinner fa-pulse fa-fw">
						</i>
						<i v-else class=" fa fa-save"></i>
						{{ trans('attributes.save') }}
					</button>
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
		mixins: [mix_children],
		data: {
			data: {!! $tabs !!},
			isDataLoad: false
		},
		methods: {
			saveData: function(){
				var vm = this;
				vm.isDataLoad = true;
				$.ajax({
					method: "POST",
					url: "{{ route('admin.tabs.sort', ['code' => request()->code]) }}",
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
			getData: function (data) {
				this.form_input = data;
			},
			destroy: function(key, id) {    
				var vm = this;
				var callbacktrue = function(){
					vm.isLoading = true;
					var formdata = new FormData;
					formdata.append('id' , id);
					helper.post( '{{ route("admin.tabs.destroy", ['code' => request()->code]) }}' , formdata ,15000)
					.done( function(res , status , xhr){
						vm.isLoading = false;
						if(res.success){
							vm.data.splice(key, 1);
							vm.destroyParent(key);
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
					'{{ trans('validation.delete_alert', ['resource' => trans('core::cores.module')]) }}', 
					'red', 
					'{{ trans('attributes.alert_cancel') }}', 
					'btn btn-danger waves-effect w-md waves-light', 
					'{{ trans('attributes.alert_success') }}', 
					'btn btn-success btn-rounded w-md waves-effect waves-light', 
					callbackfalse,
					callbacktrue
					);
			},
		},
		mounted() {
			var vm = this;
			$('#menuViewSet').nestable({
        		maxDepth: 1,
        	});
		}
	}
</script>
@endpush