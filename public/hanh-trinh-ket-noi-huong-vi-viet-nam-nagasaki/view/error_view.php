
<?php
    require_once (VIEW_LAYOUT_DIR . '/master.php');
    require_once (VIEW_LAYOUT_DIR . '/seo.php');
    require_once (VIEW_LAYOUT_DIR . '/header.php');
?>

<div class="background custom-thanks">
    <picture>
        <source media="(max-width:560px)" srcset="<?php echo url('assets/images/bg_mb-v2.png'); ?>" />
        <source media="(max-width:991px)" srcset="<?php echo url('assets/images/bg_tb.png'); ?>" />
        <img class="fixed" src="<?php echo url('assets/images/bg_pc.png'); ?>"  style="position: absolute; width: 100%; height: 100%;object-fit: cover;">
    </picture>
    <a href="<?php echo url(''); ?>" class="home-logo">
        <img src="<?php echo url('assets/images/logo.svg'); ?>" alt="">
    </a>
    <div class="container custom">
        <div class="tab-contents">
            <div class="thanks-page" id="thanks">
                <div class="thanks-content">
                    <h2 style="color: red;    margin: 0;">
                        Kết nối hệ thống đang bị dán đoạn vui lòng thử lại sau vài phút.
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once (VIEW_LAYOUT_DIR . '/footer.php');
?>