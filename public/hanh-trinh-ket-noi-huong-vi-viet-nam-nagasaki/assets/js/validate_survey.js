$(function(){
    let parentElm = $('#survey')
    if(typeof(parentElm) != "undefined" && parentElm !== null) {
        let parentInput = $(".survey-answers");
        let textArea = $(".survey-input .answer-item textarea");
        parentInput && parentInput.on('click', function() {
            if (isChecked($(this))) {
                $(this).addClass("input-checked");
                $(this).siblings(".question").find('p').css("color", "#323130");
            } else {
                $(this).removeClass("input-checked");
            }
        });
        textArea && textArea.on('keydown', function() {
            if (isChecked($(this).parents('.survey-input'))) {
                $(this).parents('.survey-input').addClass("input-checked");
                $(this).parents('.survey-input').siblings(".question").find('p').css("color", "#323130");
            } else {
                $(this).parents('.survey-input').removeClass("input-checked");
            }
        });
        let checkBtn = $('#submit-survey');
        checkBtn && checkBtn.on('click', function(e) {
            e.preventDefault();
            $(this).addClass('loading');
            isAllChecked($(".survey-input"));
            isAllChecked($(".survey-answers"));
            if ( !isAllChecked($(".survey-input")) && !isAllChecked($(".survey-answers"))) {
                $(this).fadeOut();
                $('.after-degree').fadeIn();
                $('.after-degree').css('display', 'flex');
                $('.form-check').addClass('disabled');
                $('.form-group').addClass('disabled');
                let inputs = $('.survey-answers');
                inputs && inputs.each(function() {
                    let _this = $(this);
                    $(this).siblings('.survey-selected').html('');
                    _this.find('input').each(function() {
                        if($(this).is(':checked')) {
                            let itemSelected = $(this).siblings('.form-check-label');
                            $(this).parents('.survey-answers').siblings('.survey-selected').append('<p> -' + itemSelected.html() + '</p>') ;
                        }
                    });
                });
                $([document.documentElement, document.body]).animate({
                    scrollTop: $(".tab-contents").offset().top
                }, 500);
                $('.overlay-popup').fadeIn();
                $('.popup-checkform').fadeIn();
                $('.survey-answers').fadeOut();
                $('.survey-selected').fadeIn();
                $('body').css('overflow', 'hidden');
            }

            setTimeout(function(){
                $('button').removeClass('loading');
            }, 1000);
        });
        $('.overlay-popup').on('click', function() {
            $(this).fadeOut();
            $('.popup-checkform').fadeOut();
            $('body').css('overflow', '');
        });
        $('.popup-close-btn').on('click', function() {
            $('.overlay-popup').fadeOut();
            $('.popup-checkform').fadeOut();
            $('body').css('overflow', '');
        });
        let clearInput = $('#clear-survey');
        clearInput && clearInput.on('click', function(e) {
            e.preventDefault();
            $('#submit-survey').fadeIn();
            $('.after-degree').fadeOut();
            $('.survey-answers').fadeIn();
            $('.survey-selected').fadeOut();
            $('.form-check').removeClass('disabled');
            $('.form-group').removeClass('disabled');
            isAllChecked($(".survey-input"));
            isAllChecked($(".survey-answers"));
            if ( !isAllChecked($(".survey-input")) && !isAllChecked($(".survey-answers"))) {
                $([document.documentElement, document.body]).animate({
                    scrollTop: $(".tab-contents").offset().top
                }, 500);
            }
        });
        
        let submitBtn = $('#submit-survey-send');
        submitBtn && submitBtn.on('click', function(e) {
            e.preventDefault()
            $(this).addClass('loading');
            let form = $(this).parents('form'),
                data = form.serialize();
            let ajaxtDefault = {
                type: form.attr('method'),
                url: form.attr('action'),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: data,
                // enctype: 'multipart/form-data',
                cache: true,
                success: function(res) {
                    if (res.url) {
                        window.location.replace(res.url);
                    }
                },
                error: function (res) {
                    alert('Lỗi rồi bạn ơi!!!')
                }
            };
            $.ajax(ajaxtDefault);

            setTimeout(function(){
                $('button').removeClass('loading');
            }, 1000);
        })
    }
});

function isChecked(_class) {
    let inputs = _class.find('input');
    let textarea = _class.find('textarea');
    let isActive = false;
    inputs && inputs.each(function( index ) {
        if($(this).is(':checked')) {
            isActive = true;
            return false;
        }
    });
    textarea && textarea.each(function( index ) {
        if(($(this).val()).length >= 1) {
            isActive = true;
            return false;
        }
    });
    return isActive;
}

function isAllChecked(_class) {
    let isActive = false;
    let time = 1;
    $(".question").removeClass('fist-error');
    _class.each(function( index ) {
        if(!$(this).hasClass("pass-input")) {
            if(!$(this).hasClass("input-checked")) {
                $(this).siblings(".question").find('p').css("color", "red");
                if(time === 1 ) {
                    $(this).siblings(".question").addClass('fist-error');
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $(".fist-error").offset().top
                    }, 500);
                    time++
                }
            }
        }
    });
    
    _class.each(function( index ) {
        if(!$(this).hasClass("pass-input")) {
            if(!$(this).hasClass("input-checked")) {
                isActive = true;
                return false;
            }
        }
    });
    return isActive;
}

