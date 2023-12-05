$(function(){
    $('.tab').on('click', function(e){
        e.preventDefault();
		var tabId = $(this).children().attr('href');
        $(".tab-content").removeClass("is-active");
        $(this).addClass('is-active').siblings().removeClass('is-active');
        $(tabId).addClass("is-active");
	});

    $('#tab-button').on('click', function(e){
        e.preventDefault();
        $('.tab').trigger('click');
        $([document.documentElement, document.body]).animate({
            scrollTop: $(".tab-contents").offset().top
        }, 500);
		// var tabId = $(this).attr('href');
        // $(".tab-content").removeClass("is-active");
        // $(this).addClass('is-active').siblings().removeClass('is-active');
        // $(tabId).addClass("is-active");
	})
})