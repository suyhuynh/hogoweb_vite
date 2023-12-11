<p class="config-title">
    <strong>{{ trans('core::cores.config.comment.title') }}</strong>
</p>
<hr />
<div class="row">
    <div class="col-md-12">
        <input type="hidden" name="type" value="comment" />
        <input type="hidden" name="lang_code" value="{{ currentLanguageCode() }}" />
        <div id="text">
            {!! Form::bsText(trans('core::cores.config.contact.msg.success'), 'config[msg_success]', $entity->config[currentLanguageCode()]['msg_success'] ?? '', []) !!}
            {!! Form::bsText(trans('core::cores.config.contact.msg.error'), 'config[msg_error]', $entity->config[currentLanguageCode()]['msg_error'] ?? '', []) !!}
        </div>
    </div>
</div>