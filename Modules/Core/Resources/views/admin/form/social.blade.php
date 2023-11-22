@php
$data = [
	[
		"title" => "Facebook",
		"icon" => "fa fa-facebook",
		"link" => ""
	],
	[
		"title" => "Google",
		"icon" => "fa fa-google-plus",
		"link" => ""
	],
	[
		"title" => "Youtube",
		"icon" => "fa fa-youtube",
		"link" => ""
	],
	[
		"title" => "Twitter",
		"icon" => "fa fa-twitter",
		"link" => ""
	],
	[
		"title" => "Pinterest",
		"icon" => "fa fa-pinterest",
		"link" => ""
	],
	[
		"title" => "Instagram",
		"icon" => "fa fa-instagram",
		"link" => ""
	],
	[
		"title" => "Flickr",
		"icon" => "fa fa-flickr",
		"link" => ""
	],
	[
		"title" => "Slide Share",
		"icon" => "fa fa-slideshare",
		"link" => ""
	],
	[
		"title" => "Tumblr",
		"icon" => "fa fa-tumblr",
		"link" => ""
	],
	[
		"title" => "Linked in",
		"icon" => "fa fa-linkedin",
		"link" => ""
	],
];
@endphp
@foreach($data as $key => $value)
<div class="input-group mb-3">
	<div class="input-group-prepend">
		<button class="btn btn-outline-secondary disabled" style="width: 40px;" type="button">
			<i class="{{ $value['icon'] }}"></i>
		</button>
	</div>
	<input type="hidden"  v-model="form.footer.social[{{ $key }}].icon">
		<input class="form-control" type="text" v-model="form.footer.social[{{ $key }}].link" required="" placeholder="">
</div>
@endforeach