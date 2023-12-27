<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('/public/admin/assets/img/icon-hogo-web.ico') }}" />

    <meta name="robots" content="noindex, nofollow">
    <title>HoGoWeb Admin 4.0</title>
    @stack('style')
    @vite(['resources/assets/backend/scss/app.scss', 'resources/assets/backend/app.js'])
</head>
<body>
    <div id="app">
        {{-- <div id="loader-wrapper" class="" >
            <div class="loader">
                <div class="inner one"></div>
                <div class="inner two"></div>
                <div class="inner three"></div>
            </div>
        </div> --}}
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

                    {{-- <footer class="main-footer">
                        <div class="pull-right hidden-xs">
                            <b>Version</b> 3.1.0
                        </div>
                        <strong>Copyright &copy; 2023 <a href="https://hogoweb.com">HoGoWeb</a>.</strong> All rights
                        reserved.
                    </footer> --}}
                </div>
            </div>
        </div>

    </div>
</body>
</html>
