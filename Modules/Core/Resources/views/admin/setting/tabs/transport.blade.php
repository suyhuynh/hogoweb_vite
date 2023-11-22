<div>
	<form_checkbox label="{{ trans('core::setting.transport.not_use_api') }}" v-model="form.not_use_api"></form_checkbox>
</div>
<div>
	<form_checkbox label="{{ trans('core::setting.transport.not_use_district') }}" v-model="form.not_use_district"></form_checkbox>
</div>
<div>
	<form_checkbox label="{{ trans('core::setting.transport.not_use_ward') }}" v-model="form.not_use_ward"></form_checkbox>
</div>
@push('script')
<script type="text/javascript">
	var mixin_data = {
		data: {
			form: {
				not_use_api: false,
				not_use_district: false,
				not_use_ward: false,
			}
		},
		methods: {
			
		},
		created: function () {
			@if(!empty($data->config))
				this.form = {!! json_encode($data->config) !!};
			@endif
		}
	}
</script>
@endpush