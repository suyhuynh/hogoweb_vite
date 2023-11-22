<form_checkbox label="{{ trans('core::setting.order.delivery') }}" v-model="form.delivery"></form_checkbox>
@push('script')
<script type="text/javascript">
	var mixin_data = {
		data: {
			form: {
				delivery: false
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