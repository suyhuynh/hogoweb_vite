<div class="form-group">
    @if(!empty($title))
        <label for="{{ $name }}">
            {{ $title }} @if(!empty($required)) <code>*</code> @endif:
        </label>
    @endif
    @php
        $list = languages();
        $currentLanguage = currentLanguage();
        if (!empty($value)) {
            $currentLanguage['code'] = $value;
        }

        if (!empty(request()->lang_code)) {
            $currentLanguage['code'] = request()->lang_code;
            $value = request()->lang_code;
        }
    @endphp
    <input type="hidden" value="{{ $currentLanguage['code'] }}" name="{{ $name }}" />
    <select class="form-control select2" name="{{ $name }}" {{ !empty($required) ? 'required' : '' }} {{ !empty($value) ? 'disabled' : '' }}>
        @foreach($list as $code => $lang)
        <option value="{{ $code }}" {{ $currentLanguage['code'] == $code ? 'selected' : '' }}>{{ $lang['locale_name'] }}</option>
        @endforeach
    </select>
    <input type="hidden" value="{{ $currentLanguage['code'] }}" name="code_translates[]" />
</div>
