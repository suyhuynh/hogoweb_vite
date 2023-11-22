<div class="form-group">
	<label class="control-label" for="header_menu_id">
		{{ trans('website::menus.menu') }}<code>*</code>:
	</label>
	<select2 allowclear v-model="<?php echo $key ?>" :options="menus" name="<?php echo $key ?>" id="<?php echo $key ?>" class="form-control form-control-sm" placeholder="{{ trans('attributes.select') }}" name="category"></select2>
</div>