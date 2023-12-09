<input type="hidden" name="type" value="notify" />
<input type="hidden" name="lang_code" value="{{ currentLanguageCode() }}" />

<p class="config-title">
    <strong>{{ trans('core::cores.config.notify.newsletter') }}</strong>
</p>
<hr style="margin-top: 5px;" />
<div style="margin-left: 15px">
    {!! Form::bsText(trans('core::cores.config.contact.msg.success'), 'config[newsletter][msg_success]', $entity->config[currentLanguageCode()]['newsletter']['msg_success'] ?? '', []) !!}
    {!! Form::bsText(trans('core::cores.config.contact.msg.error'), 'config[newsletter][msg_error]', $entity->config[currentLanguageCode()]['newsletter']['msg_error'] ?? '', []) !!}
</div>

<p class="config-title">
    <strong>{{ trans('core::cores.config.notify.account_register') }}</strong>
</p>
<hr style="margin-top: 5px;" />
<div style="margin-left: 15px">
    {!! Form::bsText(trans('core::cores.config.contact.msg.success'), 'config[account_register][msg_success]', $entity->config[currentLanguageCode()]['account_register']['msg_success'] ?? '', []) !!}
    {!! Form::bsText(trans('core::cores.config.contact.msg.error'), 'config[account_register][msg_error]', $entity->config[currentLanguageCode()]['account_register']['msg_error'] ?? '', []) !!}
</div>
{{-- <p class="config-title">
    <strong>{{ trans('core::cores.config.notify.forgot_password') }}</strong>
</p>
<hr style="margin-top: 5px;" />
{!! Form::bsText(trans('core::cores.config.contact.msg.success'), 'config[forgot_password][msg_success]', $entity->config[currentLanguageCode()]['forgot_password']['msg_success'] ?? '', []) !!}
{!! Form::bsText(trans('core::cores.config.contact.msg.error'), 'config[forgot_password][msg_error]', $entity->config[currentLanguageCode()]['forgot_password']['msg_error'] ?? '', []) !!} --}}

<p class="config-title">
    <strong>{{ trans('core::cores.config.notify.contact') }}</strong>
</p>
<hr style="margin-top: 5px;" />
<div style="margin-left: 15px">
    {!! Form::bsText(trans('core::cores.config.contact.msg.success'), 'config[contact][msg_success]', $entity->config[currentLanguageCode()]['contact']['msg_success'] ?? '', []) !!}
    {!! Form::bsText(trans('core::cores.config.contact.msg.error'), 'config[contact][msg_error]', $entity->config[currentLanguageCode()]['contact']['msg_error'] ?? '', []) !!}
</div>

<p class="config-title">
    <strong>{{ trans('core::cores.config.notify.update_profile') }}</strong>
</p>
<hr style="margin-top: 5px;" />
<div style="margin-left: 15px">
    {!! Form::bsText(trans('core::cores.config.contact.msg.success'), 'config[update_profile][msg_success]', $entity->config[currentLanguageCode()]['update_profile']['msg_success'] ?? '', []) !!}
    {!! Form::bsText(trans('core::cores.config.contact.msg.error'), 'config[update_profile][msg_error]', $entity->config[currentLanguageCode()]['update_profile']['msg_error'] ?? '', []) !!}
</div>

<br />
<p class="config-title">
    <strong>{{ trans('core::cores.config.notify.report') }}</strong>
</p>
<hr style="margin-top: 5px;" />
<div style="margin-left: 15px">
    {!! Form::bsText(trans('core::cores.config.contact.msg.success'), 'config[report][msg_success]', $entity->config[currentLanguageCode()]['report']['msg_success'] ?? '', []) !!}
    {!! Form::bsText(trans('core::cores.config.contact.msg.error'), 'config[report][msg_error]', $entity->config[currentLanguageCode()]['report']['msg_error'] ?? '', []) !!}
</div>