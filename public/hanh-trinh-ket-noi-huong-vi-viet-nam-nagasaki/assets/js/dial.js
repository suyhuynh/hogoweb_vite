"use strict";

function isIE() {
    var i = navigator.userAgent;
    return -1 < i.indexOf("MSIE ") || -1 < i.indexOf("Trident/");
}
function disabledGoals(type) {
    let toggleGoals = $(".toggle-goals");
    toggleGoals && toggleGoals.each(function() {
        if(!$(this).hasClass('active')) {
            if(type === 'add') {
                $(this).addClass('disabled');
            }
            if(type === 'remove') {
                $(this).removeClass('disabled');
            }
        }
    })
}
var code =
    "f e d c b a 9 8 7 6 5 4 3 2 1 0 f e d c b a 9 8 7 6 5 4 3 2 1 0 f e d c b a 9 8 7 6 5 4 3 2 1 0 f e d c b a 9 8 7 6 5 4 3 2 1 0 f e d c b a 9 8 7 6 5 4 3 2 1 0 f e d c b a 9 8 7 6 5 4 3 2 1 0 f e d c b a 9 8 7 6 5 4 3 2 1 0 f e d c b a 9 8 7 6 5 4 3 2 1 0 f e d c b a 9 8 7 6 5 4 3 2 1 0 f e d c b a 9 8 7 6 5 4 3 2 1 0 ",
    random = "random",
    counter = 0,
    count = null,
    random_code = "",
    luckyMan;
$(document).ready(function() {
    // document.addEventListener("contextmenu", function(e) {
    //     e.preventDefault();
    // }, false);
    //disable inspect
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
    // };

    $('.toggle-goals').on('click', function() {
        $('.toggle-goals').removeClass('active');
        $(this).addClass('active');
        $('.button--random').removeClass('disabled');
    });

    $(".button--random").click(function() {
        $(this).addClass("disabled"),
        $(".button--stop").removeClass("disabled"),
        $(".toggle-goals.active").css({ "pointer-events": "none" }),
        clearInterval(count),
        (counter = 0),
        (count = setInterval(function() {
            ++counter;
        }, 1e3));
        disabledGoals('add');
        
        $.ajax({
            type: "POST",
            url: $(this).attr("data-url"),
            headers: {"Authorization": "Kilala SG9Hb1dlYiBIdeG7s25oIE5n4buNYyBTdXkgMDkzMTE1NjgxOA=="},
            // data: { random: random },
            success: function(res) {
                var listCode = res.codes,
                    luckyCode = listCode[Math.floor(Math.random() * listCode.length)];
                (random_code = luckyCode),
                luckyMan = res.data[luckyCode];
                $('.name-champ').html(luckyMan.fullname);
                $('.code-champ').html(luckyMan.code);
                $('.phone-champ').html(luckyMan.phone)
                $(".odometer").html(""),
                $(".odometer").append(
                    '<div class="digit digit--start"> <div class="digit-container digit-ten-million">' +
                    luckyCode.charAt(0) +
                    " " +
                    code +
                    "</div> </div>"
                ),
                $(".odometer").append(
                    '<div class="digit digit--start"> <div class="digit-container digit-million">' +
                    luckyCode.charAt(1) +
                    " " +
                    code +
                    "</div> </div>"
                ),
                $(".odometer").append(
                    '<div class="digit digit--start"> <div class="digit-container digit-hundred-thousand">' +
                    luckyCode.charAt(2) +
                    " " +
                    code +
                    "</div> </div>"
                ),
                $(".odometer").append(
                    '<div class="digit digit--start"> <div class="digit-container digit-ten-thousand">' +
                    luckyCode.charAt(3) +
                    " " +
                    code +
                    "</div> </div>"
                ),
                $(".odometer").append(
                    '<div class="digit digit--start"> <div class="digit-container digit-thousand">' +
                    luckyCode.charAt(4) +
                    " " +
                    code +
                    "</div> </div>"
                ),
                $(".odometer").append(
                    '<div class="digit digit--start"> <div class="digit-container digit-hundred">' +
                    luckyCode.charAt(5) +
                    " " +
                    code +
                    "</div> </div>"
                );
                // $(".odometer").append(
                //     '<div class="digit digit--start"> <div class="digit-container digit-ten">' +
                //     e.charAt(6) +
                //     " " +
                //     code +
                //     "</div> </div>"
                // ),
                // $(".odometer").append(
                //     '<div class="digit digit--start"> <div class="digit-container digit-one">' +
                //     e.charAt(7) +
                //     " " +
                //     code +
                //     "</div> </div>"
                // );
            },
        });
    }),
    $(".button--stop").click(function() {
        $(this).addClass("disabled");
        var i = this;
        clearInterval(count);
        for (
            var t = new Array(
                    counter + 23,
                    counter + 20,
                    counter + 17,
                    counter + 14,
                    counter + 11,
                    counter + 8,
                    counter + 5,
                    counter + 2
                ),
                e = 0; e < 8; e++
        )
            t[e] = t[e].toString() + "s";
        $(
                ".digit-container.digit-ten-million,.digit-container.digit-million,.digit-container.digit-hundred-thousand,.digit-container.digit-ten-thousand,.digit-container.digit-thousand,.digit-container.digit-hundred,.digit-container.digit-ten,.digit-container.digit-one"
            )
            .parents(".digit--start")
            .removeClass("digit--start"),
            isIE() ||
            ($(".digit-container.digit-ten-million").css({
                    "-webkit-animation": "slide " + t[0] + " 1 ease-out",
                    animation: "slide " + t[0] + " 1 ease-out",
                    "-moz-animation:": "slide " + t[0] + " 1 ease-out",
                    "-o-animation:": "slide " + t[0] + " 1 ease-out",
                }),
                $(".digit-container.digit-million").css({
                    "-webkit-animation": "slide " + t[1] + " 1 ease-out",
                    animation: "slide " + t[1] + " 1 ease-out",
                    "-moz-animation:": "slide " + t[1] + " 1 ease-out",
                    "-o-animation:": "slide " + t[1] + " 1 ease-out",
                }),
                $(".digit-container.digit-hundred-thousand").css({
                    "-webkit-animation": "slide " + t[2] + " 1 ease-out",
                    animation: "slide " + t[2] + " 1 ease-out",
                    "-moz-animation:": "slide " + t[2] + " 1 ease-out",
                    "-o-animation:": "slide " + t[2] + " 1 ease-out",
                }),
                $(".digit-container.digit-ten-thousand").css({
                    "-webkit-animation": "slide " + t[3] + " 1 ease-out",
                    animation: "slide " + t[3] + " 1 ease-out",
                    "-moz-animation:": "slide " + t[3] + " 1 ease-out",
                    "-o-animation:": "slide " + t[3] + " 1 ease-out",
                }),
                $(".digit-container.digit-thousand").css({
                    "-webkit-animation": "slide " + t[4] + " 1 ease-out",
                    animation: "slide " + t[4] + " 1 ease-out",
                    "-moz-animation:": "slide " + t[4] + " 1 ease-out",
                    "-o-animation:": "slide " + t[4] + " 1 ease-out",
                }),
                $(".digit-container.digit-hundred").css({
                    "-webkit-animation": "slide " + t[5] + " 1 ease-out",
                    animation: "slide " + t[5] + " 1 ease-out",
                    "-moz-animation:": "slide " + t[5] + " 1 ease-out",
                    "-o-animation:": "slide " + t[5] + " 1 ease-out",
                }),
                $(".digit-container.digit-ten").css({
                    "-webkit-animation": "slide " + t[6] + " 1 ease-out",
                    animation: "slide " + t[6] + " 1 ease-out",
                    "-moz-animation:": "slide " + t[6] + " 1 ease-out",
                    "-o-animation:": "slide " + t[6] + " 1 ease-out",
                }),
                $(".digit-container.digit-one").css({
                    "-webkit-animation": "slide " + t[7] + " 1 ease-out",
                    animation: "slide " + t[7] + " 1 ease-out",
                    "-moz-animation:": "slide " + t[7] + " 1 ease-out",
                    "-o-animation:": "slide " + t[7] + " 1 ease-out",
                }));
        var a = 1 * t[(counter = 0)].replace("s", "") + 1 + "e3",
            d = $(".js-select input:checked").val();
        setTimeout(function() {
            $("#win-" + d).html(random_code),
                $(i).addClass("disabled"),
                $(".button--random").removeClass("disabled"),
                $(".js-select").css({ "pointer-events": "" });
                var b = random_code.charAt(0) + random_code.charAt(1) + random_code.charAt(2) + random_code.charAt(3) + random_code.charAt(4) + random_code.charAt(5) + random_code.charAt(6) + random_code.charAt(7);
                $('#win-iphone13').text(b);
                if(!$(".toggle-goals.disabled").hasClass('spun')) {
                    disabledGoals('remove');
                }
                let toggleGoals = $('.toggle-goals.active')
                if(toggleGoals.attr('id') === 'special-goals') {
                    $('.special-code').html(luckyMan.code);
                    $('#audio-tab audio')[0].play();
                    $('.goals-champ').html('iPhone 15 (128GB)');
                    $('.congratulate').fadeIn();
                    $('.congratulate').css('display', 'flex');
                    $('#special-goals').addClass('spun');
                    $('#special-goals').addClass('disabled');
                    $('.button--random').addClass('disabled');
                    $('#special-goals').removeClass('active');
                } else if (toggleGoals.attr('id') === 'first-goals') {
                    $('.first-code').html(luckyMan.code);
                    $('.goals-champ').html('Túi Motherhouse');
                    $('#audio-tab audio')[0].play();
                    $('.congratulate').fadeIn();
                    $('.congratulate').css('display', 'flex');
                    $('#first-goals').addClass('spun');
                    $('#first-goals').addClass('disabled');
                    $('.button--random').addClass('disabled');
                    $('#first-goals').removeClass('active');
                }
                for(let i = 0; i <= 3; i++) {
                    
                }
                var count = 1;
                function transition() {
                    if(count == 1) {
                        $('.congratulations').fadeIn();
                        $('.congratulations').html("<dotlottie-player class='loop1' src='https://lottie.host/eefb0c72-c5de-4800-8907-52f3a9e5e139/hanBNunTlR.json' background='transparent' speed='1' style='width: 100%; height: 100%;' loop autoplay></dotlottie-player>");
                        count = 2;
                    } else if(count == 2) {
                        $("<dotlottie-player class='loop2' src='https://lottie.host/eefb0c72-c5de-4800-8907-52f3a9e5e139/hanBNunTlR.json' background='transparent' speed='1' style='width: 100%; height: 100%;' loop autoplay></dotlottie-player>").insertAfter('.loop1');
                         count = 3;
                
                    } else if(count == 3) {
                        $("<dotlottie-player class='loop3' src='https://lottie.host/eefb0c72-c5de-4800-8907-52f3a9e5e139/hanBNunTlR.json' background='transparent' speed='1' style='width: 100%; height: 100%;' loop autoplay></dotlottie-player>").insertAfter('.loop2');
                        count = 4;
                    } else if(count == 4) {
                        $("<dotlottie-player class='loop4' src='https://lottie.host/eefb0c72-c5de-4800-8907-52f3a9e5e139/hanBNunTlR.json' background='transparent' speed='1' style='width: 100%; height: 100%;' loop autoplay></dotlottie-player>").insertAfter('.loop3');
                        count = 5;
                    } else {
                        clearInterval(interval)
                        count = 1;
                    }
                };
                const interval = setInterval(transition, 1000);
                
        }, 24e3);
        var b = a - 33e2;
        $('.close-popup').on('click', function() {
            $('.congratulations').html("");
            $('.congratulations').fadeOut();
            $('.congratulate').fadeOut();
            $('#audio-tab audio')[0].pause();
            $('#audio-tab audio')[0].currentTime = 0;
        });
        $('.congratulate .overlay').on('click', function() {
            $('.congratulations').html("");
            $('.congratulations').fadeOut();
            $('.congratulate').fadeOut();
            $('#audio-tab audio')[0].pause();
            $('#audio-tab audio')[0].currentTime = 0;
        })
        setTimeout(function() {
            $(".lottie-player").addClass("open");
            $('body').trigger('click')
        }, 24e3);

        var c = a - 75e2;
        var d = a - 7e3;
        var e = a - 6e3;
        var f = a - 65e2;
        var g = a - 6e3;
        var h = a - 4e3;
        var i = a - 35e2;
        var k = a - 3e3;
        var l = a - 29e2;
        var m = a - 28e2;

        // setTimeout(function() {
        //     $('#audio-tab audio')[0].volume = 0.4;
        // }, c);
        // setTimeout(function() {
        //     $('#audio-tab audio')[0].volume = 0.35;
        // }, d);
        // setTimeout(function() {
        //     $('#audio-tab audio')[0].volume = 0.3;
        // }, e);
        // setTimeout(function() {
        //     $('#audio-tab audio')[0].volume = 0.25; 
        // }, f);
        // setTimeout(function() {
        //     $('#audio-tab audio')[0].volume = 0.2;
        // }, g);
        // setTimeout(function() {
        //     $('#audio-tab audio')[0].volume = 0.15;
        // }, h);
        // setTimeout(function() {
        //     $('#audio-tab audio')[0].volume = 0.1;
        // }, i);
        // setTimeout(function() {
        //     $('#audio-tab audio')[0].volume = 0.05;
        // }, k);
        // setTimeout(function() {
        //     $('#audio-tab audio')[0].volume = 0.03;
        // }, l);
        // setTimeout(function() {
        //     $('#audio-tab audio')[0].volume = 0;
        // }, m);
    });
});
//# sourceMappingURL=result.min.js.map