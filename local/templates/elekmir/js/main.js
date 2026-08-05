var runAjaxSearch = false;
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(('[\w-\s]+')|([\w-]+(?:\.[\w-]+)*)|('[\w-\s]+')([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

function get_cookie ( cookie_name )
{
    var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );

    if ( results )
        return ( unescape ( results[2] ) );
    else
        return null;
}

function delCookie(name) {
    document.cookie = name + "=" + "; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT";
}

function setCookie(c_name, c_value, c_date){
    const name = c_name;
    const value = c_value;
    const expires = (c_date ? c_date : '3600');
    const path = '/';
    const domain = '';
    const secure = '';

    document.cookie = name + '=' + escape(value) +
        ((expires) ? '; expires=' + expires : '') +
        ((path) ? '; path=' + path : '') +
        ((domain) ? '; domain=' + domain : '') +
        ((secure) ? '; secure' : '');
}

function acceptCookie(){
    $('.b-cookie').fadeOut();
    let dateCookie = new Date(new Date().setFullYear(new Date().getFullYear() + 1)).toUTCString();
    setCookie('cookie-accept', 1, dateCookie);
}

function compare_tov(id){
    var elementCompare = document.getElementById('compareid_'+id);
    if (!elementCompare.classList.contains('catalog-item__favorite-active'))
    {
        $.get("/local/ajax/list_compare.php",
            {action: "ADD_TO_COMPARE_LIST", id: id},
            function(data) {
                $(".js-compare-cnt").text(data);
            }
        );
        elementCompare.classList.add('catalog-item__favorite-active');
    }
    else
    {
        $.get("/local/ajax/list_compare.php",
            {action: "DELETE_FROM_COMPARE_LIST", id: id},
            function(data) {
                $(".js-compare-cnt").text(data);
            }
        );
        elementCompare.classList.remove('catalog-item__favorite-active');
    }
}

function morph(n, f1, f2, f5) {
    n = Math.abs(parseInt(n)) % 100;
    if (n>10 && n<20) return f5;
    n = n % 10;
    if (n>1 && n<5) return f2;
    if (n==1) return f1;
    return f5;
}

function formatNum(str) {
    var retstr = '';
    var now = 0; console.log(str);
    for (let i = str.length - 1; i >= 0; i--) {
        if (now < 3) {
            now++;
            retstr = str.charAt(i) + retstr;
        } else {
            now = 1;
            retstr = str.charAt(i) + ' ' + retstr;
        }
    }
    return retstr;
}

function countCatalog(event, id, num, cart= false){
    event.preventDefault();
    let $this = $('#quantity-'+id);
    let thisCnt = 1;
    if(parseInt($this.val())+parseInt(num) > 0){
        thisCnt = parseInt($this.val())+parseInt(num);
        $this.val(thisCnt);
    }
    let zakaz = get_cookie('zakaz');
    let zakazK = get_cookie('zakazK');
    let arZakaz = '';
    let arZakazK = '';
    let sum = 0;
    let cnt = 0;
    if(zakaz.length > 0 && zakazK.length > 0){
        arZakaz = zakaz.split(';');
        arZakazK = zakazK.split(';');
        let data = {
            AJAX: "Y",
            zakaz: zakaz
        };
        $.ajax({
            url: "/ajax/",
            type: 'POST',
            cache: false,
            dataType: 'json',
            data: data,
            beforeSend: function () {},
            success: function (dataAjax) {
                if(dataAjax.result && dataAjax?.data.length > 0){
                    dataAjax.data.forEach((item,i) => {
                        if(item["Info_ID"]){

                            if(item["Info_ID"] == id){
                                if($('#js-cart-price-'+id)){
                                    $('#js-cart-price-'+id).text(thisCnt*(item["PriceNew"] ? item["PriceNew"] : item["Price"]));
                                }
                                sum += (thisCnt*(item["PriceNew"] ? item["PriceNew"] : item["Price"]));
                                arZakazK[i] = thisCnt;
                            } else {
                                sum += (arZakazK[i]*(item["PriceNew"] ? item["PriceNew"] : item["Price"])); //console.log(item, arZakazK[i]);
                            }
                        }
                    });
                    $('.js-cart-summ').text(+sum.toFixed(2));
                    console.log(arZakazK);
                    setCookie('zakazK', arZakazK.join(";"));
                }
            },
            error: function (dataAjax) {}
        });

    }

    return false;
}

function searchAjax(){
    let $this = $(this);
    if(runAjaxSearch){
        clearTimeout(runAjaxSearch);
    }
    runAjaxSearch = setTimeout(function(){
        const data = {
            AJAX: "Y",
            searchdata: $this.val()
        };
        $.ajax({
            url: "/search-ajax/",
            type: 'GET',
            cache: false,
            dataType: 'html',
            data: data,
            beforeSend: function () {},
            success: function (dataAjax) {
                $('.js-search-content').html(dataAjax);
                $('.search-result-box').fadeIn();
            },
            error: function (data) {}
        });
    }, 500);
}

function changeFile(el) {
    let val = el.value;
    if(val) {
        var valArr = val.split('\\');
        el.closest('.form-group-file').find('.file-text').text(valArr[valArr.length - 1]);
    } else {
        el.closest('.form-group-file').find('.file-text').text('Прикрепить файл');
    }
}

$(document).ready(function(){
    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $('.topcontrol').fadeIn();
        } else {
            $('.topcontrol').fadeOut();
        }
    });

    $('.cbh-box-c').click(function(){
        window.location='https://max.ru/u/f9LHodD0cOKZEFIgiyFxTkv9c_vKLBgPmgWTIsMAvdDx5Kq1e5EmrU5Lni8';
    });

    $(document).on('click', '.js-favorite', function(e) {
        e.preventDefault();
        let arrMatch = $(this).attr("id").match(/\d+/);

        $.post("/local/ajax/favorite.php",
            {'id': arrMatch[0], 'sessid': BX.bitrix_sessid()},
            function(data) {
                const rs = JSON.parse(data);
                $('.js-favorite-cnt').text(rs.cnt);
            }
        );
        $(this).toggleClass('catalog-item__favorite-active');
    });

    if($('.js-favorite').length > 0){
        $.post("/local/ajax/favorite.php",
            {'getList': true, 'sessid': BX.bitrix_sessid()},
            function(data) {
                var rs = JSON.parse(data);
                if(rs.favorite.length > 0){
                    rs.favorite.forEach(item => {
                        $('#FAVORITE_'+item).addClass('catalog-item__favorite-active');
                    });

                }
            }
        );
    }

    $(document).on('click', '.js-search-close', function() {
        $(this).closest('.js-search-content').empty();
    });

    $(document).on('input', '.js-search', function() {
        let $this = $(this);
        let func = searchAjax.bind($this);
        func();
    });

    $('.js-callback').click(function(){
        $.fancybox.open({
            src: '#callbackModal',
            type: 'inline',
            animationEffect: "zoom"
        });
    });

    $('.js-auth').click(function(){
        $.fancybox.open({
            src: '#authModal',
            type: 'inline',
            animationEffect: "zoom"
        });
    });

    $('.topcontrol').click(function () {$('body,html').animate({scrollTop: 0}, 400); return false;});

    $('.el-tabs').click(function() {
        var i = $('.el-tabs').index(this);
        $('.tabs-cont').css('display','none');
        $('.tabs-cont').eq(i).fadeIn();
        $('.el-tabs').removeClass('el-tabs-active');
        $(this).addClass('el-tabs-active');
    });

    $('.el-tabs2').click(function() {
        var i = $('.el-tabs2').index(this);
        $('.tabs-cont').css('display','none');
        $('.tabs-cont').eq(i).fadeIn();
        $('.el-tabs2').removeClass('el-tabs-active2');
        $(this).addClass('el-tabs-active2');
    });

    $('.catalog-section-btn').on('click', function(){
        const $item = $(this).closest('.catalog-section');
        if($item.hasClass('catalog-section-active')){
            $item.removeClass('catalog-section-active');
            $item.find('.catalog-section-info').slideUp();
        } else {
            $item.addClass('catalog-section-active');
            $item.find('.catalog-section-info').slideDown();
        }
    });

    /*$('.catalog-section-btn').on('click', function(){
        const $list = $(this).closest('.catalog-section-list');
        const $item = $(this).closest('.catalog-section');
        if($item.hasClass('catalog-section-active')){
            $item.removeClass('catalog-section-active');
            $item.find('catalog-section-info').slideUp();
        } else {
            $list.find('.catalog-section').removeClass('catalog-section-active');
            $list.find('catalog-section-info').slideUp();
            $item.addClass('catalog-section-active');
            $item.find('catalog-section-info').slideDown();
        }
    });*/

    if ($("input[name=f_Phone],input[name=phone]").length > 0) {
        $("input[name=f_Phone],input[name=phone]").mask("+7 (999) 999-99-99", { placeholder: "_" });
    }

    $('.menu-but, .close-menu').click(function() {
        if($(window).width() > 992){
            $('.menu-full').toggleClass('menu-full-active');
            $('.menu-but').toggleClass('on');
            $('html').toggleClass('menu-full-open');
        } else {
            $('.main-menu').toggleClass('menu-active');

            if ($('#fade').length > 0) {
                $('#fade').remove();
            } else {
                $('body').append('<div id="fade"></div>').find('#fade').fadeIn();
            }
        }
        return false;
    });

    $(document).on('click','.js-catalog-item__btn',function(e) {
        e.preventDefault();
    });

    $(document).on('click','#fade',function() {
        if($('.menu-active').length > 0){
            $('.main-menu').toggleClass('menu-active');
        }
        if($('.form-search-active').length > 0){
            $('.form-search').toggleClass('form-search-active');
        }
        $(this).fadeOut().remove();
    });

    $(document).on('click','.menu-prev',function(e) {
        e.preventDefault();
        let level = +$('.main-menu').attr('data-level');
        level -= 1;

        $(this).closest('li.expanded').removeClass('expanded');

        $('.main-menu').attr('data-level',level);
        $('.header-menu-box').css('transform','translateX(-'+level+'00%)');
        let h = +$(this).closest('li.expanded').find('.dropdown').outerHeight(true);
        if(h > 0){
            $('.menu-wrap').css('height', h);
        } else {
            $('.menu-wrap').removeAttr('style');
        }
    });

    $(document).on('click','.js-but-submenu',function(e) {
        e.preventDefault();
        let level = +$('.main-menu').attr('data-level');
        level += 1;
        if(!$(this).closest('li').hasClass('expanded')){
            $(this).closest('li').addClass('expanded');
        }
        $('.main-menu').attr('data-level',level);
        $('.header-menu-box').css('transform','translateX(-'+level+'00%)');
        let h = +$(this).closest('li').find('.dropdown').outerHeight(true);
        $('.menu-wrap').css('height',h);
    });

    if($('.js-auto-height').length > 0){
        const heightWindow = $(window).height();
        const heightContent = parseInt($('.js-auto-height').innerHeight());
        const heightBody = parseInt($('body').outerHeight(true))+6;
        var heightNew = parseInt(heightWindow - heightBody + heightContent);
        if(heightWindow > heightBody) {
            $('.cont-vn').css({'min-height':heightNew});
        } else { $('.cont-vn').removeAttr('style'); }
    }

    $('input[type=file]').bind('change', function() {
        var file_selected = false;
        if(this.files.length >= 1){
            file_selected = true;
            $(this).closest('.form-group-file').find('.file-text').html(this.files[0].name);
        }
        if(file_selected === false){
            $(this).closest('.form-group-file').find('.file-text').html('Прикрепить файл');
        }
        if(this.files[0].size > 5242880){
            swal("Внимание:", "Этот файл превышает допустимый размер", "error");
        }
    });

    $('body').on('submit', 'form', function (e) {
        //e.preventDefault();
        let form = $(this);
        let error = false;

        form.find('input, textarea').each(function () { //:not([type=hidden])
            $(this).closest('.form-group').removeClass('form-group-error');
            var currentError = false;
            var inputName = $(this).attr('name');

            var val = $(this).val().trim();

            if (val.length == 0 && $(this).hasClass('required') && $(this).is(':visible')) {
                currentError = true;
            }

            if (currentError === false && val.length > 0 && $(this).is(':visible')) {
                /*if(
                    (
                        inputName == 'PHONE'
                        || $(this).hasClass('login-phone')
                    )
                    && val.replace(/[^0-9]/g, '').length !== 11) {
                    currentError = true;
                }*/
                if(
                    (
                        $(this).hasClass('input-email')
                        || inputName == 'EMAIL'
                        || inputName == 'USER_EMAIL'
                    )
                    && !isValidEmailAddress(val)) {
                    currentError = true;
                }
            }

            if($(this).attr('type') === 'checkbox' || $(this).attr('type') === 'radio') {
                if($('input[name="'+$(this).attr('name')+'"]').is(':checked') == false) {
                    currentError = true;
                }
            }

            if(currentError) {
                error = true;
                $(this).closest('.form-group').addClass('form-group-error');
            }

        });

        if($(this).closest('form').find('.js-captcha').length > 0) {
            $.ajax({
                type: "POST",
                url: "/captcha.php",
                data: "code=" + $('.js-captcha input[name=f_Code]').val(),
                async: false,
                success: function (html) {
                    if (html == 2) {
                        error = true;
                        $('.js-captcha').addClass('form-group-error');
                    }
                }
            });
        }

        if(!error) {
            return true;
        } else {
            return false;
        }
    });
    
    $(document).on({
        mouseenter: function () {
            $(this).find('.js-portfolio-info').fadeIn();
        },
        mouseleave: function () {
            $(this).find('.js-portfolio-info').fadeOut();
        }
    }, ".js-portfolio-item");
});
/*
$.datepicker.regional['ru'] = {
    closeText: 'Закрыть',
    prevText: 'Предыдущий',
    nextText: 'Следующий',
    currentText: 'Сегодня',
    monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
    monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
    dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
    dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
    dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
    weekHeader: 'Не',
    dateFormat: 'dd.mm.yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};

$.datepicker.setDefaults($.datepicker.regional['ru']);

$(function(){
    $("#orderform-delivery_date").datepicker();
});
*/
/*jQuery(function($) {
    $.datepicker.setDefaults($.datepicker.regional["ru"]);
    $("#orderform-delivery_date").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        dateFormat: 'd.m.yy',
        dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
        minDate: new Date(),
        maxDate: "+6m",
    });
});*/