$(function(){

    function validateVietnamesePhoneNumber(phoneNumber) {
        const phoneRegex = /^(0[0-9]{9,10})$/;
    
        if (phoneRegex.test(phoneNumber)) {
            return true;
        } else {
            return false;
        }
    }
    function checkCheckbox() {
        let a = false;
        $("input[type='checkbox']").each(function() {
            if ($(this).is(":checked")) {
                a = true;
            }
        });
        return a;
    }

    if($('#register')) {
        var inputs = {
            'phone': $('input[name="phone"]'),
            'email': $('input[name="email"]'),
            'fullname': $('input[name="fullname"]')
        };

        var validatePhoneNumber = (input_str) => /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(input_str);
        var checkEmpty = (input) => input.val() === '';
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

        $('#phone').on('keyup', function() {
            var val = this.value;
            var newStr = '';
            inputs['phone'].css("border-color", validatePhoneNumber($('#phone').val()) ? "#C8C6C4" : "red");
            for (var i = 0; i < val.length; i++) {
                var character = val.charAt(i);
                var regex = new RegExp('[\+0-9]', '');
                if (regex.test(character)) {
                    newStr += character;
                }
            }

            $('#phone').val(newStr);
            if (!validateVietnamesePhoneNumber(newStr)) {
                $(this).css("border-color", "red");
            }
        });

        $('#name').on('keyup', function(e) {
            e.preventDefault();
            inputs['fullname'].css("border-color", checkEmpty($('#name')) ? "red" : "#C8C6C4");
        });

        $('#email').on('keyup', function(e) {
            e.preventDefault();
            inputs['email'].css("border-color", filter.test(inputs['email'].val()) ? "#C8C6C4" : "red");
        });

        $('#submit-register').on('click', function(e) {
            e.preventDefault();
            $(this).addClass('loading');
            $(this).fadeOut();
            let textInput = $('.js-Text');
            textInput && textInput.find('input').addClass('disabled').fadeOut();
            textInput && textInput.each(function() {
                let _this = $(this)
                _this.find('input').each(function() {
                    let itemSelected = $(this).val();
                    $(this).parents('.js-Text').find('.survey-selected').html('');
                    $(this).parents('.js-Text').find('.survey-selected').append('<p> - ' + itemSelected + '</p>') ;
                });
            });
            let checkInput = $('.js-Check')
            checkInput && checkInput.each(function() {
                let _this = $(this);
                _this.find('.js-checkClass').addClass('disabled').fadeOut();
                _this.find('.survey-selected').html('');
                _this.find('input').each(function() {
                    if($(this).is(':checked')) {
                        let itemSelected = $(this).siblings('.form-check-label').html();
                        console.log(itemSelected);
                        $(this).parents('.js-Check').find('.survey-selected').append('<p> -' + itemSelected + '</p>') ;
                    }
                });
            });

            $('.survey-selected').fadeIn();
            $('#register').find(".form-control input")
            setTimeout(function(){
                $('#submit-register').removeClass('loading');
            }, 1000);
            $([document.documentElement, document.body]).animate({
                scrollTop: $(".tab-contents").offset().top
            }, 500);
            $(".after-degree").fadeIn();
            $('.overlay-popup').fadeIn();
            $('.popup-checkform').fadeIn();
            $('body').css('overflow', 'hidden');
        });

        
        let clearInput = $('#clear-register');
        clearInput && clearInput.on('click', function(e) {
            e.preventDefault();
            $('#submit-register').fadeIn();
            $('.after-degree').fadeOut();
            let textInput = $('.js-Text');
            textInput && textInput.find('input').removeClass('disabled').fadeIn();
            let checkInput = $('.js-Check');
            checkInput && checkInput.find('.js-checkClass').removeClass('disabled').fadeIn();
            $('.survey-selected').fadeOut();
            $([document.documentElement, document.body]).animate({
                scrollTop: $(".tab-contents").offset().top
            }, 500);
        });

        let submitBtn = $('#submit-register-send');
        submitBtn && submitBtn.on('submit', function(e) {
            e.preventDefault()
            $(this).addClass('loading');
            setTimeout(function(){
                $('#submit-register-send').removeClass('loading');
            }, 1000);
            console.log();
            $('#submit-register-send').parents('form').submit();
        })
        let rangeNum = 1;
        $(".js-checkClass input").on('input change', function() {
            console.log($(this).attr('type'));
            var $parent = $(this).closest('.js-checkClass');
            if ($(this).is(":text") || $('#email').val() !== '' || $('#phone').val() !== '') {
                if ($(this).val().trim() !== '') {
                    $parent.addClass('active');
                } else {
                    $parent.removeClass('active');
                }
            } else if ($(this).is(":radio")) {
                if ($(this).is(":checked")) {
                    $parent.addClass('active');
                } else {
                    $parent.removeClass('active');
                }
            } 

            if ($('.list-checkbox input').is(":checked")) {
                $('.list-checkbox input').parents('.js-checkClass').addClass('active');
            } else {
                $('.list-checkbox input').parents('.js-checkClass').removeClass('active');
            }

            

            var totalCheckClass = $(".js-checkClass").length;
            var totalActive = $(".js-checkClass.active").length;
            // console.log('a', totalCheckClass);
            // console.log('b', totalActive);
            var $button = $("#submit-register");
    
            if (totalCheckClass === totalActive) {
                $button.removeClass('disabled');
            } else {
                $button.addClass('disabled');
            }
        });
        let listdiffCheck = $(".list-checkbox input[type='checkbox']");
        listdiffCheck.each(function() {+
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
        
    }
});