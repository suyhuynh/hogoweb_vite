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
@if(auth()->user()->hasAccess('admin.layouts.design'))
<div class="row">
  <div class="col-sx-12 col-sm-6 col-md-6">
    <div class="form-group form-group-feedback form-group-feedback-right">
      <label class="control-label" for="category">
        {!! trans('website::layouts.use_header') !!}:
      </label>
      <select2 allowclear v-model="form.header_id" :options="headers" name="header_id" id="header_id" class="form-control form-control-sm" placeholder="{{ trans('attributes.none_use') }}" name="header_id"></select2>
    </div>
  </div>
  <div class="col-sx-12 col-sm-6 col-md-6">
    <div class="form-group form-group-feedback form-group-feedback-right">
      <label class="control-label" for="group">
        {!! trans('website::layouts.use_footer') !!}:
      </label>
      <select2 allowclear v-model="form.footer_id" :options="footers" name="footer_id" id="footer_id" class="form-control form-control-sm" placeholder="{{ trans('attributes.none_use') }}" name="footer_id"></select2>
    </div>
  </div>
</div>
@endif
<form_content v-model="form.translate.content" :label="'{{ trans('core::categorys.form.content') }}<code>*</code>'"></form_content>

@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			headers: {!! json_encode(get_layouts('header')) !!},
			footers: {!! json_encode(get_layouts('footer')) !!},
			form: {!! json_encode($groupTypes) !!},
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