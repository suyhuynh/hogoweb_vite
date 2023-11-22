@extends('app::admin.layouts.master')
@section('content')
<div class="row">
	<div class="col-sx-12 col-sm-12 col-lg-10 col-md-8 offset-lg-1 offset-md-2">
		<div class="card">
			<div class="card-heading">
				<strong style="text-transform: uppercase;">
					{{ trans('user::users.profile') }}
				</strong>
			</div>
			<div class="card-body">
				<form action="#" method="post">
					<fieldset>
						<legend class="font-weight-semibold text-uppercase font-size-sm">
							<i class="icon-user mr-2"></i>
							{{ trans('user::users.form.general.title') }}
						</legend>

						<div class="collapse show">
							<div class="row">
								<div class="col-sx-12 col-sm-2 col-md-2">
									<div class="form-group select-img">
										<label class="control-label">
											{{ trans('user::users.form.general.avatar') }} 
										</label>
										<div class="text-center">
											<template v-if="form.avatar">
												<a class="remove-img" v-on:click="removeImg('form.avatar')"><i class="fa fa-times-circle fa-2x text-danger"></i></a>
											</template>
											<img :src="form.avatar ? form.avatar : '/public/admin/assets/img/uploadCroup.png' " v-on:click="showGallery('primary_image', 'form.avatar')" class="img-responsive cursor">
										</div>
									</div>
								</div>
								<div class="col-sx-12 col-sm-10 col-md-10">
									<div class="form-group">
										<label>
											{{ trans('user::users.form.general.fullname') }} 
											<code>*</code>
										</label>
										<input type="text" class="form-control" v-model="form.fullname" placeholder="{{ trans('user::users.form.general.fullname') }}">
									</div>
									<div class="form-group">
										<label>
											{{ trans('user::users.form.general.phone') }}
											<code>*</code>
										</label>
										<input type="text" class="form-control" maxlength="11" v-model="form.phone" placeholder="{{ trans('user::users.form.general.phone') }}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>
									{{ trans('user::users.form.general.address') }} 
									<code>*</code>
								</label>
								<input type="address" class="form-control" v-model="form.address" placeholder="{{ trans('user::users.form.general.address') }}">
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
										<datepicker id="birthday" v-model="form.birthday" required="required"></datepicker>
									</div>
								</div>
							</div>
							@include('customer::admin.partials.passport_img')
							<div class="form-group">
								<label>
									{{ trans('user::users.form.general.note') }}
								</label>
								<textarea rows="2" v-model="form.note" class="form-control" placeholder="{{ trans('user::users.form.general.note') }}"></textarea>
							</div>
						</div>
					</fieldset>

					<fieldset>
						<legend class="font-weight-semibold text-uppercase font-size-sm">
							<i class="icon-reading mr-2"></i>
							{{ trans('user::users.form.info.title') }}
							<a class="float-right text-default" data-toggle="collapse" data-target="#info">
								<i class="icon-circle-down2"></i>
							</a>
						</legend>

						<div class="collapse" id="info">
							<div class="form-group">
								<label>
									{{ trans('user::users.form.info.passport') }}
								</label>
								<input type="text" class="form-control" v-model="form.passport" placeholder="{{ trans('user::users.form.info.passport') }}">
							</div>
							<div class="form-group">
								<label>
									{{ trans('user::users.form.info.country') }}
								</label>
								<select2 allowclear v-model="form.country_id" :options="countrys" name="country" id="country" class="form-control form-control-sm" placeholder="{{ trans('attributes.select') }}" name="parent"></select2>
							</div>

							<div class="form-group">
								<label>
									{{ trans('user::users.form.info.province') }}
								</label>
								<select2 allowclear v-model="form.province_id" :options="provinces" name="province" id="province" class="form-control form-control-sm" placeholder="{{ trans('attributes.select') }}" name="parent"></select2>
							</div>

							<div class="form-group">
								<label>
									{{ trans('user::users.form.info.district') }}
								</label>
								<select2 allowclear v-model="form.district_id" :options="districts" name="district" id="district" class="form-control form-control-sm" placeholder="{{ trans('attributes.select') }}" name="parent"></select2>
							</div>

							<div class="form-group">
								<label>
									{{ trans('user::users.form.info.ward') }}
								</label>
								<select2 allowclear v-model="form.ward_id" :options="wards" name="ward" id="ward" class="form-control form-control-sm" placeholder="{{ trans('attributes.select') }}" name="parent"></select2>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="card-footer text-right">
				<a onclick="history.back();" style="cursor: pointer;" class="btn btn-warning btn-sm">
					<b><span class="icon-reply"></span></b>
					{{ trans('attributes.back') }}
				</a>
				<button v-on:click="update('{{ route('admin.account.profile', ['id' => auth()->id()]) }}')" class="btn btn-success btn-sm btn-actions btn-store" style="margin-left: 5px;">
					<b><span class="icon-floppy-disk"></span> </b> 
					{{ trans('attributes.update') }}
				</button>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
<script type="text/javascript">
	var profile = {!! json_encode($profile->only('avatar', 'note',	'fullname',	'phone', 'passport',	'country_id', 'province_id', 'district_id', 'ward_id', 'address', 'gender', 'birthday',	'cmnd_back', 'cmnd_front', 'facebook', 'google') ) !!};
	var only_user_id = {{ auth()->id() }};
	var mix = {
		data: {
			form: {
				avatar: '',
				note: '',
				fullname: '',
				phone: '',
				passport: '',
				country_id: '',
				province_id: '',
				district_id: '',
				ward_id: '',
				address: '',
				gender: '',
				birthday: '',
				cmnd_back: '',
				cmnd_front: '',
				facebook: '',
				google: '',
			}
		},
		methods: {

		},
		mounted() {
			$('#content-master').css('padding-top', '1.25em');
		},
		created: function () {
			this.form = profile;
		},
	}
</script>
@endpush