<div class="form-group">
    @if(!empty($title))
        <label for="{{ $name }}">
            {{ $title }} @if(!empty($required)) <code>*</code> @endif:
        </label>
    @endif
    {!! Form::password($name, array_merge(['class' => 'form-control', 'required' => $required], $attributes)) !!}
</div>