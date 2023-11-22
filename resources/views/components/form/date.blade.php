<div class="form-group">
    @if(!empty($title))
        <label for="{{ $name }}" class="d-block">
            {{ $title }} @if(!empty($required)) <code>*</code> @endif:
        </label>
    @endif
    <button type="button" class="btn btn-default date-picker btn-flat d-block">
        <i class="fa fa-calendar mr-2"></i>
        <span>{{ trans('core::cores.indefinite') }}</span>
        <input type="hidden" name="{{ $name }}" value="{{ $value ?? '' }}" data-day="{{ $day ?? '' }}" {{ !empty($required) ? 'required' : '' }} />
    </button>
</div>