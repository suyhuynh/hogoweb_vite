<form>
	<ul class="nav nav-tabs nav-tabs-bottom">
		<li class="nav-item">
			<a href="#tab-info" class="nav-link active" data-toggle="tab">
				{{ trans('user::users.tab.info') }}
			</a>
		</li>
		<li class="nav-item">
			<a href="#tab-accout" class="nav-link" data-toggle="tab">
				{{ trans('user::users.tab.account') }}
			</a>
		</li>
		<li class="nav-item">
			<a href="#tab-position" class="nav-link" data-toggle="tab">
				{{ trans('user::users.tab.position') }}
			</a>
		</li>
		<li class="nav-item">
			<a href="#tab-attribute" class="nav-link" data-toggle="tab">
				{{ trans('user::users.tab.attribute') }}
			</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade show active" id="tab-info">
			<div class="row" style="align-items: center;">
				<div class="col-sx-12 col-sm-2 col-md-2">
					<image_change v-model="form.avatar" :label="'{{ trans('website::pages.form.img') }}'"></image_change>
				</div>
				<div class="col-sx-12 col-sm-10 col-md-10">
					<div class="form-group">
						<label>
							{{ trans('user::users.form.general.fullname') }} 
							<code>*</code>
						</label>
						<input type="text" class="form-control" name="fullname" v-model="form.fullname" placeholder="{{ trans('user::users.form.general.fullname') }}">
					</div>
					<div class="form-group">
						<label>
							{{ trans('user::users.form.general.phone') }}
							<code>*</code>
						</label>
						<input type="text" name="phone" class="form-control" maxlength="11" v-model="form.phone" placeholder="{{ trans('user::users.form.general.phone') }}">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>
							{{ trans('user::users.form.general.gender.title') }} <code>*</code>
						</label>
						<select name="gender" v-model="form.gender" class="form-control">
							<option value="1">{{ trans('user::users.form.general.gender.1') }}</option>
							<option value="2">{{ trans('user::users.form.general.gender.2') }}</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>
							{{ trans('user::users.form.general.birthday') }} <code>*</code>
						</label>
						<datepicker name="birthday" id="birthday" defaultdate="{{ defaultDate() }}" v-model="form.birthday" required="required"></datepicker>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>
					{{ trans('user::users.form.general.address') }} 
					<code>*</code>
				</label>
				<input type="address" name="address" class="form-control" v-model="form.address" placeholder="{{ trans('user::users.form.general.address') }}">
			</div>
			<div class="form-group">
				<label>
					{{ trans('user::users.form.general.note') }}
				</label>
				<textarea rows="2" name="note" v-model="form.note" class="form-control" placeholder="{{ trans('user::users.form.general.note') }}"></textarea>
			</div>
		</div>
		<div class="tab-pane fade" id="tab-accout">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 col-12">
					<div class="form-group">
						<label>
							{{ trans('user::users.form.general.email') }} <code>*</code>
						</label>
						<input type="email" name="email" class="form-control" v-model="form.email" placeholder="{{ trans('user::users.form.general.email') }}">
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 col-12">
					<div class="form-group">
						<label>
							{{ trans('user::users.form.general.username') }}
						</label>
						<input type="username" name="username" class="form-control" v-model="form.username" placeholder="{{ trans('user::users.form.general.username') }}">
					</div>
				</div>
			</div>
			@if (! request()->routeIs('admin.users.edit'))
			<div class="form-group">
				<label>
					{{ trans('user::users.form.general.password') }} <code>*</code>
				</label>
				<input type="password" name="password" class="form-control" v-model="form.password" placeholder="{{ trans('user::users.form.general.password') }}">
			</div>
			@endif
			<div class="form-group">
				<label for="role_id">
					{{ trans('user::users.form.general.rose') }}<code>*</code>
				</label> 
				<select2 id="role_id" name="role_id" allowclear v-model="form.role_id" :options="roles" name="role_id" placeholder="{{ trans('attributes.select') }}"></select2>
			</div>
			<div class="checkbox checkbox-custom">
				<input id="receive-mail-from" class="mr-1" type="checkbox" name="receive-mail-from" v-model="form.is_receive_mail_from_sys" value="1">
				<label for="receive-mail-from">
					Nhận mail từ hệ thống
				</label>
			</div>
		</div>
		<div class="tab-pane fade" id="tab-position">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="title">
							{{ trans('user::departments.department') }}<code>*</code>
						</label> 
						<select2 name="department_id" id="department_id" allowclear v-model="form.department_id" :options="departments" name="department_id" placeholder="{{ trans('attributes.select') }}"></select2>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="title">
							{{ trans('user::positions.position') }}<code>*</code>
						</label> 
						<select2 name="position_id" id="position_id" allowclear v-model="form.position_id" :options="positions" name="position_id" placeholder="{{ trans('attributes.select') }}"></select2>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="tab-attribute">
			<div class="form-group select-img select-img-list">
				<image_change v-model="form.cmnd_front" :label="'{{ trans('customer::customers.form.general.cmnd_front') }}'"></image_change>
			</div>
			<div class="form-group select-img select-img-list">
				<image_change v-model="form.cmnd_back" :label="'{{ trans('customer::customers.form.general.cmnd_back') }}'"></image_change>
			</div>
			<div class="form-group">
				<label>
					{{ trans('user::users.form.info.passport') }}
				</label>
				<input type="text" class="form-control" name="passport" v-model="form.passport" placeholder="{{ trans('user::users.form.info.passport') }}">
			</div>
			<div class="form-group">
				<label>
					{{ trans('user::users.form.info.country') }}
				</label>
				<select2 allowclear name="country_id" v-model="form.country_id" :options="countrys" name="country" id="country" class="form-control form-control-sm" placeholder="{{ trans('attributes.select') }}" name="parent"></select2>
			</div>

			<div class="form-group">
				<label>
					{{ trans('user::users.form.info.province') }}
				</label>
				<select2 allowclear name="province_id" v-model="form.province_id" :options="provinces" name="province" id="province" class="form-control form-control-sm" placeholder="{{ trans('attributes.select') }}" name="parent"></select2>
			</div>

			<div class="form-group">
				<label>
					{{ trans('user::users.form.info.district') }}
				</label>
				<select2 allowclear name="district_id" v-model="form.district_id" :options="districts" name="district" id="district" class="form-control form-control-sm" placeholder="{{ trans('attributes.select') }}" name="parent"></select2>
			</div>

			<div class="form-group">
				<label>
					{{ trans('user::users.form.info.ward') }}
				</label>
				<select2 allowclear name="ward_id" v-model="form.ward_id" :options="wards" name="ward" id="ward" class="form-control form-control-sm" placeholder="{{ trans('attributes.select') }}" name="parent"></select2>
			</div>
		</div>
	</div>
</form>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			positions: {!! $positions !!},
			departments: {!! $departments !!},
			roles: {!! $roles !!},
			form: {
				avatar:'',
				parent_id:'',
				position_id:'',
				department_id:'',
				employee_id:'',
				block_id:'',
				role_id:'',
				username:'',
				password:'',
				email:'',
				facebook:'',
				google:'',
				remember_token:'',
				passport:'',
				country_id:'',
				province_id:'',
				district_id:'',
				ward_id:'',
				address:'',
				gender:'',
				birthday:'',
				note:'',
				cmnd_back:'',
				is_receive_mail_from_sys: false,
			}
		},
		methods: {
			
		},
		created: function () {
			@if(!empty($user->id))
			this.form = {!! $user !!};
			@endif
		},
	}
</script>
@endpush