<div class="form-group">
	<label for="title">{{ trans('user::roles.title') }}<code>*</code></label> 
	<input type="text" id="title" v-model="form.title" required="required" value="" class="form-control ">
</div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="title">
				{{ trans('user::departments.department') }}<code>*</code>
			</label> 
			<select2 id="department_id" v-model="form.department_id" :options="departments" name="department_id" placeholder="{{ trans('attributes.select') }}"></select2>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="title">
				{{ trans('user::positions.position') }}<code>*</code>
			</label> 
			<select2 id="position_id" v-model="form.position_id" :options="positions" name="position_id" placeholder="{{ trans('attributes.select') }}"></select2>
		</div>
	</div>
</div>
@php( $permissions = !empty($role->permissions) ? array_fill_keys(explode(',', $role->permissions), true) : [] )
<div class="row">
	@php($module = config('permissions'))
		<div class="col-md-12 col-sm-12 col-xs-12 mt-3">
			<div class="custom-control custom-checkbox">
				<input type="checkbox"  class="custom-control-input" v-model="is_all" id="all">
				<label style="font-weight: normal;" class="custom-control-label" for="all">
					{{ trans('attributes.all') }}
				</label>
			</div>
		</div>
	@foreach($module as $key => $array)
		@if(in_array(ucwords($key), $packages) || !empty(request()->administrator))
			<div class="col-md-12 col-sm-12 col-xs-12 mt-3">
				<div class="tree-checkbox-hierarchical card card-body border-left-danger border-left-2">
					<p>
						<strong>{{ trans($key.'::'.$key.'s.module') }}</strong>
					</p>
					<ul class="mb-0">
						@foreach($array as $key1 => $item)
						<li class="expanded">{{ trans($key.'::'.$key1.'.module') }}
							<ul class="list-unstyled">
								@foreach($item as $value)
								<li @if(!empty($permissions['admin.'.$key1.'.'.$value])) class="selected" @endif data-value="admin.{{ $key1 }}.{{ $value }}">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" v-model="form.permissions" class="custom-control-input" value="admin.{{ $key1 }}.{{ $value }}" id="{{ $key1 }}-{{ $value }}">
										<label style="font-weight: normal;" class="custom-control-label" for="{{ $key1 }}-{{ $value }}">
											{{ trans('resource.'.$value) }} {{ mb_strtolower(trans($key.'::'.$key1.'.module'), 'UTF-8') }}
										</label>
									</div>
								</li>
								@endforeach
							</ul>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif
	@endforeach
</div>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			departments : {!! $departments !!},
			positions : {!! $positions !!},
			is_all: false,
			form: {
				title: '{{ @$role->title }}',
				department_id: {{ !empty($role->department_id) ? $role->department_id : '0' }},
				position_id: {{ !empty($role->position_id) ? $role->position_id : '0' }},
				permissions: <?php echo !empty($role->permissions) ? json_encode(explode(',', $role->permissions)) : '[]' ?>
			}
		},
		methods: {
			
		},
		mounted() {

		},
		watch: {
			'is_all': function (status) {
				vm = this;
				vm.form.permissions = [];
				if(status == true){
					$.each($('.tree-checkbox-hierarchical .custom-checkbox input'), function(index, val) {
						vm.form.permissions.push(val.value);
					});
				}
			}
		}
	}
</script>
@endpush