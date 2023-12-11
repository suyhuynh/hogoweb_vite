@if (!isset($disable_alias_seo))
<div class="box collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">URL</h3>
        <div class="box-tools pull-right">
            <a href="javascript:void(0)" type="button" class="btn btn-box-tool" data-widget="collapse" style="border: none !important;">
                {{ trans('core::seos.alert_url') }}  <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    <div class="box-body" id="url-data" style="display: none;">
        <div class="input-group form-group">
            <span class="input-group-addon">{{ url('/') }}</span>
            <input type="text" class="form-control" name="seo[alias]" value="{{ $seo->alias ?? '' }}" id="alias-seo" placeholder="" data-seo-id="{{ $seo->id ?? '' }}">
        </div>
    </div>
    <div class="box-footer text-right">
        <a onclick="history.back();" href="javascript:void(0)" style="cursor: pointer;" class="btn btn-flat btn-warning btn-sm">
            <b><span class="icon-reply"></span></b>
            {{ trans("core::cores.back") }}
        </a>
        <button type="submit" class="btn btn-sm {{ $config['class'] }}">
            <i class="{{ $config['icon'] }}"></i> {{ $config['title'] }}
        </button>
    </div>
</div>
@endif

@php
    $seoConfig = config('core.seo');
@endphp
<div class="box collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">SEO</h3>
        <div class="box-tools pull-right">
            <a href="javascript:void(0)" type="button" class="btn btn-box-tool" data-widget="collapse" style="border: none !important;">
                {{ trans('core::seos.alert_seo') }}  <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    <div class="box-body" style="display: none;">
        <div id="seo-data">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#general" data-toggle="tab">
                            {{ trans('core::cores.config.general') }}
                        </a>
                    </li>

                    @foreach($seoConfig as $val)
                        <li><a href="#{{ $val }}" data-toggle="tab" style="text-transform: capitalize;">{{ $val }}</a></li>
                    @endforeach

                    <li>
                        <a href="#schema" data-toggle="tab">
                            Schema
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="general">
                        <div class="row">
                            @if($show_image == true)
                            <div class="col-sx-12 col-sm-3 col-md-3 col-lg-2">
                                {{ Form::bsImage('', 'seo[img]', $seo->img ?? '', '1200 x 627') }}
                            </div>
                            @endif
                            <div class="{{ $show_image == true ? 'col-sx-12 col-sm-12 col-md-9 col-lg-10' : 'col-sx-12 col-sm-12 col-md-12 col-lg-12' }}">
                                <div class="form-group">
                                    <label for="title-seo">{{ trans('core::seos.title') }}:</label>
                                    <input type="text" class="form-control" name="seo[title]" id="title-seo" value="{{ $seo->title ?? '' }}" placeholder="">
                                    <div class="form-control-feedback form-control-feedback-sm"><span>0</span>/80</div>
                                </div>
                                @if($show_image == true)
                                    <div class="form-group">
                                        <label for="description-seo">{{ trans('core::seos.description') }}:</label>
                                        <textarea class="form-control" name="seo[description]" id="description-seo" rows="3">{{ $seo->description ?? '' }}</textarea>
                                        <div class="form-control-feedback form-control-feedback-sm"><span>0</span>/160</div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-sx-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="keywordSeo">{{ trans('core::seos.keyword') }}:</label>
                                    <textarea class="form-control" name="seo[keyword]" id="keyword-seo" rows="2">{{ $seo->keyword ?? '' }}</textarea>
                                    <p style="display: flex;align-items: center;">
                                        <span class="badge badge-danger">NOTE!</span>
                                        <span style="margin-left: 5px">
                                            <span class="text-danger">
                                                {!! trans('core::seos.keyword_note') !!}
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label for="status-seo">
                                            <input type="hidden" name="seo[status]" value="follow" />
                                            <input type="checkbox" id="status-seo" name="seo[status]" {{ (!empty($seo->status) && $seo->status == 'nofollow') ? 'checked' : '' }}  value="nofollow">
                                            {!! trans('core::seos.status') !!}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach($seoConfig as $seo_name)
                        <div class="tab-pane" id="{{ $seo_name }}">
                            <div class="row">
                                <div class="col-sx-12 col-sm-3 col-md-2 col-lg-2">
                                    {{ Form::bsImage('', 'seo[expand][' . $seo_name . '][img]', $seo->expand[$seo_name]['img'] ?? '') }}
                                </div>
                                <div class="col-sx-12 col-sm-9 col-md-10 col-lg-10">
                                    <div class="form-group">
                                        <label for="title-seo{{ $seo_name }}">{{ trans('core::seos.title') }}:</label>
                                        <input type="text" class="form-control" name="seo[expand][{{ $seo_name }}][title]" id="title-seo{{ $seo_name }}" value="{{ $seo->expand[$seo_name]['title'] ?? '' }}" placeholder="">
                                        <div class="form-control-feedback form-control-feedback-sm"><span>0</span>/80</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description-seo{{ $seo_name }}">{{ trans('core::seos.description') }}:</label>
                                        <textarea class="form-control" name="seo[expand][{{ $seo_name }}][description]" id="description-seo{{ $seo_name }}" rows="3">{{ $seo->expand[$seo_name]['description'] ?? '' }}</textarea>
                                        <div class="form-control-feedback form-control-feedback-sm"><span>0</span>/180</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="tab-pane" id="schema">
                        <div class="form-group">
                            <textarea class="form-control" name="seo[schema]" rows="8">{{ $seo->schema ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="mb-0 pb-0">{{ trans('core::seos.seo_note') }}</p>
    </div>
    <div class="box-footer text-right">
        <a onclick="history.back();" href="javascript:void(0)" style="cursor: pointer;" class="btn btn-flat btn-warning btn-sm">
            <b><span class="icon-reply"></span></b>
            {{ trans("core::cores.back") }}
        </a>
        <button type="submit" class="btn btn-sm {{ $config['class'] }}">
            <i class="{{ $config['icon'] }}"></i> {{ $config['title'] }}
        </button>
    </div>
</div>

