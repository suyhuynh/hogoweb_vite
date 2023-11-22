@php($groups = groups($type))
<li class="list-inline-item">
	<select name="group_id" class="form-control form-control-sm select2-js">
		<option value="">{{ @$title }}</option>
		@foreach($groups as $id => $value)
			<option value="{{ $id }}" {{ @request()->group_id == $id ? 'selected' : '' }}>{{ $value }}</option>
		@endforeach
	</select>
</li>