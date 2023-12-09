<p class="config-title">
    <strong>{{ trans('core::cores.config.email_template') }}</strong>
</p>
<hr />
<input type="hidden" name="type" value="email_template" />
<input type="hidden" name="lang_code" value="{{ currentLanguageCode() }}" />
{!! Form::bsEditor(trans('core::cores.config.form.header'), 'config[header]', $entity->config[currentLanguageCode()]['header'] ?? '') !!}
{!! Form::bsEditor(trans('core::cores.config.form.footer'), 'config[footer]', $entity->config[currentLanguageCode()]['footer'] ?? '') !!}