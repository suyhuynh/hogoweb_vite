<div class="form-group">
    @if(!empty($title))
        <label for="{{ $name }}">
            {{ $title }} @if(!empty($required)) <code>*</code> @endif:
        </label>
    @endif
    {!! Form::textarea($name, $value ?? '', array_merge(['class' => 'form-control tinymce', 'required' => $required], $attributes)) !!}
</div>