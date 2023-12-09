<p class="config-title">
    <strong>{{ trans('core::cores.config.general') }}</strong>
</p>
<hr />
<div class="row">
    <input type="hidden" name="type" value="general" />
    <div class="col-md-3 col-sm-3 col-sx-12 col-12">
        {{ Form::bsImage(trans('core::cores.config.form.logo'), 'config[logo]', $entity->config['logo'] ?? '') }}
    </div>
    <div class="col-md-3 col-sm-3 col-sx-12 col-12">
        {{ Form::bsImage(trans('core::cores.config.form.icon'), 'config[icon]', $entity->config['icon'] ?? '') }}
    </div>
    <div class="col-md-12 col-sm-12 col-sx-12 col-12">
        {!! Form::bsText(trans('core::cores.config.form.company_name'), 'config[company_name]', $entity->config['company_name'] ?? '', []) !!}
        {!! Form::bsText(trans('core::cores.config.form.company_phone'), 'config[company_phone]', $entity->config['company_phone'] ?? '', []) !!}
        {!! Form::bsText(trans('core::cores.config.form.company_email'), 'config[company_email]', $entity->config['company_email'] ?? '', []) !!}

        {!! Form::bsEditor(trans('core::cores.config.form.content'), 'config[content]', $entity->config['content'] ?? '') !!}
    </div>
</div>