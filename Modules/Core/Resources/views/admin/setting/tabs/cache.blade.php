<button class="btn btn-warning" v-on:click="callDeleteCache">{{ trans('core::setting.cache.delete_cache') }}</button>
@push('script')
<style type="text/css">
	.btn-save{
		display: none;
	}
</style>
<script type="text/javascript">
	var mixin_data = {
		data: {
			
		},
		methods: {
			callDeleteCache: function () {
				this.sendDeleteCache();
				this.sendDeleteCache();
				helper.showNotification("{{ trans('attributes.success') }}", 'success', 1000);
			},
			sendDeleteCache: function () {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('api.clear') }}',                        
                }).done( function(res , status , xhr){
                    
                });
            },
		},
		created: function () {
	
		}
	}
</script>
@endpush