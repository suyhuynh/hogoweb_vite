@if(!empty($title))
    <label>{{ $title }}:</label>
@endif

<div class="gallerys">
    @if (!empty($size))
        <code>{{ trans('core::cores.size') }} {{ $size }}</code>
    @endif
    @if(count($gallerys))
        @foreach ($gallerys as $image)
            <div class="form-group select-img" title="{{ $title }}">
                <a href="javascript:void(0)" class="close" style="{{ !empty($image) ? 'display: none' : '' }}">
                    <i class="fa fa-times-circle"></i>
                </a>
                <div class="text-center change-image">
                    <input type="hidden" name="{{ $name }}[]" value="{{ $image ?? '' }}">
                    <img src="{{ !empty($image) ? $image : '/no-image.png' }}" data-value="/no-image.png" class="img-responsive cursor">
                </div>
            </div>
        @endforeach
    @endif
</div>
<script id="gallerys" type="text/template">
    <div class="form-group select-img">
        <a href="javascript:void(0)" class="close" style="display:<%= path == '' ? 'none' : 'block' %>">
            <i class="fa fa-times-circle"></i>
        </a>
        <div class="text-center change-image" data-multiple="<%= path != '' ? 'no' : '' %>">
            <input type="hidden" name="{{ $name }}[]" value="<%= path %>">
            <img src="<%= path != '' ? path : '/no-image.png' %>" data-value="/no-image.png" class="img-responsive cursor">
        </div>
    </div>
</script>