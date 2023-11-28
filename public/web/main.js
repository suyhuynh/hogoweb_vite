// let els_date = $('.date-picker');
// for (let el of els_date) {
//     let defaultDate=$(el).val()?$(el).val():(el.hasAttribute('no-default-date')?'':new Date());
//     $(el).flatpickr({
//         mode:'single',
//         altInput: true,
//         altFormat:'d-m-Y',
//         allowInput: true,
//         dateFormat: 'Y-m-d',
//         defaultDate: defaultDate
//     });
// }

function number_format (number, decimals, decPoint, thousandsSep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    const n = !isFinite(+number) ? 0 : +number
    const prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    const sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    const dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    let s = ''
    const toFixedFix = function (n, prec) {
        if (('' + n).indexOf('e') === -1) {
            return +(Math.round(n + 'e+' + prec) + 'e-' + prec)
        } else {
            const arr = ('' + n).split('e')
            let sig = ''
            if (+arr[1] + prec > 0) {
                sig = '+'
            }
            return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec)
        }
    }
    s = (prec ? toFixedFix(n, prec).toString() : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }
    return s.join(dec)
}
function resetAlertify () {
    alertify.set({
        labels : {
            ok     : "OK",
            cancel : "Cancel"
        },
        delay : 5000,
        buttonReverse : false,
        buttonFocus   : "ok"
    });
}
$(document).ready(function() {
    var data_class = $('.number-money');
    $.each(data_class, function(index, val) {
        $(val).val(number_format(val.value));
    });
    $('.number-money').bind('keydown keypress keyup paste input', function(event){
        this.value = this.value.replace(/[^0-9.]/g, '');
        this.value = number_format(this.value);
    });
    $('.number-only').bind('keydown keypress keyup paste input', function(event){
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('.number-float-only').on('keydown keypress keyup paste input', function () {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    });
    if($('form[data-form-contact]')){
        $('form[data-form-contact]').submit(function(event) {
            event.preventDefault();
            var type = $(this).attr('data-form-contact');
            $('#loader-wrapper').css('display', 'block');
            var form_data = $(this).serialize()+'&_token='+$('meta[name=csrf-token]').attr('content');
            $.ajax({
                url: '/contact',
                type: 'POST',
                data: form_data+'&type='+type,
            }).done(function(res) {
                resetAlertify();
                alertify.alert(res.msg);
                $("form[data-form-contact]")[0].reset();
                $('#loader-wrapper').css('display', 'none');
            });
        });
    }
    if($('#meta-time')){
        $('#meta-time').val($('title').text());
    }
    if($('.lazy').length){
        var myLazyLoad = new LazyLoad();
        myLazyLoad.update();
    }

});

AOS.init();
$("#back-top").click(function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
});
$(window).scroll(function() {
    if($(this).scrollTop() > 100) {
        $("#back-top").fadeIn();
    }else{
        $("#back-top").fadeOut();
    }
});
function showAloCall() {
    if ( $('.cool-alo-ph-img-circle36').hasClass("cool-down-img") ) {
        $('.cool-alo-ph-img-circle36').removeClass('cool-down-img');
        $('#alocool-actions').css({
            overflow: 'hidden',
            opacity: 0,
        });
    }else{
        $('.cool-alo-ph-img-circle36').addClass('cool-down-img');
        $('#alocool-actions').css({
            overflow: 'visible',
            opacity: 1,
        });
    }
}
$('#loader-wrapper').css('display', 'none');

if(!sessionStorage.getItem("popup") && (popup != null && popup.status == true)){
    setTimeout(function() { 
        sessionStorage.setItem("popup", true);
        SimpleLightbox.open({
            content: popup.content,
            elementClass: 'slbContentEl container-custom'
        });
    }, (popup.timeout * 1000));
}

if(!sessionStorage.getItem("exit_popup") && (exit_popup != null && exit_popup.status == true)){
    setTimeout(function() {
        sessionStorage.setItem("exit_popup", true);
        SimpleLightbox.open({
            content: exit_popup.content,
            elementClass: 'slbContentEl container-custom'
        });
    }, (exit_popup.timeout * 1000));
}

function converDataFile(string_base64)
{
    var e = {}, i, k, v = [], r = '', w = String.fromCharCode;
    var n = [[65, 91], [97, 123], [48, 58], [43, 44], [47, 48]];

    for (z in n)
    {
        for (i = n[z][0]; i < n[z][1]; i++)
        {
            v.push(w(i));
        }
    }
    for (i = 0; i < 64; i++)
    {
        e[v[i]] = i;
    }

    for (i = 0; i < string_base64.length; i+=72)
    {
        var b = 0, c, x, l = 0, o = string_base64.substring(i, i+72);
        for (x = 0; x < o.length; x++)
        {
            c = e[o.charAt(x)];
            b = (b << 6) + c;
            l += 6;
            while (l >= 8)
            {
                r += w((b >>> (l -= 8)) % 256);
            }
         }
    }
    return r;
}