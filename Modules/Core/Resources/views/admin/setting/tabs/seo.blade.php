<fieldset>
	<legend class="font-weight-bold text-uppercase">
		{{ trans('core::setting.general.social') }}
	</legend>
	<form_title class="mb-0" :label="'{{ trans('core::setting.seo.extension') }}'" v-model="form.social"></form_title>
	<code>{{ url('/') }}/{{ trans('core::setting.seo.extension_note') }}</code>
</fieldset>
@push('script')
<script type="text/javascript">
	var mixin_data = {
		data: {
			form: {
				extension: '',
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