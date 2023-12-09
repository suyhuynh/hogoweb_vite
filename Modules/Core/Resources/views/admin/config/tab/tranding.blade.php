<p class="config-title">
    <strong>{{ trans('core::cores.config.tranding') }}</strong>
</p>
<hr />
<input type="hidden" name="type" value="tranding" />
{!! Form::bsText(trans('core::cores.config.form.cache_days'), 'config[cache_date]', $entity->config['cache_date'] ?? '3', ['data-number-only' => 'number-only', 'max' => 1]) !!}
{!! Form::bsText(trans('core::cores.config.form.max_display'), 'config[max_display]', $entity->config['max_display'] ?? '5', ['data-number-only' => 'number-only', 'max' => 1]) !!}
{!!
    Form::bsSelect(
        trans('core::cores.config.form.condition'), 'config[condition]', $entity->config['condition'] ?? 'desc_view',
        config('core.condition_tranding'),
        [], true
    )
 !!}
 <div class="form-group">
    <label>{{ trans('core::cores.condition_tranding.prioritize') }}</label>
    <select multiple="multiple" data-value="{{ !empty($entity->config['prioritize']) ? json_encode($entity->config['prioritize']) : '' }}"
        name="config[prioritize][]"
        id="prioritize"
        class="form-control select2-prioritize" 
        data-key-search="{{ trans('post::tags.tag_keyword') }}"
        data-placeholder="{{ trans('post::tags.tag_search') }}"
        data-trans="{{ trans('core::cores.select2_input') }}"
        >
    </select>
</div>
@push('scripts')
<script>
    window.addEventListener('load', function() {
        var _token = $('meta[name=csrf-token]').attr('content');
        let select_remote_data = $('.select2-prioritize');
        let ids = select_remote_data.attr('data-value');
        let tran_key = select_remote_data.attr('data-key-search');
        var trans = select_remote_data.attr('data-trans');
        select_remote_data.select2({
            multiple: true,
            // tags:true,
            width: "100%",
            language: {
                inputTooShort: function() {
                    return trans;
                }
            },
            ajax: {
                url: '{{ route("api.posts.index") }}',
                dataType: 'json',
                delay: 250,
                type: "GET",
                data: function(params) {
                    return {
                        keyword: params.term, // search term
                        page: params.page,
                        _token: _token
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            language: {
                inputTooShort: function() {
                    return tran_key;
                }
              },
            createSearchChoice : function (term) { return {id: term, text: term}; },
            escapeMarkup: function(markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 2
        });
        if (ids) {
            $.ajax({
                url: '{{ route("api.posts.find") }}',
                type: 'GET',
                dataType: 'json',
                data: { ids: ids, _token: _token },
            }).done(function(res) {
                if (res.success) {
                    if (res.data) {
                        $.each(res.data, function( id, tag ) {
                            let option = new Option(tag, id, true, true);
                            select_remote_data.append(option);
                        });
                    }
                }
            });
        }
    });
    </script>
@endpush