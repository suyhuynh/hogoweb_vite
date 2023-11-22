<div class="form-group">
    @if(!empty($title))
        <label for="{{ $name }}">
            {{ $title }} @if(!empty($required)) <code>*</code> @endif:
        </label>
    @endif

    {!! Form::select($name, $list, $value, array_merge(['class' => 'form-control select2', 'required' => $required], $attributes)) !!}
</div>