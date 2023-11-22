<fieldset class="email-data">
	<legend class="font-weight-bold text-uppercase">
		{{ trans('core::setting.login.title') }}
	</legend>
	<div class="checkbox checkbox-custom mr-1 mb-2" type="checkbox">
		<input id="is_show_modal" class="mr-1" type="checkbox" name="is_show_modal" v-model="form.is_show_modal" value="1">
        <label for="is_show_modal">
            {!! trans('core::setting.login.is_show_modal') !!}
        </label>
    </div>
	<form_content :label="'{{ trans('core::setting.login.content') }}'" v-model="form.content"></form_content>
</fieldset>

@push('script')
<script type="text/javascript">
	var mixin_data = {
		data: {
			form: {
				is_show_modal: true,
				content: ``,
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