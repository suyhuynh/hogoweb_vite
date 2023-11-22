<div class="form-group">
    @if(!empty($title))
        <label for="{{ $name }}">
            {{ $title }} @if(!empty($required)) <code>*</code> @endif:
        </label>
    @endif
    {!! Form::number($name, $value ?? '', array_merge(['class' => 'form-control', 'required' => $required], $attributes)) !!}
</div>