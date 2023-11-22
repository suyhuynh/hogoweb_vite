<div class="row">
	<div class="col-sx-12 col-sm-2 col-md-2">
		<image_change v-model="form.translate.img" :title="'{{ trans('website::pages.form.img') }}'"></image_change>
	</div>
	<div class="col-sx-12 col-sm-10 col-md-10">
		<div class="form-group">
			<label for="title">{{ trans('core::categorys.form.title') }}<code>*</code></label> 
			<input type="text" class="form-control form-control-sm" v-model="form.translate.title" name="title" placeholder="{{ trans('attributes.title') }}">
		</div>
		<div class="form-group form-group-feedback form-group-feedback-right">
			<label class="control-label" for="parent">
				{{ trans('core::categorys.form.parent') }}:
			</label>
			<select2 allowclear v-model="form.parent_id" :options="categorys" name="parent_id" id="parent_id" class="form-control form-control-sm" placeholder="{{ trans('attributes.select') }}" name="parent"></select2>
		</div>
		@if(request()->code == 'question')
		<div class="form-group form-group-feedback form-group-feedback-right">
			<label class="control-label" for="group">
				{{ trans('core::categorys.form.group') }}:
			</label>
			<select2 multiple v-model="form.group_ids" name="group" :options="groups" name="group" id="group" class="form-control form-control-sm select" placeholder="{{ trans('attributes.select') }}"></select2>
		</div>
		@endif
	</div>
</div>
@if(request()->code == 'bank')
<div class="form-group form-group-feedback form-group-feedback-right">
	<label class="control-label" for="group">
		{{ trans('core::categorys.form.group_type') }}:
	</label>
	<select2 multiple v-model="form.group_type_ids" name="group_types" :options="group_types" name="group_type" id="group_type" class="form-control form-control-sm select" placeholder="{{ trans('attributes.select') }}"></select2>
</div>
@endif
<div class="form-group">
	<label for="title">
		{{ trans('core::categorys.form.description') }}<code>*</code>
	</label> 
	<textarea class="form-control" v-model="form.translate.description" name="description" placeholder="{{ trans('attributes.description') }}"></textarea>
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
			categorys: {!! $categorys !!},
			groups: {!! groups(request()->code) !!},
			group_types: {!! group_types(request()->code) !!},
			form: {!! json_encode($category) !!},
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