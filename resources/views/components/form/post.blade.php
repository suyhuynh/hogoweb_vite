<div class="form-group">
    @if(!empty($title))
        <label for="{{ $name }}">
            {{ $title }} @if(!empty($required)) <code>*</code> @endif:
        </label>
    @endif
    <select  data-value="{{ $value ?? '' }}"
        name="{{ $name }}"
        id="{{ $name }}" 
        {!! (!empty($required) ? "required" : '') !!} 
        class="form-control select2-post" 
        data-placeholder="{{ trans('post::posts.post_search') }}"
        data-trans="{{ trans('core::cores.select2_input') }}"
        >
    </select>
</div>