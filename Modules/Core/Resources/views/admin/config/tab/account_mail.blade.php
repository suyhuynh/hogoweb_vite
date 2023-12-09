<p class="config-title">
    <strong>{{ trans('core::cores.config.account_mail') }}</strong>
</p>
<hr />
<div class="links-list">
    <div class="list">
        @if(!empty($entity->config['lists']) && count($entity->config['lists']))
            @foreach($entity->config['lists'] as $key => $val)
                <div class="row" style="display: flex;align-items: center;">
                    <div class="col-xs-11">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form">{{ trans('core::cores.config.form.account_email') }}</label>
                                    <input type="text" class="form-control input-sm" name="config[lists][{{ $key }}][account]" value="{{ $val['account'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form">{{ trans('core::cores.config.form.password') }}</label>
                                    <input type="password" class="form-control input-sm" name="config[lists][{{ $key }}][password]" value="{{ $val['password'] ?? '' }}"">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form">{{ trans('core::cores.config.form.host') }}</label>
                                    <input type="text" class="form-control input-sm" name="config[lists][{{ $key }}][host]" value="{{ $val['host'] ?? '' }}"">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form">{{ trans('core::cores.config.form.port') }}</label>
                                    <input type="text" class="form-control input-sm" name="config[lists][{{ $key }}][port]" value="{{ $val['port'] ?? '' }}"">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-1 text-center">
                        <a href="javascript:void(0)" class="btn-remove-item">
                            <i class="fa fa-times fa-2x"></i>
                        </a>
                    </div>
                </div>
                <hr>
            @endforeach
        @endif
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-sm bg-olive btn-flat btn-add-link" data-number="0">
            <i class="fa fa-plus"></i>
        </button>
    </div>
</div>
@push('scripts')
<script>
    window.addEventListener('load', function() {
        $('.links-list .list').on('click', '.btn-remove-item', function() {
            $(this).parent().parent().remove();
        });
        $('.btn-add-link').on('click', function() {
            const number = {{ !empty($key) ? $key : 0 }} + 1;
            $(this).parent().parent().find('.list').append(`
                <div class="row" style="display: flex;align-items: center;">
                    <div class="col-xs-11">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form">{{ trans('core::cores.config.form.account_email') }}</label>
                                    <input type="text" class="form-control input-sm" name="config[lists][${number}][account]" value="">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form">{{ trans('core::cores.config.form.password') }}</label>
                                    <input type="passwword" class="form-control input-sm" name="config[lists][${number}][password]" value="">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form">{{ trans('core::cores.config.form.host') }}</label>
                                    <input type="text" class="form-control input-sm" name="config[lists][${number}][host]" value="">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="form">{{ trans('core::cores.config.form.port') }}</label>
                                    <input type="text" class="form-control input-sm" name="config[lists][${number}][port]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-1 text-center">
                        <a href="javascript:void(0)" class="btn-remove-item">
                            <i class="fa fa-times fa-2x"></i>
                        </a>
                    </div>
                </div>
                <hr>
            `);
            $(this).attr('data-number', number);
        });
    });
    </script>
@endpush
