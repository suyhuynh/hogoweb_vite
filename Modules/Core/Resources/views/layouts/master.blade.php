<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KILALA</title>
    {{-- <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="active-date" content="{{ config('core.default_date') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
    <meta name="googlebot-news" content="nosnippet" />
    @vite(['resources/assets/backend/scss/app.scss', 'resources/assets/backend/app.js'])
    <script>
        var customDaterangepicker = {!! json_encode(trans('core::cores.daterangepicker')) !!};
    </script>
    @stack('head')
    <style>
        #loader-wrapper {
            position:fixed;
            top:0 !important;
            left:0;
            width:100%;
            height:100%;
            z-index:999999;
            background-color:#e5f3f0a6;
            opacity:1;
            -webkit-transition:all 500ms linear 0s;
            -moz-transition:all 500ms linear 0s;
            -ms-transition:all 500ms linear 0s;
            -o-transition:all 500ms linear 0s;
            transition:all 500ms linear 0s;
        }
        #loader-wrapper .loader{position:absolute;top:calc(50% - 32px);left:calc(50% - 32px);width:64px;height:64px;border-radius:50%;perspective:800px}
        #loader-wrapper .inner{position:absolute;box-sizing:border-box;width:100%;height:100%;border-radius:50%}
        #loader-wrapper .inner.one{left:0%;top:0%;animation:rotate-one 1s linear infinite;border-bottom:3px solid #64c5b1}
        #loader-wrapper .inner.two{right:0%;top:0%;animation:rotate-two 1s linear infinite;border-right:3px solid #64c5b1}
        #loader-wrapper .inner.three{right:0%;bottom:0%;animation:rotate-three 1s linear infinite;border-top:3px solid #64c5b1}
        @keyframes rotate-one{0%{transform:rotateX(35deg) rotateY(-45deg) rotateZ(0deg)}100%{transform:rotateX(35deg) rotateY(-45deg) rotateZ(360deg)}}
        @keyframes rotate-two{0%{transform:rotateX(50deg) rotateY(10deg) rotateZ(0deg)}100%{transform:rotateX(50deg) rotateY(10deg) rotateZ(360deg)}}
        @keyframes rotate-three{0%{transform:rotateX(35deg) rotateY(55deg) rotateZ(0deg)}100%{transform:rotateX(35deg) rotateY(55deg) rotateZ(360deg)}}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
{{-- <body class="skin-blue layout-boxed sidebar-mini"> --}}
    <div id="loader-wrapper">
        <div class="loader">
            <div class="inner one"></div>
            <div class="inner two"></div>
            <div class="inner three"></div>
        </div>
    </div>
    <div class="wrapper">
        @include('core::layouts.partials.header')
        @include('core::layouts.partials.sidebar')

        <div class="content-wrapper">
            @yield('breadcrumb')
            <section class="content">
                @include('core::layouts.partials.notification')
                @yield('content')
            </section>
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 3.1.0
            </div>
            <strong>Copyright &copy; 2023 <a href="https://kilala.vn">Suy Huỳnh Kilala</a>.</strong> All rights
            reserved.
        </footer>

        @include('core::layouts.partials.footer')
        <div class="control-sidebar-bg"></div>
    </div>
    @stack('footer')
    @stack('scripts')

    <script>
        $('#loader-wrapper').css("display", "none")
    </script>
</body>
</html>
