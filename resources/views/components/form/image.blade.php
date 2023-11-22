@if(!empty($title))
    <label>{{ $title }}:</label>
@endif
<div class="form-group select-img" title="{{ $title }}">
    <div class="select-img-block">
        <a href="javascript:void(0)" class="close" style="{{ !empty($value) ? 'display: block' : 'display: none' }}">
            <i class="fa fa-times-circle"></i>
        </a>
        <div class="text-center change-image {{ empty($value) ? 'image-none' : '' }}" data-size="{{ $size ?? '' }}">
            <input type="hidden" name="{{ $name }}" value="{{ $value ?? '' }}">
            <img src="{{ !empty($value) ? $value : '/no-image.png' }}" data-value="/no-image.png" class="img-responsive cursor">
        </div>
        @if (!empty($size))
            <code>{{ $size }}</code>
        @endif
    </div>
</div>

