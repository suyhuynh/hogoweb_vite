<div class="form-group">
	<label for="title">{{ trans('core::units.module') }}<code>*</code></label> 
	<input type="text" id="title" v-model="form.title" required="required" value="" class="form-control ">
</div>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			form: {
				title: '{{ @$units->title }}'
			}
		},
		methods: {
			
		}
	}
</script>
@endpush