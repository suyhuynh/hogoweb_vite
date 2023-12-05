
<?php
    require_once (VIEW_LAYOUT_DIR . '/master.php');
    require_once (VIEW_LAYOUT_DIR . '/seo.php');
    require_once (VIEW_LAYOUT_DIR . '/header.php');
?>

<div class="background custom-thanks">
<img class="fixed" src="<?php echo url('assets/images/bg.png'); ?>" alt="" style="position: fixed"/>
    <a href="<?php echo url(''); ?>" class="home-logo" style="display: block;">
        <img src="<?php echo url('assets/images/logo.png'); ?>" alt="gulliver">
    </a>
    <div class="container custom">
        <?php
            require_once (VIEW_COMPONENT_DIR . '/thanks.php');
        ?>
    </div>
</div>

<?php
    require_once (VIEW_LAYOUT_DIR . '/footer.php');
?>