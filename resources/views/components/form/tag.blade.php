<div class="form-group">
    @if(!empty($title))
        <label for="{{ $name }}">
            {{ $title }} @if(!empty($required)) <code>*</code> @endif:
        </label>
    @endif
    <select multiple="multiple" data-value="{{ !empty($value) ? json_encode($value) : '' }}"
        name="{{ $name }}[]"
        id="{{ $name }}" 
        {!! (!empty($required) ? "required" : '') !!} 
        class="form-control select2-tag" 
        data-key-search="{{ trans('post::tags.tag_keyword') }}"
        data-placeholder="{{ trans('post::tags.tag_search') }}"
        data-trans="{{ trans('core::cores.select2_input') }}" 
        data-tags=true
        >
    </select>
</div>