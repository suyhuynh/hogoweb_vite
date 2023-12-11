<p class="config-title">
    <strong>{{ trans('core::cores.config.contact.title') }}</strong>
</p>
<hr />
<div class="row">
    <div class="col-md-12">
        <input type="hidden" name="type" value="contact" />
        <input type="hidden" name="lang_code" value="{{ currentLanguageCode() }}" />
        {{-- <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="hidden" name="isPopup" value="0" />
                    <input type="checkbox" value="1" id="isPopup" {{ !empty($entity->config['isPopup']) ? 'checked' : '' }} name="config[isPopup]"> 
                    {{ trans('core::cores.config.contact.isPopup') }}
                </label>
            </div>
        </div> --}}
        <div id="text" {!! empty($entity->config['isPopup']) ? '' : 'style="display: none"' !!}>
            {!! Form::bsText(trans('core::cores.config.contact.msg.success'), 'config[msg_success]', $entity->config[currentLanguageCode()]['msg_success'] ?? '', []) !!}
            {!! Form::bsText(trans('core::cores.config.contact.msg.error'), 'config[msg_error]', $entity->config[currentLanguageCode()]['msg_error'] ?? '', []) !!}
        </div>
        {{-- <div id="textPopup" {!! !empty($entity->config['isPopup']) ? '' : 'style="display: none"' !!} >
            {!! Form::bsEditor(trans('core::cores.config.contact.msg.success'), 'config[msg_editor_success]', $entity->config['msg_editor_success'] ?? '', []) !!}
            {!! Form::bsEditor(trans('core::cores.config.contact.msg.error'), 'config[msg_editor_error]', $entity->config['msg_editor_error'] ?? '', []) !!}
        </div> --}}
    </div>
</div>
@push('scripts')
<script>
    window.addEventListener('load', function() {
        $('#isPopup').on( "click", function() {
            if($(this).is(':checked')) {
                $('#textPopup').css('display', 'block')
                $('#text').css('display', 'none')
            } else {
                $('#textPopup').css('display', 'none')
                $('#text').css('display', 'block')
            }
        });
    });
    </script>
@endpush
