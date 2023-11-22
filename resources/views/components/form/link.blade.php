<div class="form-group">
    @if(!empty($title))
        <label for="{{ $name }}">
            {{ $title }} @if(!empty($required)) <code>*</code> @endif:
        </label>
    @endif
    <input type="link" value="{{ $value }}" class="form-control" name="{{ $name }}" {{ !empty($required) ? 'required' : '' }} />
</div>