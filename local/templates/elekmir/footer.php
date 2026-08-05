<?if(!$mainPage && !$page404 && empty($isSection)):?>
    </div>
    </div>
<?endif;?>
</main>
<footer class='footer'>
    <div class='main'>
        <div class='footer-menu'>
            <div class='h1'>Разделы</div>
            <nav class='footer-wrap'>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "menu-botoom", Array(
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "bottom",	// Тип меню для остальных уровней
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
			0 => "",
		),
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "N",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"ROOT_MENU_TYPE" => "bottom",	// Тип меню для первого уровня
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	),
	false
);?>
            </nav>
        </div>
        <div class='footer-dev footer-dev1'></div>
        <div class='footer-contacts'>
            <div class='h1'>Контакты</div>
            <div class='footer-contacts-grid'>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "COMPONENT_TEMPLATE" => ".default",
                        "EDIT_TEMPLATE" => "",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "PATH" => "/include/footer-address.php"
                    ),
                    false
                );?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "COMPONENT_TEMPLATE" => ".default",
                        "EDIT_TEMPLATE" => "",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "PATH" => "/include/footer-email.php"
                    ),
                    false
                );?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "COMPONENT_TEMPLATE" => ".default",
                        "EDIT_TEMPLATE" => "",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "PATH" => "/include/footer-phone.php"
                    ),
                    false
                );?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "COMPONENT_TEMPLATE" => ".default",
                        "EDIT_TEMPLATE" => "",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "PATH" => "/include/footer-time.php"
                    ),
                    false
                );?>
            </div>
        </div>
        <div class='footer-dev footer-dev2'></div>
        <div class='footer-info'>
            <div class='footer-info__title'> Заказы через сайт принимаются круглосуточно</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "COMPONENT_TEMPLATE" => ".default",
                    "EDIT_TEMPLATE" => "",
                    "AREA_FILE_RECURSIVE" => "Y",
                    "PATH" => "/include/footer-socset.php"
                ),
                false
            );?>
            <div class='copy'>
                <div>© <?=date("Y")?> Электро-Мир</div>
                <div>Разработано <a href='https://kproject.su' target='_blank'>Kproject.su</a></div>
            </div>
        </div>
    </div>

    <?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"footer-cart", 
	array(
		"HIDE_ON_BASKET_PAGES" => "Y",
		"PATH_TO_AUTHORIZE" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "Y",
		"SHOW_PRODUCTS" => "N",
		"SHOW_REGISTRATION" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"COMPONENT_TEMPLATE" => "footer-cart"
	),
	false
);?>
</footer>

<div class='topcontrol' title='К началу страницы'>
    <i class='icon icon-arrow-up icon-white icon-bg-main icon-centered icon-bg-large icon-bg-circle icon-large'></i>
</div>
<?if(!$_COOKIE['cookie-accept']):?>
	<div class='b-cookie'><div class='main-cu'><div class='b-cookie-text'>Мы тоже используем куки, потому что <a href='/politika-cookie/'>без них вообще ничего не работает</a></div><div class='b-cookie-but'><button type='button' class='btn btn-main' onclick='acceptCookie();'>Принять</button></div> </div></div>
<?endif;?>

<div class='modal modal-callback' id='callbackModal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div class='modal-title'>Заказать звонок</div>
            </div>
            <div class='modal-body'>
         
<form name='callback-form' enctype='multipart/form-data' method='post' action='/control/addition.php'>
                    <input type='hidden' name='catalogue' value='1' />
                    
        <input name='ssdt' type='hidden' value='636'>
        <input name='ss' type='hidden' value='1260'>
<input name='action_name' type='hidden' value='callbackCaptcha'>
<input name='posting' type='hidden' value='1' />
<input name='f_Subject' type='hidden' value='Обратный звонок' />
                    <div class='modal-col'>
                        <div class='form-group'>
                            <input name='f_Name' type='text' size='32' maxlength='32' placeholder='Ваше имя *' class='required' value='' />
                        </div>
                        <div class='form-group'>
                            <input name='f_Phone' type='text' size='32' maxlength='32' placeholder='Ваш телефон *' class='required' value='' />
                        </div>
<div class='form-group'>
                            <input name='f_Time' type='text' size='32' maxlength='32' placeholder='Время звонка*' class='required' value='' />
                        </div>
                        <div class='form-group'>
                            <textarea name='f_Message' placeholder='Сообщение' rows='3' cols='30'></textarea>
                        </div>
<div class='captcha-box form-group js-captcha'><div><i>Выполните сложение:</i>$img <span>плюс два</span></div> <input type='text' name='f_Code' class='required' size='10'></div>
                        <label class='form-group unified-checkbox policy'>
                            <input type='checkbox' name='nc_agreed' class='required' autocomplete='off'>
                            <div class='checkbox-text'>
                                <div class='checkbox-check'></div>
                                <div>Ознакомлен(а) с <a href='/konfideciyalnost/' target='_blank'>пользовательским соглашением</a></div>
                            </div>
                        </label>
                    </div>
                    <div class='text-center'><button class='btn-big btn-blue'>Отправить заявку</button></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class='modal modal-auth' id='authModal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div class='modal-title'>Авторизация</div>
            </div>
            <div class='modal-body'>
         
<form name='form_auth' method='post' target='_top' action='/sys_files/add/user/'>
                    <input type='hidden' name='AuthPhase' value='1'>
                    <input type='hidden' name='BACKLINK' value='$current_sub[Hidden_URL]'>
                    <input type='hidden' name='BACKLINKFALSE' value='/personal/error-authorisation/'>
                    <input type='hidden' name='ss' value='$ss'>
                    <input type='hidden' name='ssdt' value='$ssdt'>
<div class='modal-col'>
                  <div class='form-group'>
                    <input type='text' name='user' maxlength='50' placeholder='Логин' value='' class='required'/>
                  </div>
                  <div class='form-group'>
                    <input type='password' name='password' maxlength='50' placeholder='Пароль' value='' class='required'/>
                  </div>

                  <button type='submit' name='Login' class='btn btn-blue' value='Войти'>Войти</button>
                  <a class='btn btn-blue' href='/sys_files/add/user/regenerate.php' rel='nofollow'>Напомнить пароль</a>
</div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery.fancybox.min.js");
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/wow.min.js");
?>
<script src='https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js'></script>

<script>
    /*wow = new WOW(
        {
            boxClass:     'wow',
            animateClass: 'animated',
            offset:       100,
            mobile:       false,
            callback:     function(box) {
                //console.log('WOW: animating <' + box.tagName.toLowerCase() + '>')
            }
        }
    );
    wow.init();*/



    $(document).ready(function() {
        var swiper = new Swiper('.main-slider', {
            spaceBetween: 0,
            slidesPerView: 1,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1.3,
                    spaceBetween: 20,
                    pagination: {
                        enabled: false
                    },
                    centeredSlides: true
                },
                600: {
                    slidesPerView: 1,
                    pagination: {
                        enabled: true
                    }
                }
            }
        });

        var swiper2 = new Swiper('.main-slider-partners', {
            spaceBetween: 80,
            slidesPerView: 6,
            loop: true,
            breakpoints: {
                0: {
                    slidesPerView: 2.2,
                    spaceBetween: 10
                },
                400: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                500: {
                    slidesPerView: 3
                },
                700: {
                    slidesPerView: 4
                },
                1100: {
                    slidesPerView: 5
                },
                1400: {
                    slidesPerView: 6
                }
            },
            /*navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },*/
        });
        $('.js-partner-prev').click(function(){
            swiper2.slidePrev();
        });
        $('.js-partner-next').click(function(){
            swiper2.slideNext();
        });


var swiper3 = new Swiper('.main-slider-special-product', {
            spaceBetween: 20,
            slidesPerView: 4,
            loop: true,
            breakpoints: {
                0: {
                    slidesPerView: 1.2,
                    spaceBetween: 10,// centeredSlides: true,
                },
                400: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                750: {
                    slidesPerView: 3
                },
                992: {
                    slidesPerView: 4
                }
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

    });
</script>
<div id='clbh_phone_div' class='cbh-phone cbh-green'>
	<div class='cbh-ph-circle'></div>
    <div class='cbh-ph-circle-fill'></div>
    <div class='cbh-box-c'><div class='cbh-ph-img-circle3'></div></div>
</div>
</body>
</html>