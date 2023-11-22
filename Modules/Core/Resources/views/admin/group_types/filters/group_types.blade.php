@php($group_types = group_types($type)) 
<li class="list-inline-item">
	<select name="group_type_id" class="form-control form-control-sm select2-js">
		<option value="">{{ @$title }}</option>
		@foreach($group_types as $id => $value)
			<option value="{{ $id }}" {{ @request()->group_type_id == $id ? 'selected' : '' }}>{{ $value }}</option>
		@endforeach
	</select>
</li>