
<?php
    require_once (VIEW_LAYOUT_DIR . '/master.php');
    require_once (VIEW_LAYOUT_DIR . '/seo.php');
    require_once (VIEW_LAYOUT_DIR . '/header.php');
?>
<div class="background">
    <img class="fixed" src="<?php echo url('assets/images/bg.png'); ?>" alt="" style="position: fixed"/>
    <a href="<?php echo url(''); ?>" class="home-logo">
        <img src="<?php echo url('assets/images/logo.png'); ?>" alt="">
    </a>
    <div class="container">
        <div class="tab-contents">
            <div class="rules-page tab-content is-active" id="survey">
                <div class="survey-box">
                    <h2>Câu hỏi khảo sát chương trình fan meeting<br>“Phiêu lưu cùng Gulliver”</h2>
                </div>
                <form action="<?php echo url('gui-khao-sat.asp') ?>" method="post">
                    <?php foreach ($questions as $question) { ?>
                        <div class="survey " data-id="survey-<?php echo str_replace('.', '-', $question['order']); ?>" style="<?php if (strpos($question['order'], '.') !== false) { echo 'display: none;'; } ?>">
                            <div class="question">
                                <div class="num-ques">
                                    <span class="<?php if (strpos($question['order'], '.') !== false) { echo 'sub-question'; } ?>">
                                        Q<?php echo $question['order']; ?>
                                    </span>
                                </div>
                                    <p><?php echo $question['name']; ?></p>
                                </div>
                            <div class="<?php if ($question['form_name'] !== 'input') { echo 'survey-answers';} else { echo 'survey-input';} ?> row <?php if (strpos($question['order'], '.') !== false) { echo 'pass-input'; } ?> <?php if ($question['order'] === '8.2') { echo 'custom-question'; } ?>">
                                <?php foreach ($question['answers'] as $answer) { ?>
                                    <?php if ($question['form_name'] == 'checkbox') { ?>
                                        <div class="form-check answer-item form-check-inline ">
                                            <input class="form-check-input" data-check="<?php echo (!empty($answer['form_name']) ? 'true' : 'false'); ?>" name="answers[<?php echo $question['id']; ?>][]" type="checkbox" id="survey-<?php echo $question['id']; ?>-<?php echo $answer['id']; ?>" value="<?php echo $answer['id']; ?>">
                                            <label class="form-check-label" for="survey-<?php echo $question['id']; ?>-<?php echo $answer['id']; ?>">
                                                <?php echo $answer['name']; ?>
                                            </label>
                                        </div>
                                    <?php } ?>

                                    <?php if ($question['form_name'] == 'radio') { ?>
                                        <div class="form-check answer-item form-check-inline">
                                            <input class="form-check-input" data-check="<?php echo (!empty($answer['form_name']) ? 'true' : 'false'); ?>" name="answers[<?php echo $question['id']; ?>][]" type="radio" id="survey-<?php echo $question['id']; ?>-<?php echo $answer['id']; ?>" value="<?php echo $answer['id']; ?>">
                                            <label class="form-check-label" for="survey-<?php echo $question['id']; ?>-<?php echo $answer['id']; ?>">
                                                <?php echo $answer['name']; ?>
                                            </label>
                                        </div>
                                    <?php } ?>

                                    <?php if ($question['form_name'] == 'range') { ?>
                                        

                                    <?php } ?>

                                    <?php if ($question['form_name'] == 'input') { ?>
                                        <div class="form-group answer-item ">
                                            <textarea class="form-control" placeholder="<?php echo $answer['name']; ?>" name="answers[<?php echo $question['id']; ?>][]" id="input<?php $answer['id'] ?>" rows="3"></textarea>
                                        </div>
                                    <?php } ?>

                                <?php } ?>
                            </div>
                            <div class="survey-selected">
                                
                            </div>
                        </div>
                    <?php } ?>
                    <input type="hidden" name="submit" value="save" />
                    <div class="btn-center">
                        <button name="submit" type="button" class="button-primary" id="submit-survey">
                            Hoàn thành khảo sát
                            <div class="loader">
                                <div class="inner one"></div>
                                <div class="inner two"></div>
                                <div class="inner three"></div>
                            </div>
                        </button>
                    </div>
                    <div class="btn-center after-degree">
                        <button name="back" type="button" class="button-primary" id="clear-survey" style="background: rgb(242,4,4);border: 1px solid transparent;">
                            Trở lại
                        </button>
                        <button name="submit" type="submit" class="button-primary" id="submit-survey-send">
                            Xác nhận khảo sát
                            <div class="loader">
                                <div class="inner one"></div>
                                <div class="inner two"></div>
                                <div class="inner three"></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="overlay-popup"></div>
<div class="popup-checkform">
    <div class="popup-content">
        <p>Vui lòng kiểm tra lại thông tin!</p>
        <div class="close">
            <button class="popup-close-btn">Đóng</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    var survey1 = 0
    function unCheckInput(inputSelect, type = 'input') {
        if(type === "textarea") {
            inputSelect.val('');
        } else {
            inputSelect.prop('checked', false);
        }
    }
    $('.survey[data-id=survey-1] .survey-answers input').on('change', function(e) {
        if ($(this).is(":checked")) {
            survey1++
        } else {
            survey1--
        }

        if(survey1 > 1) {
            $('.survey[data-id=survey-1-1]').css('display', 'block');
            $('.survey[data-id=survey-1-1] .survey-answers').removeClass('pass-input');
        } else {
            $('.survey[data-id=survey-1-1]').css('display', 'none');
            $('.survey[data-id=survey-1-1] .survey-answers').addClass('pass-input');
            unCheckInput($('.survey[data-id=survey-1-1] .survey-answers .answer-item input'));
        }
    });
    
    // Câu số 4
    $('.survey[data-id=survey-4] .survey-answers input').on('change', function(e) {
        if ($(this).attr('data-check') == 'true') {
            $('.survey[data-id=survey-4-1]').css('display', 'block');
            $('.survey[data-id=survey-4-1] .survey-input').removeClass('pass-input');
            $('.survey[data-id=survey-4-2]').css('display', 'block');
            $('.survey[data-id=survey-4-2] .survey-answers').removeClass('pass-input');
        } else {
            $('.survey[data-id=survey-4-1]').css('display', 'none');
            $('.survey[data-id=survey-4-1] .survey-input').addClass('pass-input');
            unCheckInput($('.survey[data-id=survey-4-1] .survey-input .answer-item textarea'), 'textarea');
            $('.survey[data-id=survey-4-2]').css('display', 'none');
            $('.survey[data-id=survey-4-2] .survey-answers').addClass('pass-input');
            unCheckInput($('.survey[data-id=survey-4-2] .survey-answers .answer-item input'));
        }
    });

    // Câu số 7
    $('.survey[data-id=survey-7] .survey-answers input').on('change', function(e) {
        if ($(this).attr('data-check') == 'true') {
            $('.survey[data-id=survey-7-1]').css('display', 'block');
            $('.survey[data-id=survey-7-1] .survey-answers').removeClass('pass-input');
        } else {
            $('.survey[data-id=survey-7-1]').css('display', 'none');
            $('.survey[data-id=survey-7-1] .survey-answers').addClass('pass-input');
            unCheckInput($('.survey[data-id=survey-7-1] .survey-answers .answer-item input'));
        }
    });

    // Câu số 8
    $('.survey[data-id=survey-8] .survey-answers input').on('change', function(e) {
        if ($(this).attr('data-check') == 'true') {
            $('.survey[data-id=survey-8-1]').css('display', 'block');
            $('.survey[data-id=survey-8-1] .survey-answers').removeClass('pass-input');
            $('.survey[data-id=survey-8-2]').css('display', 'block');
            $('.survey[data-id=survey-8-2] .survey-answers').removeClass('pass-input');
        } else {
            $('.survey[data-id=survey-8-1]').css('display', 'none');
            $('.survey[data-id=survey-8-1] .survey-answers').addClass('pass-input');
            unCheckInput($('.survey[data-id=survey-8-1] .survey-answers .answer-item input'));
            $('.survey[data-id=survey-8-2]').css('display', 'none');
            $('.survey[data-id=survey-8-2] .survey-answers').addClass('pass-input');
            unCheckInput($('.survey[data-id=survey-8-2] .survey-answers .answer-item input'));
        }
    });
    $(window).on('load',function() {
        $('#survey-9-34').addClass('checkbox-diff');
        $('#survey-9-34').parents('.survey-answers').addClass('list-checkbox');
        $('#survey-10-41').addClass('checkbox-diff');
        $('#survey-10-41').parents('.survey-answers').addClass('list-checkbox');
        $('#survey-11-53').addClass('checkbox-diff');
        $('#survey-11-53').parents('.survey-answers').addClass('list-checkbox');
        $('#survey-13-64').addClass('checkbox-diff');
        $('#survey-13-64').parents('.survey-answers').addClass('list-checkbox');
        $('#survey-15-76').addClass('checkbox-diff');
        $('#survey-15-76').parents('.survey-answers').addClass('list-checkbox');
        
        let listdiffCheck = $(".list-checkbox input[type='checkbox']");
        listdiffCheck.each(function() {
            $(this).on('click', function() {
                if($(this).hasClass('checkbox-diff')) {
                    let listCheck = $(this).parent().siblings().find("input[type='checkbox']");
                    listCheck.prop('checked', false);
                } else {
                    let diffCheck =  $(this).parent().siblings().find("input[type='checkbox'].checkbox-diff");
                    diffCheck.prop('checked', false);
                }
            })
        })
    });
    
</script>
<?php
    require_once (VIEW_LAYOUT_DIR . '/footer.php');
?>