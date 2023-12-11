@extends('app::admin.layouts.master')
@section('content')
<div class="row">
	<div class="col-sx-12 col-sm-12 col-lg-8 col-md-8 offset-lg-2 offset-md-2">
		<div class="card">
			<div class="card-heading">
				<strong>
					{{ trans('user::users.account.change_password') }}: {{ $user->fullname }} - {{ $user->phone }} - {{ $user->email }}
				</strong>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>
						{{ trans('user::users.account.password') }}
					</label>
					<input type="password" class="form-control" v-model="form.password">
				</div>
				<div class="form-group">
					<label>
						{{ trans('user::users.account.re_password') }}
					</label>
					<input type="password" class="form-control" v-model="form.password_confirmation">
				</div>

			</div>
			<div class="card-footer text-right">
				<a onclick="history.back();" style="cursor: pointer;" class="btn btn-warning btn-sm">
					<b><span class="icon-reply"></span></b>
					{{ trans('attributes.back') }}
				</a>
				<button v-on:click="update('{{ route('admin.users.change_password', ['id' => $user->id]) }}')" class="btn btn-success btn-sm btn-actions btn-store" style="margin-left: 5px;">
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
	var mix = {
		data: {
			form: {
				password: '',
				password_confirmation: '',
			}
		},
		methods: {

		},
		mounted() {
			$('#content-master').css('padding-top', '1.25em');
		},
		created: function () {

		},
	}
</script>
@endpush