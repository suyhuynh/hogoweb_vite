<fieldset>
	<legend class="font-weight-bold text-uppercase">
		{{ trans('core::setting.general.contact.title') }}
	</legend>
	<form_title :label="'{{ trans('core::setting.general.contact.fullname') }}'" v-model="form.contact.fullname"></form_title>

	<form_title :label="'{{ trans('core::setting.general.contact.phone') }}'" v-model="form.contact.phone"></form_title>
	<form_title :label="'{{ trans('core::setting.general.contact.email') }}'" v-model="form.contact.email"></form_title>
	<p class="text-success">
		<strong>{{ trans('core::setting.general.register_date') }}:</strong> 
		{{ formatDate(get_setting_config('activation_date')['register_date']) }}
	</p>
</fieldset>
<fieldset>
	<legend class="font-weight-bold text-uppercase">
		{{ trans('core::setting.general.datetime') }}
	</legend>
	<div class="form-group">
		<select class="form-control" name="datetime_format" v-model="form.datetime_format">
			<option value="m/Y">m/Y (12/{{ date('Y') }})</option>
			<option value="d/m/Y">d/m/Y (31/12/{{ date('Y') }})</option>
			<option value="d/m/Y H:i">d/m/Y H:i (31/12/{{ date('Y') }} 23:30)</option>
			<option value="Y/m">Y/m ({{ date('Y') }}/12)</option>
			<option value="Y/m/d">Y/m/d ({{ date('Y') }}/12/31)</option>
			<option value="Y/m/d H:i">Y/m/d H:i ({{ date('Y') }}/12/31 23:30)</option>
			<option value="d-m-Y">d-m-Y (31-12-{{ date('Y') }})</option>
			<option value="d-m-Y H:i">d-m-Y H:i (31-12-{{ date('Y') }} 23:30)</option>
		</select>
	</div>
</fieldset>
<fieldset>
	<legend class="font-weight-bold text-uppercase">
		{{ trans('core::setting.general.contact_web') }}
	</legend>
	<form_content :label="'{{ trans('core::setting.general.contact_web') }}'" v-model="form.contact.contact_web"></form_content>
</fieldset>

@push('script')
<script type="text/javascript">
	var mixin_data = {
		data: {
			form: {
				datetime_format: 'd-m-Y H:i',
				contact: {
					fullname: '',
					email: '',
					phone: '',
				},
				contact_web: ''
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