$(function(){
    clickEffects();
    sendRegister();
    validate();
    scrollToElement();
    closePopup();
    AOS.init({
        duration: 650,
        once: true,
        offset: 0,
    });

    // document.addEventListener("contextmenu", function(e) {
    //     e.preventDefault();
    // }, false);
    // document.addEventListener("keydown", function(e) {
    //     //document.onkeydown = function(e) {
    //     // "I" key
    //     if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
    //         disabledEvent(e);
    //     }
    //     // "J" key
    //     if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
    //         disabledEvent(e);
    //     }
    //     // "S" key + macOS
    //     if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
    //         disabledEvent(e);
    //     }
    //     // "U" key
    //     if (e.ctrlKey && e.keyCode == 85) {
    //         disabledEvent(e);
    //     }
    //     // "F12" key
    //     if (event.keyCode == 123) {
    //         disabledEvent(e);
    //     }
    // }, false);

    // function disabledEvent(e) {
    //     if (e.stopPropagation) {
    //         e.stopPropagation();
    //     } else if (window.event) {
    //         window.event.cancelBubble = true;
    //     }
    //     e.preventDefault();
    //     return false;
    // }
});

function clickEffects(){
    var anchors = document.querySelectorAll('body')

    Array.prototype.forEach.call(anchors, function(anchor) {
        anchor.addEventListener('click', explode)
    })

    function explode(e) {
        [].map.call(anchors, function(el) {
            el.classList.toggle('active');
        });
        var x = e.clientX;
        var y = e.clientY;
        var c = document.createElement('canvas')
        var ctx = c.getContext('2d')
        var ratio = window.devicePixelRatio
        var particles = []
        
        document.body.appendChild(c)
        
        c.style.position = 'fixed'
        c.style.left = (x - 50) + 'px'
        c.style.top = (y - 50) + 'px'
        c.style.pointerEvents = 'none'
        c.style.width = 100 + 'px'
        c.style.height = 100 + 'px'
        c.style.zIndex = 999
        c.width = 100 * ratio
        c.height = 100 * ratio
        
        function Particle() {
            return {
                x: c.width / 2,
                y: c.height / 2,
                radius: 10,
                color: 'rgb(' + [r(100,255), r(100,255), r(100,255)].join(',') + ')',
                rotation: r(0,360, true),
                speed:4,
                friction: 0.9,
                // opacity: r(0,0.5, true),
                yVel: 0,
                gravity: 0
            }
        }
        
        for(var i=0; ++i<15;) {
            particles.push(Particle())
        }

        function render() {
            ctx.clearRect(0, 0, c.width, c.height)
            
            particles.forEach(function(p, i) {
                
                angleTools.moveOnAngle(p, p.speed)
                
                p.opacity -= 0.01
                p.speed *= p.friction
                p.radius *= p.friction
                
                p.yVel += p.gravity
                p.y += p.yVel
                
                if(p.opacity < 0) return
                if(p.radius < 0) return
                
                ctx.beginPath()
                ctx.globalAlpha = p.opacity
                ctx.fillStyle = p.color
                ctx.arc(p.x, p.y, p.radius, 0, 2 * Math.PI, false)
                ctx.fill()
            })
        }
        
        ;(function renderLoop(){
            requestAnimationFrame(renderLoop)
            render()
        })()
        
        setTimeout(function() {
            document.body.removeChild(c)
        }, 3000)
    }

    var angleTools = { getAngle: function (t, n) { var a = n.x - t.x, e = n.y - t.y; return Math.atan2(e, a) / Math.PI * 180 }, getDistance: function (t, n) { var a = t.x - n.x, e = t.y - n.y; return Math.sqrt(a * a + e * e) }, moveOnAngle: function (t, n) { var a = this.getOneFrameDistance(t, n); t.x += a.x, t.y += a.y }, getOneFrameDistance: function (t, n) { return { x: n * Math.cos(t.rotation * Math.PI / 180), y: n * Math.sin(t.rotation * Math.PI / 180) } } };
    function r(a, b, c) { return parseFloat((Math.random() * ((a ? a : 1) - (b ? b : 0)) + (b ? b : 0)).toFixed(c ? c : 0)); }
}

function sendRegister(){
    $('#sendMail').on('click', function(e, data){
        e.preventDefault();
        $('.popup-validate-error #msg').text('');
        var button = $(this);
       
        const rect = button[0].getBoundingClientRect();
        const center = {
            x: rect.left + rect.width / 2,
            y: rect.top + rect.height / 2,
        };
        const origin = {
            x: center.x / window.innerWidth,
            y: center.y / window.innerHeight,
        };
    
        // Canvas && confetti settings
        var myCanvas = $("<canvas></canvas>").appendTo("body");
        const defaults = {
            disableForReducedMotion: true,
        };
        var colors = ["#757AE9", "#28224B", "#EBF4FF"];
        var myConfetti = confetti.create(myCanvas[0], {});
    
        // Confetti function to be more realistic
        function fire(particleRatio, opts) {
            confetti(
                Object.assign({}, defaults, opts, {
                    particleCount: Math.floor(100 * particleRatio),
                })
            );
        }

        function validateVietnamesePhoneNumber(phoneNumber) {
            const phoneRegex = /^(0[0-9]{9,10})$/; // Số điện thoại tại Việt Nam bắt đầu bằng số 0 và có độ dài từ 10 đến 11 chữ số
        
            if (phoneRegex.test(phoneNumber)) {
                return true; // Số điện thoại hợp lệ theo định dạng Việt Nam
            } else {
                return false; // Số điện thoại không hợp lệ
            }
        }
        var str = $('#phone').val();
        var form = $('form'),
            data = form.serialize();
        if (!validateVietnamesePhoneNumber(str)) {
            $('#phone').css("border-color", "red");
            $('.err').text('Số điện thoại không hợp lệ theo định dạng Việt Nam');
        }else{
            $.ajax({
                type: "POST",
                url: '/run-gulliver/bhd-fanmeeting/send.asp',
                headers: {"Authorization": "Kilala SG9Hb1dlYiBIdeG7s25oIE5n4buNYyBTdXkgMDkzMTE1NjgxOA=="},
                data: data,
                success: function (res) {
                    if (res.success) {
                        button.addClass("loading");
                        // Finished state confetti
                        setTimeout(function () {
                            button.attr("class", "btn btn-primary success");
                            fire(0.25, {
                                spread: 26,
                                startVelocity: 20,
                                origin: origin,
                                colors: colors,
                            });
                            fire(0.2, {
                                spread: 60,
                                startVelocity: 25,
                                origin: origin,
                                colors: colors,
                            });
                            fire(0.35, {
                                spread: 100,
                                startVelocity: 25,
                                decay: 0.91,
                                origin: origin,
                                colors: colors,
                            });
                            fire(0.1, {
                                spread: 120,
                                startVelocity: 10,
                                decay: 0.92,
                                origin: origin,
                                colors: colors,
                            });
                            fire(0.1, {
                                spread: 120,
                                startVelocity: 30,
                                origin: origin,
                                colors: colors,
                            });
                        }, 2000);
    
                        // Finished state confetti
                        setTimeout(function () {
                            button.attr("class", "btn btn-primary aos-animate aos-init");
                        }, 2000);
    
                        setTimeout(function () {
                            $('.overlay-popup').fadeIn();
                            $('.popup-checkform.form').fadeIn();
                            $('body').css('overflow', 'hidden');
                            $(form)[0].reset();
                            $('#phone').css("border-color", "#FAF9F8");
                        }, 2500);
                    }else {
                        if (res.error) {
                            $('.popup-validate-error #msg').text(res.error);
                            $('.overlay-popup').fadeIn();
                            $('.popup-validate-error').fadeIn();
                        } else {
                            validate();
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorMessage) {
                    $('.overlay-popup').fadeIn();
                    $('.popup-checkform-error').fadeIn();
                },
            });
        }
    })
}

function closePopup(){
    $('.overlay-popup').on('click', function() {
        $(this).fadeOut();
        $('.popup-checkform').fadeOut();
        $('body').css('overflow', '');
    });
    $('.close').on('click', function() {
        $('.overlay-popup').fadeOut();
        $('.popup-checkform').fadeOut();
        $('body').css('overflow', '');
    });
}

function validate(){

    $(".register-form").validate({
        rules: {
            fullname: {
                required: true,
                minlength: 4
            },     
            email: {
                required: true,
                email:true
            },
            email_conform: {
                required: true,
                equalTo: "#email"
            },
            phone: {
                required: true,
                minlength: 10
            },
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
      });

    $('#phone').on('keyup', function() {
        $('.err').text('')
        var val = this.value;
        var newStr = '';
        for (var i = 0; i < val.length; i++) {
            var character = val.charAt(i);
            var regex = new RegExp('[\+0-9]', '');
            if (regex.test(character)) {
                newStr += character;
            }
        }
        $('#phone').val(newStr);
    });


    $(".js-checkClass input").on('input change', function() {
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

        var totalCheckClass = $(".js-checkClass").length;
        var totalActive = $(".js-checkClass.active").length;
        var $button = $("#sendMail");

        if (totalCheckClass === totalActive) {
            $button.removeClass('disabled');
        } else {
            $button.addClass('disabled');
        }
    });
}

/* ============================================================
    Scroll To
  ============================================================ */
  function scrollToElement() {
    $('a[href^="#"]').on("click", function (e) {
      e.preventDefault();
      const el = $(this).attr("href");
      if ($(el).length > 0) {
        headerH = 0;
        const scrollTop = $(el).offset().top - headerH;
        $("html, body").animate({ scrollTop: scrollTop });
      }
    });
  }

$(window).on("scroll", function () {
    var scroll = $(window).scrollTop();
    $(".line").each(function () {
        var ePos = $(this).offset().top;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll > ePos - windowHeight - 180) {
            $(this).addClass("animationTrigger--active");
            $(this).delay(50).queue(function () {
                $(this).addClass("animationTrigger--active");
                $(this).dequeue();
            });
        }
    });

    $(".heading").each(function () {
        var ePos = $(this).offset().top;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll > ePos - windowHeight) {
            $(this).addClass("active");
        }
    });
});