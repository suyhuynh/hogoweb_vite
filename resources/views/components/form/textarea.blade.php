<div class="form-group">
    @if(!empty($title))
        <label for="{{ $name }}">
            {{ $title }} @if(!empty($required)) <code>*</code> @endif:
        </label>
    @endif
    @if(!empty($attributes['data-character']) || !empty($attributes['maxlength']))
        <div class="count-character"><span class="text-success">0</span>/{{ $attributes['maxlength'] ?? $attributes['data-character'] }} Word</div>
    @endif
    {!! Form::textarea($name, $value ?? '', array_merge(['class' => 'form-control', 'required' => $required, 'rows' => '3'], $attributes)) !!}
</div>