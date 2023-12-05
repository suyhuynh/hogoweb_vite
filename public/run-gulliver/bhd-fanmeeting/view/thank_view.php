
<?php
    require_once (VIEW_LAYOUT_DIR . '/master.php');
    require_once (VIEW_LAYOUT_DIR . '/seo.php');
    require_once (VIEW_LAYOUT_DIR . '/header.php');
?>

<div class="background custom-thanks">
<img class="fixed" src="/gulliver/assets/images/bg.png" alt="" style="position: fixed"/>
    <a href="/gulliver" class="home-logo">
        <img src="/gulliver/assets/images/logo.png" alt="">
    </a>
    <div class="container custom">
        <?php
            if ($customer['status'] == 'yet_surveyed') {
                require_once (VIEW_COMPONENT_DIR . '/thanks.php');
            } else {
                require_once (VIEW_COMPONENT_DIR . '/thank_investigated.php');
            }
        ?>
    </div>
</div>

<?php
    require_once (VIEW_LAYOUT_DIR . '/footer.php');
?>