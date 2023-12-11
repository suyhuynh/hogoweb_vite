@section('content')
    @php
        $config = config('core.action.' . $button);
    @endphp

    <input type="hidden" id="resource-data" value="{{ $resource }}" />
    @if(!empty($resourceId))
        <input type="hidden" id="resource-data-id" value="{{ $resourceId }}" />
    @endif

    <div class="row" style="display: flex;justify-content: center;">
        <div class="col-md-12 col-sm-12 col-xs-12 col-12">
        {{-- <div class="{{ $class ?? 'col-md-12 col-sm-12 col-xs-12 col-12' }}"> --}}
            {!! Form::open($form) !!}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $name ?? 'Empty' }}</h3>
                    @if(isset($status))
                        <div class="box-tools pull-right">
                            <span class="label {{ $status['class'] }}" style="border-radius: 30px;font-size: 13px;padding: 4px 10px;">{{ $status['title'] }}</span>
                        </div>
                    @endif
                    {{-- <div class="box-tools pull-right">
                        @if(isset($view))
                        <a href="{{ $view }}" target="_blank"  class="btn btn-flat btn-info btn-sm">
                            <i class="fa fa-eye"></i>  {{ trans("core::cores.action.show") }}
                        </a>
                        @endif
                        @if(isset($duplicate))
                        <a href="{{ $duplicate }}" target="_blank"  class="btn btn-flat btn-primary btn-sm btn-duplicate">
                            <i class="fa fa-clone"></i>  {{ trans("core::cores.action.duplicate") }}
                        </a>
                        @endif
                        <a onclick="history.back();" href="javascript:void(0)" style="cursor: pointer;" class="btn btn-flat btn-warning btn-sm">
                            <b><span class="fa fa-reply"></span></b>
                            {{ trans("core::cores.back") }}
                        </a>
                        <button type="submit" class="btn btn-sm {{ $config['class'] }}">
                            <i class="{{ $config['icon'] }}"></i> {{ $config['title'] }}
                        </button>
                    </div> --}}
                </div>

                <div class="box-body">
                    @if(isset($language))
                        {{-- @php
                            $languages = languages();
                        @endphp
                        <div class="form-group">
                            <div class="btn-group">
                                @foreach($languages as $code => $lang)
                                    <a href="{{ route($language['route'], array_merge($language['parameter'], ['lang_code' => $code])) }}" 
                                        class="btn btn-default btn-sm btn-flat {{ $language['lang_code'] == $code ? 'bg-olive' : '' }}">
                                        {{ $lang['locale_name'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div> --}}
                    @endif

                    {{ $content }}
                </div>

                <div class="box-footer text-right">
                    @if(isset($view))
                        <a href="{{ $view }}?review=true" target="_blank"  class="btn btn-flat btn-info btn-sm">
                            <i class="fa fa-eye"></i>  {{ trans("core::cores.action.show") }}
                        </a>
                    @endif
                    @if(isset($duplicate))
                        <a href="{{ $duplicate }}" target="_blank"  class="btn btn-flat btn-primary btn-sm btn-duplicate">
                            <i class="fa fa-clone"></i>  {{ trans("core::cores.action.duplicate") }}
                        </a>
                    @endif
                    <a onclick="history.back();" href="javascript:void(0)" style="cursor: pointer;" class="btn btn-flat btn-warning btn-sm">
                        <b><span class="fa fa-reply"></span></b>
                        {{ trans("core::cores.back") }}
                    </a>
                    <button type="submit" class="btn btn-sm {{ $config['class'] }}">
                        <i class="{{ $config['icon'] }}"></i> {{ $config['title'] }}
                    </button>
                </div>
            </div>

            @if(isset($seo))
                @include('core::components.seo', ['seo' => $seo, 'show_image' => $show_image ?? true])
            @endif
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@push('scripts')
<script>
    window.addEventListener('load', function() {
        function formSubmit(_this, reload = false) {
            var form = $(_this);
            var actionUrl = form.attr('action');
            reload ? actionUrl += '?onload=true': ''
            var callbacktrue = function () {
                $('#loader-wrapper').css("display", "block");
                $.ajax({
                    type: "{{ $form['method'] }}",
                    url: actionUrl,
                    data: form.serialize(),
                }).done( function(res , status , xhr){
                    $('#loader-wrapper').css("display", "none")
                    if(res.success){
                        helper.showNotification("{{ trans('core::cores.msg.oki') }}", 'success', 1000);
                        if (res.url) {
                            window.location = res.url;
                        }
                        return true;
                    }else{
                        if(jQuery.type( res.msg ) === "string"){
                            helper.showNotification(res.msg, 'danger', 1000);
                        }
                        else{
                            validation(res.msg);
                        }
                    }
                    return false;
                }).fail(function(err){
                    $('#loader-wrapper').css("display", "none")
                    if (typeof err.responseJSON.msg != 'undefined'){
                        helper.showNotification(err.responseJSON.msg, 'danger', 3000);
                    }

                    if (typeof err.responseJSON.msg != 'undefined'){
                        helper.showNotification(err.responseJSON.msg, 'danger', 3000);
                    }
                    if (typeof err.responseJSON.errors != 'undefined'){
                        validation(err.responseJSON.errors);
                    }
                    helper.showNotification("{{ trans('core::cores.msg.error') }}", 'danger', 1000);
                });
            };

            var callbackfalse = function () {};
            helper.confirmDialogMulti(
                // '{{ trans("core::cores.confirm.alert") }}',
                '',
                '{{ trans("core::cores.confirm.title", ["action" => mb_strtolower($config["title"])]) }}', 
                'red', 
                '{{ config("core.action.cancel.title") }}',
                'btn btn-warning btn-flat btn-sm', 
                '{{ config("core.action.oki.title") }}',
                'btn btn-success btn-sm btn-flat', 
                callbackfalse,
                callbacktrue
            );
        }
        $("#{{ $form['id'] }}").submit(function(e) {
            e.preventDefault();
            formSubmit(this);
        });

        $(document).bind('keydown', function(e) {
            if(e.ctrlKey && (e.which == 83)) {
                formSubmit("#{{ $form['id'] }}");
                return false;
            }
        });

        $("#{{ $form['id'] }}").on("click", "a.btn-duplicate", function(e) {
            e.preventDefault();
            const actionUrl = $(this).attr('href');
            var callbacktrue = function() {
                $('#loader-wrapper').css("display", "block")
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: {
                        _token: $('meta[name=csrf-token]').attr(
                            'content')
                    },
                }).done(function(res, status, xhr) {
                    $('#loader-wrapper').css("display", "none")
                    if (res.success) {
                        helper.showNotification(
                            "{{ trans('core::cores.msg.oki') }}",
                            'success', 1000);
                        window.location.href = res.url;
                        return true;
                    } else {
                        helper.showNotification(res.msg, 'danger',
                        1000);
                    }
                    return false;
                }).fail(function(err) {
                    $('#loader-wrapper').css("display", "none")
                    helper.showNotification(
                        "{{ trans('core::cores.msg.error') }}",
                        'danger', 1000);

                    if (typeof err.responseText != 'undefined') {
                        helper.showNotification(err.responseText,
                            'danger', 1000);
                        return;
                    }

                    if (typeof err.responseJSON.msg != 'undefined') {
                        helper.showNotification(err.responseJSON.msg,
                            'danger', 1000);
                    }
                });
            };

            var callbackfalse = function() {};
            helper.confirmDialogMulti(
                '{{ trans('core::cores.confirm.alert') }}',
                '{{ trans('core::cores.confirm.title', ['action' => mb_strtolower(trans('core::cores.action.duplicate'))]) }}',
                'red',
                '{{ config('core.action.cancel.title') }}',
                'btn btn-danger waves-effect w-md waves-light',
                '{{ config('core.action.oki.title') }}',
                'btn btn-success btn-rounded w-md waves-effect waves-light',
                callbackfalse,
                callbacktrue
            );
        });
    });
    function validation(data) {
        $('.has-error').removeClass('has-error');
        $('.help-block').remove();
        $.each(data, function( key, value ) {
            key = key.replace('translate.', "");
            const form = $("[name="+key+"]");
            form.parent().addClass('has-error');
            form.after('<span class="help-block">' + value + '</span>');
            form.focus()

            const select = $('select[name='+key+']', '.select2');
            select.addClass('has-error');
            select.after('<span class="help-block">' + value + '</span>');
            helper.showNotification(value, 'danger', 1000);
            select.focus()
        });
    }
    </script>
@endpush