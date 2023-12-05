
<?php
    require_once (VIEW_LAYOUT_DIR . '/master.php');
    require_once (VIEW_LAYOUT_DIR . '/seo.php');
    require_once (VIEW_LAYOUT_DIR . '/header.php');
?>

<main class="home-click">
    <picture>
        <source media="(max-width:560px)" srcset="<?php echo url('assets/images/bg_mb-v2.png'); ?>" />
        <source media="(max-width:991px)" srcset="<?php echo url('assets/images/bg_tb.png'); ?>" />
        <img class="fixed" src="<?php echo url('assets/images/bg_pc.png'); ?>"  style="position: absolute; width: 100%; height: 100%;object-fit: cover;">
    </picture>

    <section class="homePage">
        <div class="background-home">
            <picture>
                <source media="(min-width:992px)" srcset="<?php echo url('assets/images/noodles.png'); ?>" />
                <source media="(min-width:551px)" srcset="<?php echo url('assets/images/noodles_tab.png'); ?>" />
                <source media="(min-width:0)" srcset="<?php echo url('assets/images/noodles_mb.png'); ?>" />
                <img class="noodles" src="<?php echo url('assets/images/noodles.png'); ?>" data-aos="fade-in" data-aos-duration="1000">
            </picture> 
            
            <picture>
                <source media="(min-width:992px)" srcset="<?php echo url('assets/images/chef.png'); ?>" />
                <source media="(max-width:991px)" srcset="<?php echo url('assets/images/chef_mb.png'); ?>" />
                <img class="chef" src="<?php echo url('assets/images/chef.png'); ?>">
            </picture> 

            <picture>
                <source media="(min-width:992px)" srcset="<?php echo url('assets/images/boat.png'); ?>" />
                <source media="(max-width:991px)" srcset="<?php echo url('assets/images/boat_mb.png'); ?>" />
                <img class="boat" src="<?php echo url('assets/images/boat.png'); ?>">
            </picture> 
        </div>

        <div class="image-iphone">
            <img src="<?php echo url('assets/images/iphone.png'); ?>" alt="" data-aos="zoom-in" data-aos-duration="1000">
        </div>

        <div class="content">
            <div class="image-flex">
                <img class="image-mb" src="<?php echo url('assets/images/noodles_mb.png'); ?>">
                <h1 class="title" data-aos="flip-up" data-aos-duration="1000">
                    <picture>
                        <source media="(min-width:993px)" srcset="<?php echo url('assets/images/ket-noi-huong-vi.png'); ?>" />
                        <source media="(min-width:551px)" srcset="<?php echo url('assets/images/ket-noi-huong-vi-tab.png'); ?>" />
                        <source media="(min-width:0)" srcset="<?php echo url('assets/images/ket-noi-huong-vi-mb.png'); ?>" />
                        <img src="<?php echo url('assets/images/ket-noi-huong-vi.png'); ?>" alt="">
                    </picture> 
                    Hành trình kết nối hương vị Việt Nam - Nagasaki
                </h1>
            </div>
            <img class="hidden-pc iphone" src="<?php echo url('assets/images/iphone.png'); ?>" alt="">
            <h2 data-aos="fade-in" data-aos-duration="1000">Tham gia khảo sát, trúng iPhone 15!</h2>

            <p data-aos="fade-in" data-aos-duration="1000">Chương trình “Hành trình Kết nối hương vị Việt Nam - Nagasaki” do VOV TV phối hợp với Kansai TV (KanTele) sản xuất. Mùa 4 sẽ quay trở lại với khán giả Việt vào 28/10/2023 với sự góp mặt của bộ đôi diễn viên đang rất được yêu thích ở thời điểm hiện tại - Thanh Sơn và Khả Ngân. </p>
            <p data-aos="fade-in" data-aos-duration="1000">Để cải thiện chất lượng nội dung, chúng tôi rất mong được lắng nghe ý kiến của quý khán giả thông qua bản khảo sát dưới đây. Sau khi hoàn thành khảo sát, quý vị đừng quên kiểm tra hộp thư để nhận mã quay số trúng thưởng nhiều phần quà hấp dẫn của chương trình nhé!</p>
            
            <div class="group-button">
                <a class="btn btn-primary" href="<?php echo url('dang-ky.html'); ?>" data-aos="zoom-in" data-aos-duration="1000">
                <span class="btn-primary-label">Tham gia ngay</span>
                    <svg class="btn-primary-circle" width="190" x="0px" y="0px" viewBox="0 0 60 60" enable-background="new 0 0 60 60">
                        <circle fill="#E02B00" cx="30" cy="30" r="28.7"></circle>
                    </svg>
                </a>
                <div class="social" data-aos="zoom-in" data-aos-duration="1000">
                    <a href="<?php echo $linkYoutube; ?>" target="_blank" rel="nofollow" class="youtube">
                        <img src="<?php echo url('assets/images/youtube.svg'); ?>" alt="Youtube">
                    </a>
                    <a href="<?php echo $linkFacbook; ?>" target="_blank" rel="nofollow" class="facebook">
                        <img src="<?php echo url('assets/images/facebook.svg'); ?>" alt="Facebook">
                    </a>
                </div>
            </div>

            <div class="youtube-view">
                <div class="box-layout">
                    <iframe data-aos="flip-down" data-aos-duration="1000" width="330" height="190" src="https://www.youtube.com/embed/<?php echo $videoCode; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    <div class="social" data-aos="zoom-in" data-aos-duration="1000">
                        <a href="<?php echo $linkYoutube; ?>" target="_blank" rel="nofollow" class="youtube">
                            <img src="<?php echo url('assets/images/youtube.svg'); ?>" alt="Youtube">
                        </a>
                        <a href="<?php echo $linkFacbook; ?>" target="_blank" rel="nofollow" class="facebook">
                            <img src="<?php echo url('assets/images/facebook.svg'); ?>" alt="Facebook">
                        </a>
                    </div>
                    <img class="mb-only" src="<?php echo url('assets/images/chef_mb.png'); ?>" data-aos="fade-in" data-aos-duration="1500">
                    <ul class="partner">
                        <li data-aos="fade-right" data-aos-duration="1000">
                            Hợp tác sản xuất
                            <img src="<?php echo url('assets/images/kan.svg'); ?>" alt="">
                        </li>
                        <li data-aos="fade-left" data-aos-duration="1000">
                            Đơn vị phát sóng
                            <img src="<?php echo url('assets/images/vtv.svg'); ?>" alt="">
                        </li>
                    </ul>
                </div>
                <img class="img-readmore" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200" src="<?php echo url('assets/images/ytb-icon.svg'); ?>" alt="">
            </div>
           
            <div class="copy-right">
                <ul class="partner">
                    <li data-aos="fade-right" data-aos-duration="1000">
                        Hợp tác sản xuất
                        <img src="<?php echo url('assets/images/kan.svg'); ?>" alt="">
                    </li>
                    <li data-aos="fade-left" data-aos-duration="1000">
                        Đơn vị phát sóng
                        <img src="<?php echo url('assets/images/vtv.svg'); ?>" alt="">
                    </li>
                </ul>
                ©Television Nagasaki Co.,Ltd. All right reserved.</br /> Powered by Kilala Communication</div>
        </div>
    </section>
</main>
    