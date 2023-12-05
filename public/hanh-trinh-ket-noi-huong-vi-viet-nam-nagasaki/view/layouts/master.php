
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0'">
        <title><?php echo $meta['title']; ?></title>
        <meta name="description" content="<?php echo $meta['description']; ?>">
        <meta name="robots" content="index,follow,all">
        <meta name="googlebot" content="index,follow,al">
        <link rel="canonical" href="<?php echo url(); ?>" />
        <meta property="og:site_name" content="https://kilala.vn" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo url(); ?>" />
        <meta property="og:title" content="<?php echo $meta['title']; ?>" />
        <meta property="og:description" content="<?php echo $meta['description']; ?>" />
        <meta property="og:image" content="<?php echo $meta['image']; ?>" />
        <link rel="icon" href="<?php echo url('assets/favicon.ico'); ?>" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo url('assets/favicon.ico'); ?>" type="image/x-icon" />

        <title><?php echo $meta['title']; ?> | KILALA</title>
        <meta property="fb:app_id" content="308409768235086" />
        <meta property="fb:pages" content="190471551125400" />
        <meta property="fb:admins" content="100006527227772" />
        <meta name="description" content="<?php echo $meta['description']; ?>" />
        <meta property="og:image:alt" content="<?php echo $meta['title']; ?>">
        <!-- Schema.org markup for Google+ --> 
        <meta itemprop="name" content="<?php echo $meta['title']; ?>" />
        <meta itemprop="description" content="<?php echo $meta['description']; ?>" />
        <meta itemprop="keyword" content="<?php echo $meta['title']; ?>, <?php echo $meta['description']; ?>" />
        <meta itemprop="image" content="<?php echo $meta['image']; ?>" /> 
        <!-- Twitter Card data --> 
        <meta name="twitter:card" content="summary" /> 
        <meta name="twitter:title" content="<?php echo $meta['title']; ?>" /> 
        <meta name="twitter:description" content="<?php echo $meta['description']; ?>" />
        <meta name="twitter:image:src" content="<?php echo $meta['image']; ?>" /> 
        <!-- Open Graph data -->
        <meta property="og:url" content="<?php echo $meta['url']; ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?php echo $meta['title']; ?>" />
        <meta property="og:image" content="<?php echo $meta['image']; ?>" />
        <meta property="og:description" content="<?php echo $meta['description']; ?>" />

        <meta property="article:published_time" content="<?php echo $meta['published_at']; ?>" />
        <meta property="article:modified_time" content="<?php echo $meta['updated_at']; ?>" />
        <meta property="article:section" content="<?php echo $meta['description']; ?>" />
        <meta property="article:tag" content="<?php echo $meta['title']; ?>, <?php echo $meta['description']; ?>" />
        <meta property="article:author" content="https://www.facebook.com/vnkilala" />

        <!-- stylesheet -->
        <link href="<?php echo url('assets/css/base.css'); ?>?v=<?php echo $vison; ?>" rel="stylesheet" />
        <link href="<?php echo url('assets/css/aos.css'); ?>" rel="stylesheet" />
        <script src="<?php echo url('assets/js/jquery-3.6.0.min.js'); ?>?v=<?php echo $vison; ?>" type="text/javascript" charset="UTF-8" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="<?php echo url('assets/js/base.js'); ?>?v=<?php echo $vison; ?>" type="text/javascript"></script>
        <script src="<?php echo url('assets/js/lib/aos.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo url('assets/js/tabs.js'); ?>?v=<?php echo $vison; ?>" type="text/javascript"></script>
        <script src="<?php echo url('assets/js/validate_survey.js'); ?>?v=<?php echo $vison; ?>" type="text/javascript"></script>
        <script src="<?php echo url('assets/js/dial.js'); ?>?v=<?php echo $vison; ?>" type="text/javascript"></script>
        <script src="<?php echo url('assets/js/validate.js'); ?>?v=<?php echo $vison; ?>" type="text/javascript"></script>
        <style>
            .fixed {
                z-index: -1;
            }

            .copy {
                text-align: center;
                font-size: 13px;
                line-height: 16px;
                margin-bottom: 16px;
            }
            .tab-contents {
                padding-bottom: 72px;
            }
            @media screen and (max-width: 520px) {
                .copy {
                    font-size: 11px;
                }
            }
        </style>

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WJ9WTGDH');</script>

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NW7X5R3');</script>
        <!-- End Google Tag Manager -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '613402773527658');
            fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=613402773527658&ev=PageView&noscript=1"
            /></noscript>
            <!-- End Meta Pixel Code -->
    </head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NW7X5R3"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJ9WTGDH"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->