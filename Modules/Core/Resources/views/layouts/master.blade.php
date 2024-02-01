<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1, user-scalable=yes" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('admin/assets/img/icon-hogo-web.ico') }}" />
    <meta name="robots" content="noindex, nofollow">
    <title>HoGoWeb Admin 4.0</title>
    <link href="{{ asset('admin/app/css/icons/icomoon/styles.min.css') }}?v={{ visionApp() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/app/css/icons/fontawesome/styles.min.css') }}?v={{ visionApp() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}?v={{ visionApp() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/bootstrap_limitless.min.css') }}?v={{ visionApp() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/admin/app/js/plugins/jquery-confirm/jquery-confirm.min.css') }}?v={{ visionApp() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/animate.min.css') }}?v={{ visionApp() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/layout.min.css') }}?v={{ visionApp() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/components.min.css') }}?v={{ visionApp() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/app/cropper/cropper.min.css') }}?v={{ visionApp() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/colors.min.css') }}?v={{ visionApp() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/erp.css')}}?v={{ visionApp() }}" media="all" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/gallery.css')}}?v={{ visionApp() }}" media="all" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('admin/app/js/main/jquery.min.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('admin/app/js/main/bootstrap.bundle.min.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('admin/app/js/plugins/loaders/blockui.min.js') }}?v={{ visionApp() }}"></script>

    <script type="text/javascript" src="{{ asset('admin/app/js/plugins/forms/styling/uniform.min.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('admin/app/js/plugins/forms/styling/switchery.min.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('admin/app/js/plugins/ui/moment/moment.min.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('admin/app/js/plugins/pickers/daterangepicker.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('admin/app/js/plugins/pickers/pickadate/picker.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('admin/app/js/plugins/forms/selects/select2.min.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('admin/app/js/plugins/forms/selects/bootstrap_multiselect.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/app/js/wysiwyg/tinymce.min.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/app/js/plugins/editors/ace/ace.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/js/app.js') }}"></script>
    <style type="text/css" media="all">
        @-webkit-keyframes rotateInDownRight{
            0%{
                -webkit-transform:rotate(5deg);
                transform:rotate(5deg);opacity:1
            }to{
                -webkit-transform:translateZ(0);transform:translateZ(0);opacity:1
            }
        }
        @keyframes rotateInDownRight{0%{-webkit-transform:rotate(5deg);transform:rotate(5deg);opacity:1}
            to{-webkit-transform:translateZ(0);transform:translateZ(0);opacity:1}
        }
        
        .nav-link {
            display: block;
            padding: 0.75rem 0.75rem;
        }
        #page-header-light{
            z-index: 10 !important;
        }
        .nav-sidebar .nav-link{
            padding: .55rem 1.25rem;
        }
        .nav-item-submenu>.nav-link:after{
            top: .55rem;
        }
        @media (min-width: 768px){
            .navbar-expand-md .navbar-brand {
                min-width: 12.625rem;
            }
        }
        @media (max-width: 768px){
            .dd-item, .dd-empty, .dd-placeholder {
                min-height: 80px !important;
                height: 80px !important;
                margin-bottom: 15px;
            }
        }
        .sidebar{
            width: 13.875rem;
        }
        .jconfirm {
            z-index: 9999999999;
        }
    </style>
    @if(session()->has('color_admin'))
    <style type="text/css" media="all">
        .navbar-dark{
            background-color: {{ session('color_admin')['navbar_logo_background'] }};
        }
        .sidebar-dark {
            background-color: {{ session('color_admin')['navbar_background'] }};
            color: {{ session('color_admin')['navbar_color'] }};
        }
        .sidebar-dark .nav-sidebar .nav-link:not(.disabled):hover, .sidebar-light .card[class*=bg-]:not(.bg-light):not(.bg-white):not(.bg-transparent) .nav-sidebar .nav-link:not(.disabled):hover {
            background-color: {{ session('color_admin')['navbar_background_hover'] }};
            color: {{ session('color_admin')['navbar_color_hover'] }};
        }
        .navbar-collapse{
            background: {{ session('color_admin')['navbar_top_background'] }};
        }
        .navbar-light .navbar-nav-link:focus, .navbar-light .navbar-nav-link:hover{
            color: {{ session('color_admin')['navbar_top_color_hover'] }};
            background-color: {{ session('color_admin')['navbar_top_background_hover'] }};
        }
        </style>
    @endif
    @stack('style')
</head>
<body>
    <div id="app">
        <div id="loader-wrapper" class="" >
            <div class="loader">
                <div class="inner one"></div>
                <div class="inner two"></div>
                <div class="inner three"></div>
            </div>
        </div>
        @include('core::layouts.partials.header')

        <div class="page-content">
            @include('core::layouts.partials.sidebar')
            <div class="content-wrapper" style="overflow-x: hidden;min-height: 100vh;">
                @yield('navbar')
                <div class="content" id="content-master" style="padding-top: 4em;min-height: calc(100vh - 50px);display: none;">
                    @if(!empty(session()->get('error')))
                    <div class="alert alert-danger alert-styled-left alert-dismissible mb-2">
                        <button type="button" class="close" data-dismiss="alert" style="height: 100%;font-size: large;"><span aria-hidden="true">&times;</span></button>
                        <span class="font-weight-semibold">Oh no!</span> {!! session()->get('error') !!}.
                    </div>
                    @endif
                    @if(!empty(session()->get('success')))
                    <div class="alert alert-success alert-styled-left alert-dismissible mb-2">
                        <button type="button" class="close" data-dismiss="alert" style="height: 100%;font-size: large;"><span aria-hidden="true">&times;</span></button>
                        <span class="font-weight-semibold">Yeah!</span> {!! session()->get('success') !!}.
                    </div>
                    @endif
        
                    @yield('content')

                    <footer class="main-footer">
                        <div class="pull-right hidden-xs">
                            <b>Version</b> 3.1.0
                        </div>
                        <strong>Copyright &copy; 2023 <a href="https://hogoweb.com">HoGoWeb</a>.</strong> All rights
                        reserved.
                    </footer>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="{{ asset('public/admin/app/cropper/cropper.min.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ env('APP_ENV') == 'producttion' ? asset('public/admin/vue/vue.min.js') : asset('public/admin/vue/vue.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/vue/lodash.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/app/js/plugins/notifications/bootstrap-notify.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/app/js/plugins/jquery-confirm/jquery-confirm.min.js') }}?v={{ visionApp() }}"></script>
    <script src="{{ asset('admin/vue/color/vue-color.min.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/vue/components.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/vue/component_forms.js') }}?v={{ visionApp() }}?v={{ visionApp() }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/vue/helper.js') }}?v={{ visionApp() }}"></script>
    <script type="text/javascript">
        $(window).scroll(function() {
            if ($(this).scrollTop() > 20) {
                $('#page-header-light').css('top', '0');
            } else {
                $('#page-header-light').css('top', '');
            }
        });
        $('#loader-wrapper').css('display', 'none');
    </script>
    @stack('script')

    <script type="text/javascript">
        var timeout = null;
        new Vue ({
            el: '#app',
            mixins: [mix],
            data: {
                calculating: false,
                isLoading: false,
                countrys: [],
                provinces: [],
                districts: [],
                wards: [],
                array_items: {
                    max: 0,
                    images: []
                },
                alert: {
                    success: false,
                    danger: false,
                    title: '',
                },
                form: {}
            },
            methods: {
                store: function (url, is_continue = false) {
                    var vm = this;
                    $('.red-border').removeClass('red-border')
                    $('.alert-error-submit').remove()
                    var callbacktrue = function () {
                        vm.isLoading = true;
                        vm.form._token = $('meta[name=csrf-token]').attr('content');
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: vm.form,                        
                        }).done( function(res , status , xhr){
                            vm.isLoading = false;
                            if(res.success){
                                vm.alert.success = true;
                                vm.alert.title = res.resource;
                                helper.showNotification("{{ trans('attributes.success') }}", 'success', 1000);
                                if(is_continue){
                                    window.location.reload();
                                    return;
                                }
                                window.location = res.url;
                                return true;
                            }else{
                                vm.alert.danger = true;
                                vm.alert.title = res.resource;
                                if(jQuery.type( res.msg ) === "string"){
                                    helper.showNotification(res.msg, 'danger', 1000);
                                }
                                else{
                                    $.each( res.msg, function( key, value ) {
                                        key = key.replace('translate.', "");
                                        $("[name="+key+"]").addClass('red-border').after('<small class="alert-error-submit text-danger">' + value + '</small>');
                                        $('select[name='+key+']', '.select2').addClass('red-border').after('<small class="alert-error-submit text-danger">' + value + '</small>');
                                        helper.showNotification(value, 'danger', 1000);
                                    });
                                }
                            }
                            return false;
                        }).fail(function(err){
                            if (typeof err.responseJSON.errors != 'undefined'){
                                $.each( err.responseJSON.errors, function( key, value ) {
                                    key = key.replace('translate.', "");
                                    $("[name="+key+"]").addClass('red-border').after('<small class="alert-error-submit text-danger">' + value + '</small>');
                                    $('select[name='+key+']', '.select2').addClass('red-border').after('<small class="alert-error-submit text-danger">' + value + '</small>');
                                    helper.showNotification(value, 'danger', 1000);
                                });
                            }
                            vm.alert.danger = true;
                            vm.alert.title = '{{ trans('attributes.error') }}';
                            helper.showNotification("{{ trans('attributes.error') }}", 'danger', 1000);
                            vm.isLoading = false;
                        });
                    };
                    var callbackfalse = function () {};
                    helper.confirmDialogMulti(
                        '{{ trans('attributes.alert') }}',
                        '{{ trans('validation.store_alert', ["resource" => trans('validation.attributes.info')]) }}', 
                        'red', 
                        '{{ trans('attributes.alert_cancel') }}', 
                        'btn btn-danger waves-effect w-md waves-light', 
                        '{{ trans('attributes.alert_success') }}', 
                        'btn btn-success btn-rounded w-md waves-effect waves-light', 
                        callbackfalse,
                        callbacktrue
                    );          
                },
                update: function (url) {
                    var vm = this;
                    $('.red-border').removeClass('red-border')
                    $('.alert-error-submit').remove()
                    var callbacktrue = function () {
                        vm.isLoading = true;
                        vm.form._token = $('meta[name=csrf-token]').attr('content');
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: vm.form,                        
                        }).done( function(res , status , xhr){
                            vm.isLoading = false;
                            if(res.success){
                                vm.alert.success = true;
                                vm.alert.title = res.resource;

                                helper.showNotification("{{ trans('attributes.success') }}", 'success', 1000);
                                if(res.url){
                                    return window.location = res.url;
                                }
                                return true;
                            }else{
                                vm.alert.danger = true;
                                vm.alert.title = res.resource;
                                if(jQuery.type( res.msg ) === "string"){
                                    helper.showNotification(res.msg, 'danger', 1000);
                                }
                                else{
                                    $.each( res.msg, function( key, value ) {
                                        key = key.replace('translate.', "");
                                        $("[name="+key+"]").addClass('red-border').after('<small class="alert-error-submit text-danger">' + value + '</small>');
                                        $('select[name='+key+']', '.select2').addClass('red-border').after('<small class="alert-error-submit text-danger">' + value + '</small>');
                                        helper.showNotification(value, 'danger', 1000);
                                    });
                                }
                            }
                            return false;
                        }).fail(function(err){
                            console.log(err);
                            vm.alert.danger = true;
                            vm.alert.title = '{{ trans('attributes.error') }}';
                            if (typeof err.responseJSON.errors != 'undefined'){
                                $.each( err.responseJSON.errors, function( key, value ) {
                                    key = key.replace('translate.', "");
                                    $("[name="+key+"]").addClass('red-border').after('<small class="alert-error-submit text-danger">' + value + '</small>');
                                    $('select[name='+key+']', '.select2').addClass('red-border').after('<small class="alert-error-submit text-danger">' + value + '</small>');
                                    helper.showNotification(value, 'danger', 1000);
                                });
                            }
                            helper.showNotification("{{ trans('attributes.error') }}", 'danger', 1000);
                            vm.isLoading = false;
                        })
                    };
                    var callbackfalse = function () {};
                    helper.confirmDialogMulti(
                        '{{ trans('attributes.alert') }}',
                        '{{ trans('validation.update_alert', ["resource" => trans('validation.attributes.info')]) }}', 
                        'red', 
                        '{{ trans('attributes.alert_cancel') }}', 
                        'btn btn-danger waves-effect w-md waves-light', 
                        '{{ trans('attributes.alert_success') }}', 
                        'btn btn-success btn-rounded w-md waves-effect waves-light', 
                        callbackfalse,
                        callbacktrue
                    );
                },
                showSeo: function () {
                    $('#seo-data').slideToggle();
                },
                showURL: function () {
                    $('#show-edit-url').slideToggle();
                },
                showGallery: function (type, form_data) {
                    var vm = this;
                    var items = form_data.split('.');
                    vm.array_items.max = items.length;
                    vm.array_items.images = items;
                    if (type == 'primary_image') {
                        var arr = [];
                        var img = "";
                            // var AppMedia = new AppMedia();
                            AppMedia.show({
                                current : [],
                                multiple: false,
                                group: 'product',
                                output: function (data) {
                                    if(vm.array_items.max == 2){
                                        vm[vm.array_items.images[0]][vm.array_items.images[1]] = data[0].path;
                                    }else if(vm.array_items.max == 3){
                                        vm[vm.array_items.images[0]][vm.array_items.images[1]][vm.array_items.images[2]] = data[0].path;
                                    }
                                    else if(vm.array_items.max == 4){
                                        vm[vm.array_items.images[0]][vm.array_items.images[1]][vm.array_items.images[2]][vm.array_items.images[4]] = data[0].path;
                                    }else{
                                        vm[vm.array_items.images[0]] = data[0].path;
                                    }
                                }
                            });
                        } else if (type == 'album_images') {
                            if (typeof AppMedia != 'undefined') {
                                var AppMedia = new AppMedia();
                                AppMedia.show({
                                    current : vm.listDataCreate.album_images,
                                    multiple: true,
                                    maxFile : 6,
                                    group: 'product',
                                    output: function (data) {
                                        if (data.length) {
                                            vm.listDataCreate.album_images = data;
                                        }
                                    }
                                });
                            }
                        }
                    },
                    removeImg:function (form_data) {
                        var vm = this;
                        var items = form_data.split('.');
                        if(items.length == 2){
                            vm[items[0]][items[1]] = '';
                        }else if(items.length == 3){
                            vm[items[0]][items[1]][items[2]] = '';
                        }
                        else if(items.length == 4){
                            vm[items[0]][items[1]][items[2]][items[4]] = '';
                        }else{
                            vm[items.images[0]] = '';
                        }
                    },
                    showLoading:function () {
                        if(this.isLoading){
                            $('#loader-wrapper').css('display', 'block');
                        }else{
                            $('#loader-wrapper').css('display', 'none');
                        }
                    },
                },
                mounted() {
                    var vm = this;
                    $( "body" ).on( "click", "a.btn-store", function(event) {
                        event.preventDefault();
                        vm.store($(this).attr('href'));
                    });
                    $( "body" ).on( "click", "a.btn-update", function(event) {
                        event.preventDefault();
                        vm.update($(this).attr('href'));
                    });
                    window.addEventListener('beforeunload', function (e) {
                        delete e['returnValue'];
                    });
                },
            watch: {
                "form.alias": function (val) {
                    this.form.seo.alias = this.form.alias;
                },
                "form.translate.alias": function (val) {
                    this.form.seo.alias = this.form.translate.alias;
                },
                "form.translate.title": function (oldval) {
                    var vm = this;
                    if(oldval != '' && oldval != undefined && oldval != null){
                        if(timeout) {
                            clearTimeout(timeout);
                            timeout = null;
                        }
                        timeout = setTimeout( function() {
                            var formdata = new FormData;
                            formdata.append('text' , vm.form.translate.title);
                            formdata.append('id' , vm.form.seo.id);
                            helper.post( '{{ route("convert.url") }}' , formdata ,15000)
                            .done( function(res , status , xhr){
                                vm.form.seo.alias = res;
                                vm.form.translate.alias = res;
                            })
                            .fail(function(err){

                            });
                        }, 800);
                    }
                },
                "form.title": function (oldval) {
                    var vm = this;
                    if(oldval != '' && oldval != undefined && oldval != null && vm.form.seo){
                        if(timeout) {
                            clearTimeout(timeout);
                            timeout = null;
                        }
                        timeout = setTimeout( function() {
                            var formdata = new FormData;
                            formdata.append('text' , vm.form.title);
                            formdata.append('id' , vm.form.seo.id);
                            helper.post( '{{ route("convert.url") }}' , formdata ,15000)
                            .done( function(res , status , xhr){
                                vm.form.seo.alias = res;
                                vm.form.alias = res;
                            })
                            .fail(function(err){

                            });
                        }, 800);
                    }
                },
                "isLoading" : function (oldval) {
                    this.showLoading();   
                }
            },
            created: function () {
                $('#content-master').css('display', 'block');
                $('#loader-wrapper').css('display', 'none');
                $(window).off('beforeunload');
            },
        });
    </script>
</body>
</html>
