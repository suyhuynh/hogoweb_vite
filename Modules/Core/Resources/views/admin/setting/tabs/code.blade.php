<fieldset>
	<legend class="font-weight-bold text-uppercase">
		{{ trans('core::setting.config_code.title') }}
	</legend>
	<form_title :label="'{{ trans('core::setting.config_code.order') }}'" v-model="form.order"></form_title>
	<form_title :label="'{{ trans('core::setting.config_code.payment') }}'" v-model="form.payment"></form_title>
</fieldset>

@push('script')
<script type="text/javascript">
	var mixin_data = {
		data: {
			form: {
				order: '',
				payment: ''
			}
		},
		created: function () {
			@if(!empty($data->config))
				this.form = {!! json_encode($data->config) !!};
			@endif
		}
	}
</script>
@endpush