<div class="form-group">
    @if(!empty($title))
        <label for="{{ $name }}">
            {{ $title }} @if(!empty($required)) <code>*</code> @endif:
        </label>
    @endif
    {!! Form::text($name, $value ?? '', array_merge(['class' => 'form-control', 'required' => $required], $attributes)) !!}
</div>