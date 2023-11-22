<div class="row">
    <div class="col-sx-6 col-sm-4 col-md-3">
        <form_file label="{{ trans('core::apps.file_demo') }}" v-model="form.file_demo"></form_file>
    </div>
    @if(checkLoginReadDocumnetFile($type))
    <div class="col-sx-6 col-sm-4 col-md-3">
        <form_file label="{{ trans('core::apps.file_full') }}" v-model="form.file_full"></form_file>
    </div>
    <div class="col-sx-12 col-sm-12 col-md-12">
        <div class="form-group">
            <span class="badge badge-danger">{{ trans('core::apps.note') }}</span>
            <span class="text-danger">
                {{ trans('core::apps.file_full_node') }}
            </span>
        </div>
    </div>
    @endif
</div>