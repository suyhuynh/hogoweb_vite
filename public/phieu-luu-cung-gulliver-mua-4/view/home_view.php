
<?php
    require_once (VIEW_LAYOUT_DIR . '/master.php');
    require_once (VIEW_LAYOUT_DIR . '/seo.php');
    require_once (VIEW_LAYOUT_DIR . '/header.php');
?>

<div class="home-tab" >
    <a href="<?php echo url(''); ?>" class="home-logo">
        <img src="<?php echo url('assets/images/logo.png'); ?>" alt="">
    </a>
    <div class="home-content-tab">
        <div class="container custom">
            <div class="home-content">
                <div class="home-content-left">

                    <?php if ($todaySurvey > $endSurvey) { ?>
                    <h1 class="home-heading">
                        <strong>Chương trình khảo sát đã chính thức khép lại.</strong>
                    </h1>
                    <p>Xin cảm ơn quý khán giả đã dành thời gian tham gia.</p>
                    <p>Quý khán giả có thể theo dõi kết quả trúng thưởng chương trình khảo sát tại đây: 
                        <a href="https://www.facebook.com/rungulliver" rel="nofollow" title="rungulliver">https://www.facebook.com/rungulliver</a>
                    </p>

                    <?php } else { ?>

                    <h1 class="home-heading">
                        <span>Tham gia khảo sát</span>
                        <strong>Iphone, về tay ai?</strong>
                    </h1>
                    <div class="iphone-mb">
                        <img src="<?php echo url('assets/images/iphone-mb.png'); ?>" alt="Iphone 15">
                    </div>
                    <p>Chương trình “PHIÊU LƯU CÙNG GULLIVER - MÙA 4 RELOADED” do VOV phối hợp với Kansai TV sản xuất. Mùa 4 sẽ quay trở lại với khán giả Việt vào 28/10/2023 với sự góp mặt của bộ đôi diễn viên đang rất được yêu thích ở thời điểm hiện tại - Thanh Sơn và Khả Ngân. </p>
                    <p>Để cải thiện chất lượng nội dung, chúng tôi rất mong được lắng nghe ý kiến của quý khán giả thông qua bản khảo sát dưới đây. Sau khi hoàn thành khảo sát, quý vị đừng quên kiểm tra hộp thư để nhận mã dự thưởng tham gia chương trình quay số trúng các phần quà hấp dẫn của chương trình nhé!</p>
                    <div class="home-block-left">
                        <!-- <a href="" class="button-primary">
                            Tham gia ngay
                        </a> -->
                        <!-- <div class="center">
                            <a href="" class="btn btn-4">
                                <span>THAM GIA NGAY</span>
                            </a>
                        </div> -->
                        <a href="<?php echo url('dang-ky.html') ?>" class="btn btn-4">
                            <span>THAM GIA NGAY</span>
                        </a>
                        <div class="share-block">
                            <a href="https://www.youtube.com/playlist?list=PLDSzb4fgM4fhx2-RT5obfvSnMJZnVdnH0" title="Youtube" target="_blank" rel="nofollow">
                                <img src="<?php echo url('assets/images/youtube.png'); ?>" alt="Logo Youtube" />
                            </a>
                            <a href="https://www.facebook.com/rungulliver" title="Facebook" rel="nofollow" target="_blank">
                                <img src="<?php echo url('assets/images/facebook.png'); ?>" alt="Logo Facebook">
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="home-content-right">
                    <img src="<?php echo url('assets/images/iphone.png'); ?>" alt="Iphone 15">
                </div>
            </div>
            <div class="bottom-main">
                <div class="partner partner-pc">
                    <div class="partner-item">
                        <h3>Hợp tác sản xuất:</h3>
                        <div class="list-partner">
                            <img src="<?php echo url('assets/images/kan-logo.png'); ?>" alt="Logo Kan">
                        </div>
                    </div>
                    <div class="partner-item">
                        <h3>Đơn vị phát sóng:</h3>
                        <div class="list-partner-custom ">
                            <img class="custom-img" src="<?php echo url('assets/images/vov_logo.png'); ?>" alt="Logo VOV">
                            <img src="<?php echo url('assets/images/VTC1.jpg'); ?>" alt="Logo vtc1">
                            <img src="<?php echo url('assets/images/vtc9.jpg'); ?>" alt="Logo vtc9">
                        </div>
                    </div>
                </div>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $videoCode; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                <div class="share-block-mb">
                    <a href="https://www.youtube.com/playlist?list=PLDSzb4fgM4fhx2-RT5obfvSnMJZnVdnH0" title="Youtube" target="_blank" rel="nofollow">
                        <img src="<?php echo url('assets/images/youtube.png'); ?>" alt="Logo Youtube" />
                    </a>
                    <a href="https://www.facebook.com/rungulliver" title="Facebook" rel="nofollow" target="_blank">
                        <img src="<?php echo url('assets/images/facebook.png'); ?>" alt="Logo Facebook">
                    </a>
                </div>
            </div>
            <div class="partner partner-mb partner-mb-custom">
                <div class="partner-item">
                    <h3>Hợp tác sản xuất:</h3>
                    <div class="list-partner">
                        <img src="<?php echo url('assets/images/kan-logo.png'); ?>" alt="Logo Kan">
                    </div>
                </div>
                <div class="partner-item">
                    <h3>Đơn vị phát sóng:</h3>
                    <div class="list-partner-custom ">
                        <img class="custom-img" src="<?php echo url('assets/images/vov_logo.png'); ?>" alt="Logo VOV">
                        <img src="<?php echo url('assets/images/VTC1.jpg'); ?>" alt="Logo vtc1">
                        <img src="<?php echo url('assets/images/vtc9.jpg'); ?>" alt="Logo vtc9">
                    </div>
                </div>
            </div>
            <p class="copy">
                ©KANSAI TELEVISION CO., LTD. All right reserved. <br />Powered by Kilala Communication
            </p>
        </div>
    </div>
</div>
<style>
    .copy {
        position: absolute;
        bottom: 20px;
        left: 0;
        width: 100%;
        margin: 0;
        padding: 0;
    }
    @media screen and (max-width: 1920px) {
        .copy {
            bottom: 50px;
        }
    }
    @media screen and (max-width: 1024px) {
        .copy {
            bottom: -30px;
        }
    }

    @media screen and (max-width: 540px) {
        .copy {
            position: static;
            margin-bottom: 15px;
        }
    }

    @media screen and (max-width: 400px) {
        .partner-mb-custom {
            margin-bottom: 19px;
        }
    }
</style>
<?php
   // require_once (VIEW_LAYOUT_DIR . '/footer.php');
?>
    