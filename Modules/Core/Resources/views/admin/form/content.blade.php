<div class="form-group">
	<label for="title">
		{{ trans('website::setting_themes.form.content') }}<code>*</code>
	</label> 
	<tinymce v-model="<?php echo $key ?>"></tinymce>
</div>