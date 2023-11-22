@php($categories = categories($type)) 
<li class="list-inline-item">
	<select name="category_id" class="form-control form-control-sm select2-js">
		<option value="">{{ @$title }}</option>
		@foreach($categories as $id => $value)
			<option value="{{ $id }}" {{ @request()->category_id == $id ? 'selected' : '' }}>{{ $value }}</option>
		@endforeach
	</select>
</li>