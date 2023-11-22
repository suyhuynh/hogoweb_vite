<fieldset class="email-data">
	<legend class="font-weight-bold text-uppercase">
		{{ trans('core::setting.account_send_mail.theme') }}
	</legend>
	
	<div class="form-group">
		<label for="sort">
			{{ trans('core::setting.product.sort') }}
		</label>
		<select class="form-control" name="sort" v-model="form.sort">
			<option value="desc">
				{{ trans('core::setting.product.sorts.desc') }}
			</option>
			<option value="asc">
				{{ trans('core::setting.product.sorts.asc') }}
			</option>
		</select>
	</div>
	<div class="form-group">
		<label for="product_number">
			{{ trans('core::setting.product.product_number') }}
		</label>
		<select class="form-control" name="product_number" v-model="form.product_number">
			<option value="col-md-12 col-sm-2 col-xs-12 col-12">1</option>
			<option value="col-md-6 col-sm-6 col-xs-12 col-12">2</option>
			<option value="col-md-4 col-sm-4 col-xs-12 col-12">3</option>
			<option value="col-md-3 col-sm-4d col-xs-12 col-12">4</option>
		</select>
	</div>
	<div class="form-group">
		<label for="limit">
			{{ trans('core::setting.product.limit') }}
		</label>
		<select class="form-control" name="limit" v-model="form.limit">
			<option value="10">10</option>
			<option value="12">12</option>
			<option value="14">14</option>
			<option value="16">16</option>
			<option value="18">18</option>
			<option value="20">20</option>
		</select>
	</div>
	<form_title label="{{ trans('core::setting.product.price_format') }}" v-model="form.price_format"></form_title>
	<form_title label="{{ trans('core::setting.product.currency') }}" v-model="form.currency"></form_title>
</fieldset>

@push('script')
<script type="text/javascript">
	var mixin_data = {
		data: {
			form: {
				sort: 'asc',
				product_number: 'col-md-3 col-sm-3 col-xs-12 col-12',
				limit: 12,
				price_format: ',',
				currency: 'đ'
			}
		},
		methods: {

		},
		created: function () {
			@if(!empty($data->config))
			this.form = {!! json_encode($data->config) !!};
			@endif
		}
	}
</script>
@endpush