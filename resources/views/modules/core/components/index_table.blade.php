@section('buttons_header')
    @if (isset($buttons, $name))
        @foreach ($buttons as $view)
            @hasAccess("admin.{$resource}.{$view}")
                <a href="{{ route("admin.{$resource}.{$view}") }}" class="btn btn-primary btn-actions btn-{{ $view }}"
                    style="margin-left: 5px;">
                    {{ trans("core::resource.{$view}", ['resource' => $name]) }}
                </a>
            @endHasAccess
        @endforeach
    @else
        {{ $buttons ?? '' }}
    @endif
@endsection

@section('content')
    @if (isset($stats))
        <div class="row">
            {{ $stats }}
        </div>
    @endif

    @php
        $idTable = isset($resource) ? str_replace('.', '-', $resource) . '-table' : '';
    @endphp

    <div class="box box-primary">
        @if (isset($tabs))
            {{ $tabs }}
        @endif
        <div class="box-header with-border">
            {{-- <h3 class="box-title">{{ $name ?? 'Empty' }}</h3>
            <div class="box-tools pull-right">
                @if (isset($buttons, $name))
                    @foreach ($buttons as $button)
                        @hasAccess("admin.{$resource}.{$button}")
                        <a href="{{ route('admin.' . $resource . '.create') }}"
                            class="btn bg-olive btn-flat {{ config('core.action.' . $button)['class'] }}">
                            <i class="{{ config('core.action.' . $button)['icon'] }}"></i>
                            {{ config('core.action.' . $button)['title'] }}
                        </a>
                        @endHasAccess
                    @endforeach
                @endif
            </div> --}}
            @if (isset($buttons, $name))
                @foreach ($buttons as $button)
                    @hasAccess("admin.{$resource}.{$button}")
                        <a href="{{ route('admin.' . $resource . '.create') }}"
                            class="btn btn-sm bg-olive btn-flat {{ config('core.action.' . $button)['class'] }}">
                            <i class="{{ config('core.action.' . $button)['icon'] }}"></i>
                            {{ config('core.action.' . $button)['title'] }}
                        </a>
                    @endHasAccess
                @endforeach
            @endif
        </div>

        <div class="index-table box-body" style="padding-top: 0;" id="{{ $idTable }}">
            @if (isset($filters))
                <div class="box-header with-border">
                    <div class="d-block d-sm-block d-md-block d-lg-none">
                        <button id="btn-show-filter" class="fa fa-ellipsis-v"></button>
                    </div>
                    <div id="filter-block" class="d-none d-sm-none d-md-none d-lg-block">
                        <form method="GET" action="{{ route("admin.{$resource}.index") }}" id="filter-table">
                            @hasAccess("admin.{$resource}.restore")
                                {{-- <div class="d-block" id="filter-soft-delete">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-link btn-sm">
                                        <input type="radio" name="soft_delete" value="" autocomplete="off" {{ empty(request()->soft_delete) ? 'checked' : '' }}>
                                        <span>Tất cả</span>
                                    </label>
                                    <label class="btn btn-link btn-sm">
                                        <input type="radio" name="soft_delete" value="1" {{ !empty(request()->soft_delete) ? 'checked' : '' }} autocomplete="off">
                                        <span>Thùng rác</span>
                                    </label>
                                </div>
                            </div> --}}
                            @endHasAccess
                            <div style="align-items: end;display: flex;" class="filter-form row">
                                @if(!empty($option_daterange_picker))
                                    <div class="col-md-3 col-12 col-sm-6 col-xs-12" style="padding-right: 0">
                                        <div class="input-group customer-product-filter-daterange">
                                            <div class="form-group row ">
                                                <label for='option' class='col-md-0 col-form-label'></label>
                                                <div class='col-md-12'>
                                                    <select name='option' class='form-control custom-select-black border-right-0 select2'  labelCol='0'  id='option'>
                                                        <option value='date_create' {{ request()->option == 'date_create' ? 'selected' : '' }}>{{ trans('core::cores.table.created') }}</option>
                                                        <option value='date_published' {{ request()->option == 'date_published' ? 'selected' : '' }}>{{ trans('post::posts.form.published_at') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" style="width: 60%">
                                                <button type="button" class="btn btn-block btn-default daterange-picker btn-flat">
                                                    <i class="fa fa-calendar mr-2"></i>
                                                    <span>{{ trans('core::cores.filter.all_date') }}</span>
                                                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                                    <input type="hidden" name="end_date" value="{{ request('end_date', date('Y-m-d')) }}">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-2 col-12 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>{{ trans('core::cores.filter.created_at') }}</label>
                                            <button type="button" class="btn btn-block btn-default daterange-picker btn-flat">
                                                <i class="fa fa-calendar mr-2"></i>
                                                <span>{{ trans('core::cores.filter.all_date') }}</span>
                                                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                                <input type="hidden" name="end_date"
                                                    value="{{ request('end_date', date('Y-m-d')) }}">
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-3 col-12 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>{{ trans('core::cores.filter.keyword') }}</label>
                                        <input class="form-control" type="text" name="keyword"
                                            value="{{ request()->keyword }}">
                                    </div>
                                </div>
                                {{ $filters }}

                                <div class="col-md-1 col-2 col-sm-2 col-xs-2">
                                    <a href="{{ route("admin.{$resource}.index") }}" title="Clear filter"
                                        class="btn btn-flat btn-danger" style="padding: 2px 5px;border: 1px solid;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M14.73 20.83L17.58 18l-2.85-2.83l1.42-1.41L19 16.57l2.8-2.81l1.42 1.41L20.41 18l2.81 2.83l-1.42 1.41L19 19.4l-2.85 2.84l-1.42-1.41M13 19.88c.04.3-.06.62-.29.83a.996.996 0 0 1-1.41 0L7.29 16.7a.989.989 0 0 1-.29-.83v-5.12L2.21 4.62a1 1 0 0 1 .17-1.4c.19-.14.4-.22.62-.22h14c.22 0 .43.08.62.22a1 1 0 0 1 .17 1.4L13 10.75v9.13M5.04 5L9 10.06v5.52l2 2v-7.53L14.96 5H5.04Z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <div class="box-header box-header-action with-border" style="display: flex;">
                <div class="btn-group mr-1" id="operation-list" style="display: none">
                    <button type="button" class="btn btn-default btn-flat dropdown-toggle" disabled data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ trans('core::validation.attributes.action') }} &nbsp; <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route("admin.{$resource}.destroy") }}" data-key="destroy" data-method="delete"><i
                                    class="fa fa-trash-o"></i> {{ trans('core::cores.action.delete') }}</a></li>
                        @hasAccess("admin.{$resource}.restore")
                            <li><a href="{{ route("admin.{$resource}.restore") }}" data-key="restore" data-method="post"><i
                                        class="fa fa-repeat"></i> {{ trans('core::cores.action.restore') }}</a></li>
                            <li><a href="{{ route("admin.{$resource}.permanently_delete") }}" data-key="permanently_delete"
                                    data-method="delete"><i class="fa fa-trash text-danger"></i>
                                    {{ trans('core::cores.action.permanently_delete') }}</a></li>
                        @endHasAccess
                        @if (!empty($checkBoxStatus))
                            <li role="separator" class="divider"></li>
                            @foreach ($checkBoxStatus as $key => $value)
                                <li><a href="{{ $value['route'] }}" data-value="{{ $value['key'] }}"
                                        data-method="{{ $value['method'] }}">{{ $value['title'] }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="form-group">
                    <select class="form-control" id="b-length-datatable">
                        @foreach (config('core.b_length_datatable') as $value)
                            <option value="{{ $value }}">
                                {{ trans('core::cores.table.b_length_change', ['total' => $value]) }}</option>
                        @endforeach
                    </select>
                </div>
                @if (!empty($export))
                    <div class="btn-group" style="margin-left: 10px">
                        <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-external-link"></i> {{ trans('core::cores.action.export') }}
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <button type="button" class="dropdown-item btn-link text-green js-btn-export" data-key="excel"
                                data-method="GET" data-href="{{ route("admin.{$resource}.exportExcel") }}"><i
                                    class="fa fa-file-excel-o"></i> Excel</button>

                        </div>
                    </div>
                @endif
            </div>

            @if (isset($thead))
                @include('core::components.table')
            @else
                {{ $slot }}
            @endif
        </div>
        {{-- 
        <div class="box-footer">
            Footer
            <div class="box-tools pull-right">
                <nav aria-label="...">
                    <ul class="pagination" id="pagination"></ul>
                </nav>
            </div>
        </div> --}}

    </div>
@endsection

@isset($name)
    @push('scripts')
        <style>
            .customer-product-filter-daterange {
                position: relative;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                -ms-flex-align: stretch;
                align-items: stretch;
                width: 100%;
            }
            .customer-product-filter-daterange .form-group {
                width: 50%;
            }
            .box-header-action .btn-group,
            .box-header-action .form-group {
                margin-bottom: 0;
                padding: 0;
            }

            .dataTables_paginate {
                position: relative;
            }

            .dataTables_paginate.disable-is-checkbox::after {
                content: "";
                width: 100%;
                height: 100%;
                position: absolute;
                z-index: 11;
                left: 0;
            }

            table tr td.action a, table tr td.publish a {
                padding: 0 8px;
                font-size: 18px;
            }

            table tr td.publish a.text-secondary {
                color: #b8b8b9;
            }
            table tr td.publish a.text-secondary:hover {
                color: #2b542c;
            }
            table tr td.publish a.text-secondary:hover i.fa-times:before {
                content: "\f00c";
            }

            table tr td.publish a.text-success:hover {
                color: red;
            }
            table tr td.publish a.text-success:hover i.fa-check:before {
                content: "\f00d";
            }
            /* table tr td.publish a i.fa-times:before {
                content: "\f00c";
            }

            table tr td.publish a i.fa-check:before {
                content: "\f00d";
            } */
        </style>
        <script>
            function dataTable() {
                var methods = this;
                methods.initTable = function(columns, order = []) {
                        var table = $('#{{ $idTable }} table').DataTable({
                            columns: columns,
                            order: order,
                            serverSide: true,
                            processing: true,
                            cache: true,
                            ajax: {
                                url: "{{ route('admin.' . $resource . '.index') }}",
                                type: 'GET',
                                cache: true,
                                data: {
                                    table: true,
                                    filters: {!! json_encode(request()->all()) !!}
                                },
                            },
                            bLengthChange: false,
                            searching: false,
                            stateSave: true,
                            sort: true,
                            info: true,
                            filter: true,
                            lengthChange: true,
                            paginate: true,
                            autoWidth: false,
                            pageLength: 20,
                            paging: true,
                            lengthMenu: [20, 30, 40, 50, 80, 90, 100, 200],
                            language: {
                                search: '_INPUT_',
                                searchPlaceholder: '',
                                lengthMenu: '_MENU_',
                                info: "{{ trans('core::cores.table.datatable_info') }}",
                                sInfoEmpty: '',
                                sInfoFiltered: "(filtered from _MAX_ total entries)",
                                paginate: {
                                    next: '<span class="glyphicon glyphicon-menu-right"></span>',
                                    previous: '<span class="glyphicon glyphicon-menu-left"></span>'
                                },
                                processing: '<i class="fa fa-spinner fa-pulse fa-fw"></i>'
                            },
                            initComplete: function(settings, json) {
                                var vm = this;
                                if (this.find('.select-all').length) {
                                    $(".box-header-action #operation-list").css('display', 'block');
                                }

                                $(".box-header-action").on("change", "#b-length-datatable", function(event) {
                                    changePageLenth(this.value);
                                });

                                $(".box-header-action").on("click", ".dropdown-menu a", function(event) {
                                    event.preventDefault();
                                    const key = $(this).attr('data-key');
                                    const method = $(this).attr('data-method');
                                    const value = $(this).attr('data-value');
                                    let url = $(this).attr('href');

                                    let action = '';
                                    switch (key) {
                                        case 'permanently_delete':
                                            action =
                                                "{{ trans('core::cores.action.permanently_delete') }}";
                                            break;
                                        case 'destroy':
                                            action = "{{ trans('core::cores.action.destroy') }}";
                                            url = url + '/' + getCheckBox(vm);
                                            break;
                                        case 'restore':
                                            action = "{{ trans('core::cores.action.restore') }}";
                                            break;
                                        default:
                                            action = $(this).text();
                                    }
                                    const title = "{{ trans('core::cores.confirm.title_all') }}";
                                    var callbacktrue = function() {
                                        $.ajax({
                                            type: method,
                                            url: url,
                                            data: {
                                                _token: $('meta[name=csrf-token]').attr(
                                                    'content'),
                                                ids: getCheckBox(vm),
                                                key: value
                                            },
                                        }).done(function(res, status, xhr) {
                                            vm.find('.select-all').change();
                                            if (res.success) {
                                                helper.showNotification(
                                                    "{{ trans('core::cores.msg.oki') }}",
                                                    'success', 1000);
                                                tableReload();
                                                return true;
                                            } else {
                                                helper.showNotification(res.msg, 'danger',
                                                    1000);
                                            }
                                            return false;
                                        }).fail(function(err) {
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
                                        title.replace(':action', '<b>' + action + '</b>'),
                                        'red',
                                        '{{ config('core.action.cancel.title') }}',
                                        'btn btn-danger waves-effect w-md waves-light',
                                        '{{ config('core.action.oki.title') }}',
                                        'btn btn-success btn-rounded w-md waves-effect waves-light',
                                        callbackfalse,
                                        callbacktrue
                                    );
                                });
                            },
                            rowCallback: (row, data, index) => {

                            },
                            drawCallback: function(settings) {
                                this.find('.select-all').on('change', (e) => {
                                    this.find('.select-row').prop('checked', e.currentTarget.checked);
                                    const parent = this.parents('#{{ $idTable }}');
                                    parent.find('.box-header-action').find('button').prop('disabled', (e
                                        .currentTarget.checked ? false : true));
                                    parent.find('.dataTables_paginate').toggleClass('disable-is-checkbox');
                                });

                                $(this).on('change', '.select-row', (e) => {
                                    // this.find('.select-row').prop('checked', e.currentTarget.checked);
                                    const parent = this.parents('#{{ $idTable }}');
                                    parent.find('.box-header-action').find('button').prop('disabled', (e
                                        .currentTarget.checked ? false : true));
                                    parent.find('.dataTables_paginate').toggleClass('disable-is-checkbox');
                                });
                                if (settings.json.input) {
                                    $('#b-length-datatable').val(settings.json.input.length);
                                }

                                $('.action a').tooltip();
                                $('.publish a').tooltip();
                                $(".publish").on("click", "a.btn-publish", function(e) {
                                    e.preventDefault();
                                    const actionUrl = $(this).attr('href');
                                    var callbacktrue = function() {
                                        $.ajax({
                                            type: "POST",
                                            url: actionUrl,
                                            data: {
                                                _token: $('meta[name=csrf-token]').attr(
                                                    'content')
                                            },
                                        }).done(function(res, status, xhr) {
                                            if (res.success) {
                                                helper.showNotification(
                                                    "{{ trans('core::cores.msg.oki') }}",
                                                    'success', 1000);
                                                tableReload();
                                                return true;
                                            } else {
                                                helper.showNotification(res.msg, 'danger',
                                                    1000);
                                            }
                                            return false;
                                        }).fail(function(err) {
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
                                        '{{ trans('core::cores.confirm.title', ['action' => mb_strtolower(trans('core::cores.action.update'))]) }}',
                                        'red',
                                        '{{ config('core.action.cancel.title') }}',
                                        'btn btn-danger waves-effect w-md waves-light',
                                        '{{ config('core.action.oki.title') }}',
                                        'btn btn-success btn-rounded w-md waves-effect waves-light',
                                        callbackfalse,
                                        callbacktrue
                                    );
                                });

                                $(".action").on("click", "a.btn-edit-layout", function(e) {
                                    e.preventDefault();
                                    const actionUrl = $(this).attr('href');
                                    var callbacktrue = function() {
                                        window.location.href = actionUrl;
                                    };
                                    var callbackfalse = function() {};
                                    helper.confirmDialogMulti(
                                        '{{ trans('core::cores.confirm.alert') }}',
                                        '{{ trans('core::cores.confirm.title', ['action' => mb_strtolower(trans('website::layouts.edit_layout'))]) }}',
                                        'red',
                                        '{{ config('core.action.cancel.title') }}',
                                        'btn btn-danger waves-effect w-md waves-light',
                                        '{{ config('core.action.oki.title') }}',
                                        'btn btn-success btn-rounded w-md waves-effect waves-light',
                                        callbackfalse,
                                        callbacktrue
                                    );
                                });
                                $(".action").on("click", "a.btn-delete", function(e) {
                                    e.preventDefault();
                                    const actionUrl = $(this).attr('href');
                                    var callbacktrue = function() {
                                        $.ajax({
                                            type: "DELETE",
                                            url: actionUrl,
                                            data: {
                                                _token: $('meta[name=csrf-token]').attr(
                                                    'content')
                                            },
                                        }).done(function(res, status, xhr) {
                                            if (res.success) {
                                                helper.showNotification(
                                                    "{{ trans('core::cores.msg.oki') }}",
                                                    'success', 1000);
                                                tableReload();
                                                return true;
                                            } else {
                                                helper.showNotification(res.msg, 'danger',
                                                    1000);
                                            }
                                            return false;
                                        }).fail(function(err) {
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
                                        '{{ trans('core::cores.confirm.title', ['action' => mb_strtolower(trans('core::cores.action.delete'))]) }}',
                                        'red',
                                        '{{ config('core.action.cancel.title') }}',
                                        'btn btn-danger waves-effect w-md waves-light',
                                        '{{ config('core.action.oki.title') }}',
                                        'btn btn-success btn-rounded w-md waves-effect waves-light',
                                        callbackfalse,
                                        callbacktrue
                                    );
                                });

                                $(".action").on("click", "a.btn-duplicate", function(e) {
                                    e.preventDefault();
                                    const actionUrl = $(this).attr('href');
                                    var callbacktrue = function() {
                                        $.ajax({
                                            type: "POST",
                                            url: actionUrl,
                                            data: {
                                                _token: $('meta[name=csrf-token]').attr(
                                                    'content')
                                            },
                                        }).done(function(res, status, xhr) {
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
                                var globalTimeout = null;
                                $(".action-order").on("click", ".btn-quantity .btn-quantity-up", function(e) {
                                    const htmlQuantity = $(this).parent().find('.quantity');
                                    const quantity = parseInt($(this).parent().find('.quantity').html()) +
                                        1;

                                    htmlQuantity.html(quantity);
                                    const id = $(this).attr('data-id');
                                    if (globalTimeout != null) clearTimeout(globalTimeout);
                                    globalTimeout = setTimeout(function() {
                                        globalTimeout = null;
                                        updatenNumericalOrder(id, quantity);
                                    }, 600);
                                });
                                $(".action-order").on("click", ".btn-quantity .btn-quantity-down", function(e) {
                                    const htmlQuantity = $(this).parent().find('.quantity');
                                    const quantity = parseInt($(this).parent().find('.quantity').html()) -
                                        1;
                                    if (quantity < 1) {
                                        const quantity = 1;
                                        return;
                                    }
                                    htmlQuantity.html(quantity);
                                    const id = $(this).attr('data-id');
                                    if (globalTimeout != null) clearTimeout(globalTimeout);
                                    globalTimeout = setTimeout(function() {
                                        globalTimeout = null;
                                        updatenNumericalOrder(id, quantity);
                                    }, 600);
                                });
                            },
                            stateSaveParams(settings, data) {
                                delete data.start;
                                delete data.search;
                            },
                        });
                        this.initFilter();

                        function tableReload() {
                            $('#select-all').prop('checked', false);
                            table.ajax.reload();
                        }

                        function changePageLenth(row) {
                            $('.select-all').prop('checked', false);
                            table.page.len(row).draw();
                        }

                        function getCheckBox(table) {
                            var selected = [];
                            table.find('.select-row:checked').each(function() {
                                selected.push(this.value);
                            });
                            return selected.toString();
                        }

                        function updatenNumericalOrder(id, order) {
                            $.ajax({
                                type: "POST",
                                url: '{{ route('admin.posts.numerical_order') }}',
                                data: {
                                    _token: $('meta[name=csrf-token]').attr(
                                        'content'),
                                    id: id,
                                    order: order,
                                },
                            }).done(function(res, status, xhr) {
                                if (res == 1) {
                                    helper.showNotification(
                                        "{{ trans('core::cores.msg.oki') }}",
                                        'success', 1000);
                                    return true;
                                } else {
                                    helper.showNotification(
                                        "{{ trans('core::cores.msg.error') }}",
                                        'danger',
                                        1000);
                                }
                            }).fail(function(err) {
                                helper.showNotification(
                                    "{{ trans('core::cores.msg.error') }}",
                                    'danger',
                                    1000);
                            });
                        }
                    },

                    methods.getParamsFormFilter = function(form) {
                        var queryString = $(form).serializeArray()
                            .filter(function(item) {
                                return item.value;
                            })
                            .map(function(item) {
                                return item.name + '=' + item.value;
                            }).join('&');
                        window.location.href = $(form).attr('action') + (queryString ? '?' + queryString : '');
                    },

                    methods.initFilter = function() {
                        var vm = this;
                        var form = $('#filter-block').find('form');

                        $(form).on('change', 'select, .daterange-picker, .datetime-picker, .date-picker, .selectize',
                            function() {
                                vm.getParamsFormFilter(form);
                            });

                        form.find('.daterange-picker').on('apply.daterangepicker', function(ev, picker) {
                            vm.getParamsFormFilter(form);
                        });
                        var time;
                        $(form).on('keyup', 'input[type=text]', function() {
                            clearTimeout(time);
                            var _this = this;
                            time = setTimeout(function() {
                                vm.getParamsFormFilter(form);
                            }, 1000);
                        });
                    }

                return methods;
            }
            var table = new dataTable();

            window.addEventListener('load', function() {
                $('body').on('click', 'button.js-btn-export', function() {
                    const method = $(this).attr('data-method');
                    const action = $(this).attr('data-key');
                    let url = $(this).attr('data-href');

                    const title = "{{ trans('core::cores.confirm.title_all') }}";
                    var callbacktrue = function() {
                        $.ajax({
                            type: method,
                            url: url,
                            data: $('#filter-table').serialize(),
                        }).done(function(res, status, xhr) {
                            if (res.success) {
                                helper.showNotification("{{ trans('core::cores.msg.oki') }}",
                                    'success', 1000);
                                window.location.href = res.url;
                            } else {
                                helper.showNotification(res.msg, 'danger', 1000);
                            }
                        }).fail(function(err) {
                            helper.showNotification("{{ trans('core::cores.msg.error') }}",
                                'danger', 1000);
                        });
                    };
                    helper.confirmDialogMulti(
                        '{{ trans('core::cores.confirm.alert') }}',
                        title.replace(':action', '<b>{{ trans('core::cores.action.export') }} ' + action + '</b>'),
                        'red',
                        '{{ config('core.action.cancel.title') }}',
                        'btn btn-danger waves-effect w-md waves-light',
                        '{{ config('core.action.oki.title') }}',
                        'btn btn-success btn-rounded w-md waves-effect waves-light',
                        function() {},
                        callbacktrue
                    );
                })
            });
        </script>
    @endpush
@endisset
