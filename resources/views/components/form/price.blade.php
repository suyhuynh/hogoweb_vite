<div class="form-group">
    @if(!empty($title))
        <label for="{{ $name }}">
            {{ $title }} @if(!empty($required)) <code>*</code> @endif:
        </label>
    @endif
    <input type="hidden" class="price" value="{{ $value }}" name="{{ $name }}" />
    {!! Form::text('', $value ?? '', array_merge(['class' => 'form-control', 'required' => $required, 'data-price-only' => 'integer'], $attributes)) !!}
</div>