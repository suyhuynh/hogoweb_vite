<button id="delete-cache" type="button" class="btn btn-warning btn-flat">{{ trans('core::cores.config.cache.delete') }}</button>
<button id="delete-update-module" type="button" class="btn bg-olive btn-flat margin">{{ trans('core::cores.config.cache.update_module') }}</button>

@push('scripts')
<script>
    $('#delete-cache').on("click", function() {
        var callbacktrue = function () {
            $('#loader-wrapper').css("display", "block");
            $.ajax({
                type: "GET",
                url: '{{ route('api.clear') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }).done( function(res , status , xhr){
                $('#loader-wrapper').css("display", "none");
                helper.showNotification("{{ trans('core::cores.msg.oki') }}", 'success', 1000);
                return false;
            }).fail(function(err){
                $('#loader-wrapper').css("display", "none");
                helper.showNotification("{{ trans('core::cores.msg.error') }}", 'danger', 1000);
            });
        };

        var callbackfalse = function () {};
        helper.confirmDialogMulti(
            '{{ trans("core::cores.confirm.alert") }}',
            '{{ trans("core::cores.confirm.delete_cache") }}',
            'red',
            '{{ config("core.action.cancel.title") }}',
            'btn btn-danger btn-flat btn-sm',
            '{{ config("core.action.oki.title") }}',
            'btn btn-success btn-sm btn-flat',
            callbackfalse,
            callbacktrue
        );
    });
    
    $('#delete-update-module').on("click", function() {
        var callbacktrue = function () {
            $('#loader-wrapper').css("display", "block");
            $.ajax({
                type: "GET",
                url: '{{ route('api.install') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }).done( function(res , status , xhr){
                $('#loader-wrapper').css("display", "none");
                helper.showNotification("{{ trans('core::cores.msg.oki') }}", 'success', 1000);
                return false;
            }).fail(function(err){
                $('#loader-wrapper').css("display", "none");
                helper.showNotification("{{ trans('core::cores.msg.error') }}", 'danger', 1000);
            });
        };

        var callbackfalse = function () {};
        helper.confirmDialogMulti(
            '{{ trans("core::cores.confirm.alert") }}',
            '{{ trans("core::cores.confirm.title", ["action" => trans("core::cores.action.update")]) }}',
            'red',
            '{{ config("core.action.cancel.title") }}',
            'btn btn-danger btn-flat btn-sm',
            '{{ config("core.action.oki.title") }}',
            'btn btn-success btn-sm btn-flat',
            callbackfalse,
            callbacktrue
        );
    });
</script>
@endpush