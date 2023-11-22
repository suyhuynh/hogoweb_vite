<div class="row">
	<div class="col-sx-12 col-sm-2 col-md-2">
		<image_change v-model="form.translate.img" :title="'{{ trans('website::pages.form.img') }}'"></image_change>
	</div>
	<div class="col-sx-12 col-sm-10 col-md-10">
		<div class="form-group">
			<label for="title">{{ trans('core::categorys.form.title') }}<code>*</code></label> 
			<input type="text" class="form-control form-control-sm" v-model="form.translate.title" name="title" placeholder="{{ trans('attributes.title') }}">
		</div>
		<div class="form-group">
			<label for="title">
				{{ trans('core::categorys.form.description') }}<code>*</code>
			</label> 
			<textarea class="form-control" placeholder="{{ trans('attributes.description') }}" v-model="form.translate.description" name="description"></textarea>
		</div>
	</div>
</div>
<div class="form-group">
  <div class="checkbox checkbox-custom">
    <input id="is_layout" type="checkbox" name="is_layout" v-model="form.is_layout">
    <label for="is_layout">
      {!! trans('website::layouts.is_layout') !!}
    </label>
  </div>
</div>
<template v-if="!form.is_layout">
  <form_gallery label="{{ trans('core::seo.gallery') }}" v-model="form.translate.galleries"></form_gallery>
	<form_content v-model="form.translate.content" :label="'{{ trans('core::categorys.form.content') }}<code>*</code>'"></form_content>
</template>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			form: {!! json_encode($groups) !!},
			headers: {!! json_encode(get_layouts('header')) !!},
			footers: {!! json_encode(get_layouts('footer')) !!},
		},
		methods: {
			addAnswer: function () {
				this.form.answers.push({
					is_answer : false,
					content : '',
				})
			},
			removeAnswer: function (index){
				this.form.answers.splice(index, 1);
			}
		}
	}
</script>
@endpush