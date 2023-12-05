
<?php
    require_once (VIEW_LAYOUT_DIR . '/master.php');
    require_once (VIEW_LAYOUT_DIR . '/seo.php');
    require_once (VIEW_LAYOUT_DIR . '/header.php');
?>

<div class="background">
    <img class="fixed" src="<?php echo url('assets/images/bg.png'); ?>" alt="" style="position: fixed"/>
    <a href="<?php echo url(''); ?>" class="home-logo" style="display: block;">
        <img src="<?php echo url('assets/images/logo.png'); ?>" alt="">
    </a>
    <div class="container">
        <div class="tab-contents">
            <div class="tab-content is-active" id="register">
                <div class="gulliver-box" style="max-width: 830px;">
                    <h2 class="md-block">Đăng ký tham gia khảo sát fan meeting <br /> “Phiêu lưu cùng Gulliver - Mùa 4 Reloaded”</h2>
                    <h2 class="md-none">Đăng ký khảo sát fan meeting <br /> Phiêu lưu cùng Gulliver <br /> Mùa 4 Reloaded</h2>
                </div>
                <form id="register" action="<?php echo url() ?>" method="post">
                    <div class="gulliver-box">
                        <div class="form-group">
                            <div class="form-control js-checkClass js-Text">
                                <p class="form-label">Họ và tên*</p>
                                <input type="text" name="fullname" id="name" class="form-input" require placeholder="" value="">
                                <div class="survey-selected">
                                
                                </div>
                            </div>
                            <div class="form-control js-checkClass js-Text">
                                <p class="form-label">Số điện thoại*</p>
                                <input type="tel" name="phone" id="phone" class="form-input" value="" require placeholder="" pattern="\d+" min="0" max="99999" minlength="11" maxlength="11">
                                <div class="survey-selected">
                                
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-field js-checkClass js-Text">
                                <p class="form-label">Email*</p>
                                <input type="email" name="email" id="email" class="form-input" require placeholder="" value="">
                                <div class="survey-selected">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="gulliver-box">
                        <div class="js-Check">
                            <p class="form-label">Nơi sống</p>
                            <div class="register-item js-checkClass">
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[address]" type="radio" id="register-address-hn" value="Hà Nội">
                                    <label class="form-check-label" for="register-address-hn">Hà Nội</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[address]" type="radio" id="register-address-tphcm" value="TP. Hồ Chí Minh">
                                    <label class="form-check-label" for="register-address-tphcm">TP. Hồ Chí Minh</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[address]" type="radio" id="register-address-dn" value="Đà Nẵng">
                                    <label class="form-check-label" for="register-address-dn">Đà Nẵng</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[address]" type="radio" id="register-address-ct" value="Cần Thơ">
                                    <label class="form-check-label" for="register-address-ct">Cần Thơ</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[address]" type="radio" id="register-address-note" value="Khác">
                                    <label class="form-check-label" for="register-address-note">Khác</label>
                                </div>
                            </div>
                            <div class="survey-selected">
                                
                            </div>
                        </div>
                        
                        <div class="js-Check">
                            <p class="form-label">Nghề nghiệp</p>
                            <div class="register-item js-checkClass job">
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[job]" type="radio" id="register-job-nv" value="Nhân viên văn phòng">
                                    <label class="form-check-label" for="register-job-nv">Nhân viên văn phòng</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[job]" type="radio" id="register-job-cn" value="Công nhân viên chức">
                                    <label class="form-check-label" for="register-job-cn">Công nhân viên chức</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[job]" type="radio" id="register-job-kd" value="Kinh doanh">
                                    <label class="form-check-label" for="register-job-kd">Kinh doanh</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[job]" type="radio" id="register-job-cm" value="Người có nghề nghiệp chuyên môn (Bác sĩ, luật sư, kế toán)">
                                    <label class="form-check-label" for="register-job-cm">Người có nghề nghiệp chuyên môn (Bác sĩ, luật sư, kế toán,...)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[job]" type="radio" id="register-job-hs" value="Học sinh">
                                    <label class="form-check-label" for="register-job-hs">Học sinh</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[job]" type="radio" id="register-job-nt" value="Nội trợ">
                                    <label class="form-check-label" for="register-job-nt">Nội trợ</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[job]" type="radio" id="register-job-note" value="Khác">
                                    <label class="form-check-label" for="register-job-note">Khác</label>
                                </div>
                            </div>
                            <div class="survey-selected">
                                
                            </div>
                        </div>
                        
                        <div class="js-Check">
                            <p class="form-label">Bạn bắt gặp quảng cáo của chương trình này ở đâu?</p>
                            <div class="register-item js-checkClass program list-checkbox">
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[program][]" type="checkbox" id="register-program-fb" value="Facebook">
                                    <label class="form-check-label" for="register-program-fb">Facebook</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[program][]" type="checkbox" id="register-program-yt" value="YouTube">
                                    <label class="form-check-label" for="register-program-yt">YouTube</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="extend[program][]" type="checkbox" id="register-program-web" value="Website (Trang chủ của chương trình hoặc các bài viết tin tức)">
                                    <label class="form-check-label" for="register-program-web">Website (Trang chủ của chương trình hoặc các bài viết tin tức)</label>
                                </div>
                            
                                <div class="form-check">
                                    <input class="form-check-input checkbox-diff" name="extend[program][]" type="checkbox" id="register-program-note" value="Khác">
                                    <label class="form-check-label" for="register-program-note">Khác</label>
                                </div>
                            </div>
                            <div class="survey-selected">
                                
                            </div>
                        </div>
                        <div class="btn-center">
                            <button name="submit" type="button" class="button-primary disabled" id="submit-register">
                                Khảo sát ngay
                                <div class="loader">
                                    <div class="inner one"></div>
                                    <div class="inner two"></div>
                                    <div class="inner three"></div>
                                </div>
                            </button>
                        </div>  
                        <div class="btn-center after-degree">
                            <button name="back" type="button" class="button-primary" id="clear-register" style="background: rgb(242,4,4);border: 1px solid transparent;">
                                Trở lại
                            </button>
                            <button name="submit" type="submit" class="button-primary" id="submit-register-send">
                                Xác nhận và khảo sát
                                <div class="loader">
                                    <div class="inner one"></div>
                                    <div class="inner two"></div>
                                    <div class="inner three"></div>
                                </div>
                            </button>
                        </div>
                        <p class="rules">Bằng việc bấm nút “Xác nhận tham gia”, bạn đã đọc và đồng ý với <a href="#rules" id="tab-button" title="Thể lệ chương trình">Thể lệ chương trình</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    require_once (VIEW_LAYOUT_DIR . '/footer.php');
?>

<div class="overlay-popup"></div>
<div class="popup-checkform">
    <div class="popup-content">
        <p>Vui lòng kiểm tra lại thông tin!</p>
        <div class="close">
            <button class="popup-close-btn">Đóng</button>
        </div>
    </div>
</div>

<script>
    document.body.classList.add("register-page");
    <?php 
        if(isset($msg)) {
            foreach ($msg as $key => $val) {
                echo "
                    $('input[name=" . $key . "]').css('border-color', 'red');
                    $('.notification').addClass('error').text('" . $val . "');
                ";
            }
            echo "setTimeout(function(){
                $('.notification').removeClass('success error')
            }, 2000);";
        }
    ?>

$(window).bind("pageshow", function() {
    $('form')[0].reset();
});
</script>