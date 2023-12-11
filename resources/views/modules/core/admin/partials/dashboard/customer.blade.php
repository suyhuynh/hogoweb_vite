<div class="box box-primary">
    <div class="box-header with-border">
        <strong>{{ trans('core::cores.dashboard.customer') }}</strong>
    </div>
    <div class="index-table box-body" id="customers-table">
        <div class="table-responsive">
            <table class="table table-striped table-hover " id="">
                <thead>
                    <tr>
                        <th data-sort>{{ trans('customer::customers.table.fullname') }}</th>
                        <th>{{ trans('customer::customers.table.email') }}</th>
                        <th>{{ trans('customer::customers.table.phone') }}</th>
                        <th>{{ trans('customer::customers.table.birthday') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $('#customers-table table').DataTable({
        columns: [
            {data: 'fullname', name: 'fullname', orderable: true},
            {data: 'email', name: 'email', orderable: true},
            {data: 'phone', name: 'phone', orderable: true},
            {data: 'birthday', name: 'birthday', searchable: false, orderable: false},
        ],
        serverSide: true,
        processing: true,
        ajax: {
            url: "{{ route('admin.customers.index') }}",
            type: 'GET',
            data: {
                table: true,
                filters: {
                    birthday: "{{ date('Y-m-d') }}"
                }
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
        pageLength: 10,
        paging: true,
        lengthMenu: [10, 20, 30, 40, 50, 80, 90, 100, 200],
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
            processing: '<i class="fa fa-spinner fa-pulse fa-fw"></i>',
            emptyTable: "{{ trans('core::cores.table.empty_table') }}"
        },
    });
</script>
@endpush
