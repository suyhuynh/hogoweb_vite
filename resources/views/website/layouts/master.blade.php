<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="vi" xml:lang="vi">

@php
    $uri = url()->full();
@endphp
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="/images/icon/icon.png" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
    <link rel="canonical" href="{{ $uri }}" />
    <meta property="og:site_name" content="{{ url('/') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_CLIENT_ID') }}" />

    @if(!empty($seo))

        <title>{{ $seo['title'] }} | KILALA</title> 
        <meta name="description" content="{{ $seo['description'] }}" />
        <!-- Schema.org markup for Google+ --> 
        <meta itemprop="name" content="{{ $seo['title'] }}" />
        <meta itemprop="description" content="{{ $seo['description'] }}" />
        <meta itemprop="keyword" content="{{ $seo['title'] }}, {{ $seo['keyword'] }}" />
        <meta itemprop="image" content="{{ url('/') }}{{ $seo['img'] }}" /> 
        <!-- Twitter Card data --> 
        <meta name="twitter:card" content="summary_large_image" /> 
        <meta name="twitter:title" content="{{ $seo['expand']['twitter']['title'] ?? $seo['title'] }}" /> 
        <meta name="twitter:description" content="{{ $seo['expand']['twitter']['description'] ?? $seo['description'] }}" />
        <meta name="twitter:image:src" content="{{ url('/') }}{{ $seo['expand']['twitter']['img'] ?? $seo['img'] }}" /> 
        <!-- Open Graph data -->
        <meta property="og:url" content="{{ $uri }}" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="{{  $seo['expand']['facebook']['title'] ?? $seo['title'] }}" />
        <meta property="og:image" content="{{ url('/') }}{{  $seo['expand']['facebook']['img'] ?? $seo['img'] }}" />
        <meta property="og:description" content="{{  $seo['expand']['facebook']['description'] ?? $seo['description'] }}" />

        <meta property="article:published_time" content="{{ $seo['published_at'] }}" />
        <meta property="article:modified_time" content="{{ $seo['updated_at'] }}" />
        <meta property="article:section" content="{{ $seo['description'] }}" />
        <meta property="article:tag" content="{{ $seo['title'] }}, {{ $seo['keyword'] }}" />

        <meta name="robots" content="noindex" />
        <meta name="googlebot" content="noindex" />
        <meta name="googlebot-news" content="nosnippet" />

        @if(!empty($seo['status']) && $seo['status'] == 'nofollow')
            <meta name="robots" content="noindex" />
            <meta name="googlebot" content="noindex" />
            <meta name="googlebot-news" content="nosnippet" />
        @endif
    @else
        <title>Web công nghệ | HoGoWeb</title>
    @endif

    @stack('meta')
</head>

<body class="" id="wrapper">
    <div style="display: none">
        {!! $seo['schema'] ?? '' !!}
    </div>
    {{-- <div class="preloader"> 
        <div class="loader-img"></div>
    </div> --}}
    @include('website.layouts.header')

    <main class="opacity0">
        @yield('content')
        <div style="display: none"
        class="fb-like"
        data-share="true"
        data-width="450"
        data-show-faces="true">
        </div>
    </main>

    @include('website.layouts.footer')
    <div class="js-backtop back-to-top">
        <a href="javascript:void(0)">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 15.7131L18.01 9.70309L16.597 8.28809L12 12.8881L7.40399 8.28809L5.98999 9.70209L12 15.7131Z" fill="#fff"/>
            </svg>

        </a>
    </div>
    <div class="overlay"></div>
    <div id="ajax-loader" class="js-page-loader">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js" async></script>
    <script id="listBannerAds" type="text/template">
        <div class="blog-image">
            <a href="<%= link %>">
                <figure class="image__wrapper">
                    <img class="lazy" data-src="<%= translate.img %>" src="/images/img_1x1.png" alt="<%= translate.title %>">
                </figure>
            </a>
        </div>
        <div class="blog-detail">
            <div>
                <span class="label"><%= category_name %></span>
                <h3 class="blog-title">
                    <a href="<%= link %>" title="<%= translate.title %>"><%= translate.title %></a>
                </h3>
            </div>
            <div class="blog-author d-none d-lg-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <span class="author"><%= author %></span>
                    <span class="date"><%= published_at_format %></span>
                </div>
                <div class="d-flex flex-wrap">
                    <a href="javascript:void(0)" class="js-bookmark bookmark icon icon-bookmark" data-type="post" data-id="<%= id %>">
                        <%= bookmark %>
                    </a>
                </div>
            </div>
        </div>
    </script>

    @stack('script')
    <script type="text/javascript" defer>
        window.fbAsyncInit = function() {
            FB.init({
            appId      : '308409768235086',
            xfbml      : true,
            version    : 'v17.0'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


        function loadAsync(){
            // create Facebook SDK script element
            let fbScript = document.createElement('script');
            fbScript.async = true;
            fbScript.defer = true;
            fbScript.crossorigin = 'anonymous';
            fbScript.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0';
            fbScript.nonce = 'vyZiLpO8';

            // create Twitter widgets script element
            let twitterScript = document.createElement('script');
            twitterScript.defer = true;
            twitterScript.charset = 'utf-8';
            twitterScript.src = 'https://platform.twitter.com/widgets.js';

            // create TikTok embed script element
            let tiktokScript = document.createElement('script');
            tiktokScript.defer = true;
            tiktokScript.src = 'https://www.tiktok.com/embed.js';

            // create Instagram embed script element
            let instaScript = document.createElement('script');
            instaScript.defer = true;
            instaScript.src = 'https://www.instagram.com/embed.js';

            // append all scripts to the body element
            document.body.appendChild(fbScript);
            document.body.appendChild(twitterScript);
            document.body.appendChild(tiktokScript);
            document.body.appendChild(instaScript);
        }
        window.addEventListener('load', () => {
            loadAsync();
        });
    </script>
</body>
</html>