
<?php
    require_once (VIEW_LAYOUT_DIR . '/master.php');
    require_once (VIEW_LAYOUT_DIR . '/seo.php');
    require_once (VIEW_LAYOUT_DIR . '/header.php');
?>

<link href="<?php echo url('assets/css/dial.css'); ?>" rel="stylesheet" />

<div class="background dial">
    <picture>
        <source media="(min-width:992px)" srcset="<?php echo url('assets/images/bg_spin.png'); ?>" />
        <source media="(max-width:991px)" srcset="<?php echo url('assets/images/bg_spin.png'); ?>" />
        <img class="fixed" src="<?php echo url('assets/images/bg_spin.png'); ?>" alt="" style="position: fixed;width: 100%;height: 100%;"/>
    </picture> 
   
   
    <div class="logo-header">
        <a href="<?php echo url(''); ?>" class="home-logo">
            <img src="<?php echo url('assets/images/logo.png'); ?>" alt="">
        </a>
        <div class="logo">
            <img src="<?php echo url('assets/images/header.png'); ?>" alt="Phiêu lưu cùng Gulliver" class="gulli">
        </div>
    </div>

    <div class="container">

        <div class="bg-dial">
            <img src="<?php echo url('assets/images/left_spin.png'); ?>" alt="" class="left">

            <!-- <picture>
                <source media="(min-width:992px)" srcset="<?php echo url('assets/images/bg-dial-right.png'); ?>" />
                <source media="(max-width:991px)" srcset="<?php echo url('assets/images/bg-dial-right-mb.png'); ?>" />
                <img src="<?php echo url('assets/images/bg-dial-right.png'); ?>" alt="" class="right">
            </picture>  -->
            
            <img src="<?php echo url('assets/images/right_spin.png'); ?>" alt="" class="bottom">
        </div>

        <div class="tab-contents">
            <div class="dial-box">
                <h1>vòng quay may mắn</h1>
                <div class="dial-content">
                    <div class="dial-item">
                        <p>Mã trúng thưởng</p>
                        <div class="odometer-tab">
                            <div class="odometer">
                                <div class="digit">
                                    <div class="digit-container digit-thousand"></div>
                                </div>
                            </div>
                        </div>
                        <div class="dial-item">
                            <p style="margin-bottom: 8px;">Giải thưởng:</p>
                            <ul class="result">
                                <li class="toggle-goals" id="special-goals">Apple Watch SE
                                    <p>Trúng thưởng: <span class="special-code">------</span></p>
                                </li>
                                <li class="toggle-goals" id="first-goals">Túi Motherhouse
                                    <p>Trúng thưởng: <span class="first-code">------</span></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="dial-spin-action">
                    <button type="button" class="button button--random disabled" data-url="<?php echo url('process.asp'); ?>">QUAY SỐ</button>
                    <button type="button" class="button button--stop disabled">DỪNG</button>
                </div>
                <!-- <p class="info">Với mỗi bài khảo sát hợp lệ, chương trình đã gửi mã dự thưởng qua email của khán giả. Ban tổ chức sẽ liên hệ người trúng giải qua thông tin liên lạc đã được cung cấp trong bài khảo sát.</p> -->
            </div>
        </div>
        <img src="<?php echo url('assets/images/bg-dial-bottom-mb.png'); ?>" alt="" class="bottom-mb">

        <div class="partner">
            <div class="partner-item">
                <p>Đơn vị tổ chức:</p>
                <div class="list-partner-custom">
                    <img class="custom-img-2" src="<?php echo url('assets/images/vov_logo.png'); ?>" alt="Logo VOV">
                    <img class="custom-img-2" src="<?php echo url('assets/images/vtc.png'); ?>" alt="Logo VTC">
                    <img src="<?php echo url('assets/images/kan-logo.png'); ?>" alt="Logo Kan">
                </div>
            </div>
            <div class="partner-item">
                <p>Đơn vị hỗ trợ:</p>
                <div class="list-partner-custom">
                    <img class="custom-img-1" src="<?php echo url('assets/images/bhd.svg'); ?>" alt="Logo BHD">
                    <img class="custom-img-1" src="<?php echo url('assets/images/shochiku_e.svg'); ?>" alt="Logo Shochiku">
                    <img src="<?php echo url('assets/images/kilala.png'); ?>" alt="Logo Kilala">
                </div>
            </div>
        </div>

        <div class="bg-dial-tab">
            <img src="<?php echo url('assets/images/bg-dial-bottom-left.png'); ?>" alt="" class="left">
            <img src="<?php echo url('assets/images/bg-dial-bottom.png'); ?>" alt="" class="bottom">
        </div>
    </div>
</div>
<div class="congratulate">
    <div class="overlay"></div>
    <div class="congratulations"></div>
    <div class="popup-congratulate">
        <a class="close-popup" href="javascript:void(0)">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.2806 18.2194C19.3502 18.289 19.4055 18.3718 19.4432 18.4628C19.4809 18.5539 19.5003 18.6514 19.5003 18.75C19.5003 18.8485 19.4809 18.9461 19.4432 19.0372C19.4055 19.1282 19.3502 19.2109 19.2806 19.2806C19.2109 19.3503 19.1281 19.4056 19.0371 19.4433C18.9461 19.481 18.8485 19.5004 18.7499 19.5004C18.6514 19.5004 18.5538 19.481 18.4628 19.4433C18.3717 19.4056 18.289 19.3503 18.2193 19.2806L11.9999 13.0603L5.78055 19.2806C5.63982 19.4213 5.44895 19.5004 5.24993 19.5004C5.05091 19.5004 4.86003 19.4213 4.7193 19.2806C4.57857 19.1399 4.49951 18.949 4.49951 18.75C4.49951 18.551 4.57857 18.3601 4.7193 18.2194L10.9396 12L4.7193 5.78061C4.57857 5.63988 4.49951 5.44901 4.49951 5.24999C4.49951 5.05097 4.57857 4.8601 4.7193 4.71936C4.86003 4.57863 5.05091 4.49957 5.24993 4.49957C5.44895 4.49957 5.63982 4.57863 5.78055 4.71936L11.9999 10.9397L18.2193 4.71936C18.36 4.57863 18.5509 4.49957 18.7499 4.49957C18.949 4.49957 19.1398 4.57863 19.2806 4.71936C19.4213 4.8601 19.5003 5.05097 19.5003 5.24999C19.5003 5.44901 19.4213 5.63988 19.2806 5.78061L13.0602 12L19.2806 18.2194Z" fill="white"/>
            </svg>
        </a>
        <p class="custom-text heading-champ">Xin chúc mừng</p>
        <p class="custom-text name-champ"></p>
        <p class="custom-text">
            <span class="code-champ"></span>
            <span class="phone-champ"></span>
        </p>
        <p class="custom-text goals-champ">
            iPhone 15 - 128GB
        </p>
        <p class="info">
        Ban tổ chức sẽ liên hệ với bạn trong vòng 2 ngày tới. Bạn nhớ để ý email và giữ điện thoại luôn đổ chuông nhé.
        </p>
    </div>
</div>
<div id="audio-tab">
    <audio controls autoplay hidden>
        <source src="<?php echo url('assets/audio/crowd-cheer.mp3'); ?>" type="audio/mpeg">
    </audio>
</div>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
<script>

</script>