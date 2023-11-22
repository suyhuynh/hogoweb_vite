<fieldset class="email-data">
	<legend class="font-weight-bold text-uppercase">
		{{ trans('core::setting.account_send_mail.theme') }}
	</legend>
	
	<div class="row">
		<div class="col-sx-12 col-sm-2 col-md-2">
			<image_change v-model="form.theme_mail.logo" :title="'{{ trans('core::setting.account_send_mail.theme_mail.logo') }}'"></image_change>
		</div>
		<div class="col-sx-12 col-sm-10 col-md-10">
			<form_title :label="'{{ trans('core::setting.account_send_mail.theme_mail.hotline') }}'" v-model="form.theme_mail.hotline"></form_title>
			<form_title :label="'{{ trans('core::setting.account_send_mail.theme_mail.title') }}'" v-model="form.theme_mail.title"></form_title>
		</div>
	</div>
	<div>
		<input type="color" name="background" v-model="form.theme_mail.background">
		<label for="background">
			{{ trans('core::setting.account_send_mail.theme_mail.background') }}
		</label>
	</div>

	<form_textarea :label="'{{ trans('core::setting.account_send_mail.theme_mail.des') }}'" v-model="form.theme_mail.des"></form_textarea>

	<form_content :label="'{{ trans('core::setting.account_send_mail.theme_mail.content') }}'" v-model="form.theme_mail.content"></form_content>

	<form_content :label="'{{ trans('core::setting.account_send_mail.theme_mail.company') }}'" v-model="form.theme_mail.company"></form_content>

	<form_title :label="'{{ trans('core::setting.account_send_mail.theme_mail.coppy') }}'" v-model="form.theme_mail.coppy"></form_title>

	<div class="row theme-check">
		<div class="col-md-3 col-sm-3 col-xs-12">
			<div class="item">
				<input type="radio" id="01" value="01" v-model="form.theme_mail.theme">
				<label for="01">
					<img src="{{ env('SERVER_URL') }}/public/theme_email/01.png" class="img-responsive">
				</label>
			</div>
		</div>
	</div>
</fieldset>

<fieldset class="email-data">
	<legend class="font-weight-bold text-uppercase">
		{{ trans('core::setting.account_send_mail.account') }}
	</legend>
	<div v-for="(item, index ) in form.account_send_mails">
		<div class="row account-send-mail border-bottom mb-2">
			<a href="javascript:void(0)" class="text-danger remove" v-on:click="removeAccount(index)">
				<i class="icon-cancel-circle2"></i>
			</a>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<form_title :label="'{{ trans('core::setting.account_send_mail.account') }}'" v-model="item.account"></form_title>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<form_password :label="'{{ trans('core::setting.account_send_mail.password') }}'" v-model="item.password"></form_password>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<form_title :label="'{{ trans('core::setting.account_send_mail.mail_host') }}'" v-model="item.mail_host"></form_title>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<form_title :label="'{{ trans('core::setting.account_send_mail.mail_port') }}'" v-model="item.mail_port"></form_title>
			</div>
		</div>
	</div>
	<div class="text-right">
		<button class="btn btn-sm btn-success" v-on:click="addAccountMail">
			<i class="icon-plus3"></i>
		</button>
	</div>
</fieldset>

@push('script')
<style type="text/css">
.email-data .account-send-mail{
	position: relative;
}
.email-data .account-send-mail .remove{
	position: absolute;
	right: 20px;
	cursor: pointer;
	z-index: 99999;
}
.email-data .account-send-mail .remove i{
	font-size: 20px;
}
</style>
<script type="text/javascript">
	var mixin_data = {
		data: {
			form: {
				account_send_mails : [
				{
					account : '',
					password : '',
					mail_host : '',
					mail_port : '',
				}
				],
				theme_mail: {
					theme: '01',
					title: '',
					des: '',
					hotline: '',
					logo: '',
					company: '',
					content: '',
					coppy: '',
					background: '#452c75',
				},

			}
		},
		methods: {
			addAccountMail: function () {
				this.form.account_send_mails.push({
					account : '',
					password : '',
					mail_host : '',
					mail_port : '',
				});
			},
			removeAccount: function (key) {
				this.form.account_send_mails.splice(key,1);
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