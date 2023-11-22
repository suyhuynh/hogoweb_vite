<fieldset>
	<legend class="font-weight-bold text-uppercase">
		{{ trans('core::setting.general.social') }}
	</legend>
	<form_social v-model="form.social"></form_social>
</fieldset>
@push('script')
<script type="text/javascript">
	var mixin_data = {
		data: {
			form: {
				social: {!! json_encode([[
					"title" => "Facebook",
					"icon" => "fa fa-facebook",
					"link" => ""
				],[
					"title" => "Google",
					"icon" => "fa fa-google-plus",
					"link" => ""
				],[
					"title" => "Youtube",
					"icon" => "fa fa-youtube",
					"link" => ""
				],[
					"title" => "Twitter",
					"icon" => "fa fa-twitter",
					"link" => ""
				],[
					"title" => "Pinterest",
					"icon" => "fa fa-pinterest",
					"link" => ""
				],[
					"title" => "Instagram",
					"icon" => "fa fa-instagram",
					"link" => ""
				],[
					"title" => "Flickr",
					"icon" => "fa fa-flickr",
					"link" => ""
				],[
					"title" => "Slide Share",
					"icon" => "fa fa-slideshare",
					"link" => ""
				],[
					"title" => "Tumblr",
					"icon" => "fa fa-tumblr",
					"link" => ""
				],[
					"title" => "Linked in",
					"icon" => "fa fa-linkedin",
					"link" => ""
					]]) !!}
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