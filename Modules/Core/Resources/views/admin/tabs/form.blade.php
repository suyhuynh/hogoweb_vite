<div class="card">
	<div class="card-body">
		<div class="form-group">
			<label class="control-label" for="category">
				{{ trans('core::tabs.form.title') }}<code>*</code>:
			</label>
			<input type="text" class="form-control form-control-sm" v-model="form_input.title" name="title" placeholder="{{ trans('core::tabs.form.title') }}">
		</div>
		<div class="form-group form-group-feedback form-group-feedback-right mb-0">
			<label class="control-label" for="type">
				{{ trans('core::tabs.form.taxonomy') }}:
			</label>
			<select2 allowclear v-model="form_input.taxonomy" :options="configs" name="key" class="form-control form-control-sm" placeholder="{{ trans('attributes.select') }}"></select2>
		</div>
	</div>
	<div class="card-footer text-right">
		<button class="btn btn-sm btn-success" v-on:click="save">
			<i class="icon-floppy-disk"></i> {{ trans('attributes.save') }}
		</button>
	</div>
</div>
@push('script')
<script type="text/javascript">
	var mix_children = {
		data: {
			form_input: {
				title:'',
				taxonomy:'content',
			},
			configs: {
				content: 'Content',
				comment: 'Comment',
			},
		},
		methods: {
			destroyParent: function (key) {
				this.parents.splice(key, 1);
			},
			save: function () {
				var vm = this;
				vm.isLoading = true;
				vm.form_input._token = $('meta[name=csrf-token]').attr('content');
				$.ajax({
					type: "POST",
					url: '{{ route("admin.tabs.store", ['code' => request()->code]) }}',
					data: vm.form_input,                        
				}).done( function(res , status , xhr){
					vm.isLoading = false;
					if(res.success){
						vm.alert.success = true;
						vm.alert.title = res.resource;
						if(!vm.form_input.id){
							vm.data.push(res.data);
						}
						vm.form_input = {
							title:'',
							taxonomy:'content',
						};
						helper.showNotification("{{ trans('attributes.success') }}", 'success', 1000);
						return true;
					}else{
						vm.alert.danger = true;
						vm.alert.title = res.resource;
						if(jQuery.type( res.msg ) === "string"){
							helper.showNotification(res.msg, 'danger', 1000);
						}
						else{
							$.each( res.msg, function( key, value ) {
								$("input[name="+key+"]").addClass('red-border').focus();
								helper.showNotification(value, 'danger', 1000);
								setTimeout(function(){ $("input[name="+key+"]").removeClass('red-border'); }, 3000);
							});
						}
					}
					return false;
				}).fail(function(err){
					console.log(err);
					vm.alert.danger = true;
					vm.alert.title = '{{ trans('attributes.error') }}';
					if (typeof err.responseJSON.errors != 'undefined'){
						$.each( err.responseJSON.errors, function( key, value ) {
							$("input[name="+key+"]").addClass('red-border').focus();
							helper.showNotification(value, 'danger', 1000);
							setTimeout(function(){ $("input[name="+key+"]").removeClass('red-border'); }, 3000);
						});
					}
					helper.showNotification("{{ trans('attributes.error') }}", 'danger', 1000);
					vm.isLoading = false;
				});
			},
		}
	}
</script>
@endpush