<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Производственно-коммерческая компания \"Электро-Мир\"");
global $trendFilter;
$trendFilter["PROPERTY_SPECIALOFFER"] = 3;
?>

<?if($old):?>
<br>
  <?
global $trendFilter;
$trendFilter = array('PROPERTY_TREND' => '4');
?>
<h2>Тренды сезона</h2>
<?endif;?>
<?if (IsModuleInstalled("advertising")):?>
    <section class='main-slider-box wow fadeInUp'>
        <div class='main'>
            <?if($old):?>
            <div class='swiper main-slider'>
                <div class='swiper-wrapper'>
            <?endif;?>
                    <?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"main-slider",
	[
		"BS_ARROW_NAV" => "Y",
		"BS_BULLET_NAV" => "Y",
		"BS_CYCLING" => "N",
		"BS_EFFECT" => "fade",
		"BS_HIDE_FOR_PHONES" => "Y",
		"BS_HIDE_FOR_TABLETS" => "N",
		"BS_KEYBOARD" => "Y",
		"BS_PAUSE" => "Y",
		"BS_WRAP" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "main-slider",
		"NOINDEX" => "Y",
		"QUANTITY" => "3",
		"TYPE" => "MAIN",
		"DEFAULT_TEMPLATE" => "-"
	],
	false
);?>
            <?if($old):?>
                </div>
                <div class='swiper-pagination'></div>
            </div>
            <?endif;?>
        </div>
    </section>
<?endif?>
<section class='main-special-box main-margin wow fadeInUp'>
    <div class='main'>
        <div class='h1'>Спецпредложения</div>
        <?if(empty($debug)):?>
        <div class="swiper-slider">
            <div class='swiper main-slider-special-product'>
                <div class='swiper-wrapper'>
        <?endif;?>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "main-list",
                        Array(
                            "ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
                            "ADD_PICT_PROP" => "MORE_PHOTO",	// Дополнительная картинка основного товара
                            "ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
                            "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                            "ADD_TO_BASKET_ACTION" => "ADD",	// Показывать кнопку добавления в корзину или покупки
                            "AJAX_MODE" => "N",	// Включить режим AJAX
                            "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                            "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                            "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                            "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                            "BASKET_URL" => "/personal/cart/",	// URL, ведущий на страницу с корзиной покупателя
                            "BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
                            "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
                            "CACHE_GROUPS" => "Y",	// Учитывать права доступа
                            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                            "CACHE_TYPE" => "A",	// Тип кеширования
                            "COMPATIBLE_MODE" => "N",	// Включить режим совместимости
                            "COMPONENT_TEMPLATE" => "main-list",
                            "CONVERT_CURRENCY" => "Y",	// Показывать цены в одной валюте
                            "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
                            "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
                            "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                            "ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
                            "ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
                            "ELEMENT_SORT_ORDER" => "desc",	// Порядок сортировки элементов
                            "ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
                            "FILTER_NAME" => "trendFilter",	// Имя массива со значениями фильтра для фильтрации элементов
                            "HIDE_NOT_AVAILABLE" => "N",	// Недоступные товары
                            "IBLOCK_ID" => "2",	// Инфоблок
                            "IBLOCK_TYPE" => "catalog",	// Тип инфоблока
                            "IBLOCK_TYPE_ID" => "catalog",
                            "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
                            "LABEL_PROP" => array(	// Свойства меток товара
                                0 => "NEWPRODUCT",
                            ),
                            "LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
                            "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
                            "MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
                            "MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
                            "MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
                            "MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
                            "MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
                            "META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
                            "META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
                            "OFFERS_CART_PROPERTIES" => array(
                                0 => "SIZES_SHOES",
                                1 => "COLOR_REF",
                                2 => "SIZES_CLOTHES",
                            ),
                            "OFFERS_FIELD_CODE" => array(	// Поля предложений
                                0 => "NAME",
                                1 => "",
                            ),
                            "OFFERS_PROPERTY_CODE" => array(
                                0 => "SIZES_SHOES",
                                1 => "COLOR_REF",
                                2 => "SIZES_CLOTHES",
                                3 => "",
                            ),
                            "OFFERS_SORT_FIELD" => "sort",	// По какому полю сортируем предложения товара
                            "OFFERS_SORT_FIELD2" => "",	// Поле для второй сортировки предложений товара
                            "OFFERS_SORT_ORDER" => "asc",	// Порядок сортировки предложений товара
                            "OFFERS_SORT_ORDER2" => "",	// Порядок второй сортировки предложений товара
                            "OFFER_ADD_PICT_PROP" => "-",	// Дополнительные картинки предложения
                            "OFFER_TREE_PROPS" => array(
                                0 => "SIZES_SHOES",
                                1 => "COLOR_REF",
                                2 => "SIZES_CLOTHES",
                            ),
                            "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                            "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                            "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                            "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                            "PAGER_TEMPLATE" => "round",	// Шаблон постраничной навигации
                            "PAGER_TITLE" => "Товары",	// Название категорий
                            "PAGE_ELEMENT_COUNT" => "16",	// Количество элементов на странице
                            "PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
                            "PRICE_CODE" => array(	// Тип цены
                                0 => "BASE",
                            ),
                            "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
                            "PRODUCT_DISPLAY_MODE" => "Y",	// Схема отображения
                            "PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
                            "PRODUCT_PROPERTIES" => "",
                            "PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
                            "PRODUCT_QUANTITY_VARIABLE" => "",	// Название переменной, в которой передается количество товара
                            "PRODUCT_SUBSCRIPTION" => "N",	// Разрешить оповещения для отсутствующих товаров
                            "PROPERTY_CODE" => array(
                                0 => "NEWPRODUCT",
                                1 => "",
                            ),
                            "SECTION_CODE" => "",	// Код раздела
                            "SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
                            "SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
                            "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
                            "SECTION_USER_FIELDS" => array(	// Свойства раздела
                                0 => "",
                                1 => "",
                            ),
                            "SEF_MODE" => "N",	// Включить поддержку ЧПУ
                            "SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
                            "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                            "SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
                            "SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
                            "SET_STATUS_404" => "N",	// Устанавливать статус 404
                            "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
                            "SHOW_404" => "N",	// Показ специальной страницы
                            "SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
                            "SHOW_CLOSE_POPUP" => "N",	// Показывать кнопку продолжения покупок во всплывающих окнах
                            "SHOW_DISCOUNT_PERCENT" => "N",	// Показывать процент скидки
                            "SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
                            "SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
                            "TEMPLATE_THEME" => "site",	// Цветовая тема
                            "USE_MAIN_ELEMENT_SECTION" => "N",	// Использовать основной раздел для показа элемента
                            "USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
                            "USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
                            "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",	// Фильтр товаров
                            "HIDE_NOT_AVAILABLE_OFFERS" => "N",	// Недоступные торговые предложения
                            "PROPERTY_CODE_MOBILE" => "",	// Свойства товаров, отображаемые на мобильных устройствах
                            "BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
                            "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",	// Вариант отображения товаров
                            "ENLARGE_PRODUCT" => "STRICT",	// Выделять товары в списке
                            "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",	// Порядок отображения блоков товара
                            "SHOW_SLIDER" => "Y",	// Показывать слайдер для товаров
                            "LABEL_PROP_MOBILE" => "",	// Свойства меток товара, отображаемые на мобильных устройствах
                            "LABEL_PROP_POSITION" => "top-left",	// Расположение меток товара
                            "SHOW_MAX_QUANTITY" => "N",	// Показывать остаток товара
                            "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",	// Сообщение о недоступности услуги
                            "DISPLAY_COMPARE" => "N",	// Разрешить сравнение товаров
                            "USE_ENHANCED_ECOMMERCE" => "N",	// Отправлять данные электронной торговли в Google и Яндекс
                            "LAZY_LOAD" => "N",	// Показать кнопку ленивой загрузки Lazy Load
                            "MESS_BTN_LAZY_LOAD" => "Показать ещё",	// Текст кнопки "Показать ещё"
                            "LOAD_ON_SCROLL" => "N",	// Подгружать товары при прокрутке до конца
                            "DISABLE_INIT_JS_IN_COMPONENT" => "N",	// Не подключать js-библиотеки в компоненте
                            "SLIDER_INTERVAL" => "3000",	// Интервал смены слайдов, мс
                            "SLIDER_PROGRESS" => "N",	// Показывать полосу прогресса
                            "USE_OFFER_NAME" => "N",
                            "SECTIONS_OFFSET_MODE" => "N",
                            "SECTIONS_SECTION_ID" => "",
                            "SECTIONS_SECTION_CODE" => "",
                            "SECTIONS_TOP_DEPTH" => "2",
                            "SHOW_SECTIONS" => "Y",
                            "DEFERRED_LOAD" => "N",
                            "CYCLIC_LOADING" => "N",
                            "CYCLIC_LOADING_COUNTER_NAME" => "cycleCount",
                            "MAIN_SLIDER" => "Y"
                        ),
                        false
                    );?>
        <?if(empty($debug)):?>
                </div>
            </div>
            <div class='swiper-button-prev'></div>
            <div class='swiper-button-next'></div>
        </div>
        <?endif;?>
    </div>
</section>
<section class="main-about-us-box main-margin wow fadeInUp">
    <div class="main">
        <div class="main-about-us">
            <div class="main-about-us__left">
                <div class="h1">Электро-Мир</div>
                <div class="main-about-us__text">
                    <div class="catalog_description">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/main-text.php"
                            )
                        );?>
                    </div></div>
            </div>
            <div class="main-about-us__right">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/main-img.php"
                    )
                );?>
            </div>
        </div>
    </div>
</section>
<?if($old):?>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "main-list",
    Array(
        "ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
        "ADD_PICT_PROP" => "MORE_PHOTO",	// Дополнительная картинка основного товара
        "ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
        "ADD_TO_BASKET_ACTION" => "ADD",	// Показывать кнопку добавления в корзину или покупки
        "AJAX_MODE" => "N",	// Включить режим AJAX
        "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
        "BASKET_URL" => "/personal/cart/",	// URL, ведущий на страницу с корзиной покупателя
        "BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
        "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
        "CACHE_GROUPS" => "Y",	// Учитывать права доступа
        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
        "CACHE_TYPE" => "A",	// Тип кеширования
        "COMPATIBLE_MODE" => "N",	// Включить режим совместимости
        "COMPONENT_TEMPLATE" => "board-my",
        "CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
        "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
        "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
        "ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
        "ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
        "ELEMENT_SORT_ORDER" => "desc",	// Порядок сортировки элементов
        "ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
        "FILTER_NAME" => "trendFilter",	// Имя массива со значениями фильтра для фильтрации элементов
        "HIDE_NOT_AVAILABLE" => "N",	// Недоступные товары
        "IBLOCK_ID" => "2",	// Инфоблок
        "IBLOCK_TYPE" => "catalog",	// Тип инфоблока
        "IBLOCK_TYPE_ID" => "catalog",
        "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
        "LABEL_PROP" => array(	// Свойства меток товара
            0 => "NEWPRODUCT",
        ),
        "LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
        "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
        "MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
        "MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
        "MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
        "MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
        "META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
        "META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
        "OFFERS_CART_PROPERTIES" => array(
            0 => "SIZES_SHOES",
            1 => "COLOR_REF",
            2 => "SIZES_CLOTHES",
        ),
        "OFFERS_FIELD_CODE" => array(	// Поля предложений
            0 => "NAME",
            1 => "",
        ),
        "OFFERS_PROPERTY_CODE" => array(
            0 => "SIZES_SHOES",
            1 => "COLOR_REF",
            2 => "SIZES_CLOTHES",
            3 => "",
        ),
        "OFFERS_SORT_FIELD" => "sort",	// По какому полю сортируем предложения товара
        "OFFERS_SORT_FIELD2" => "id",	// Поле для второй сортировки предложений товара
        "OFFERS_SORT_ORDER" => "desc",	// Порядок сортировки предложений товара
        "OFFERS_SORT_ORDER2" => "desc",	// Порядок второй сортировки предложений товара
        "OFFER_ADD_PICT_PROP" => "-",	// Дополнительные картинки предложения
        "OFFER_TREE_PROPS" => array(
            0 => "SIZES_SHOES",
            1 => "COLOR_REF",
            2 => "SIZES_CLOTHES",
        ),
        "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
        "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
        "PAGER_TEMPLATE" => "round",	// Шаблон постраничной навигации
        "PAGER_TITLE" => "Товары",	// Название категорий
        "PAGE_ELEMENT_COUNT" => "1",	// Количество элементов на странице
        "PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
        "PRICE_CODE" => array(	// Тип цены
            0 => "BASE",
        ),
        "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
        "PRODUCT_DISPLAY_MODE" => "Y",	// Схема отображения
        "PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
        "PRODUCT_PROPERTIES" => "",
        "PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
        "PRODUCT_QUANTITY_VARIABLE" => "",	// Название переменной, в которой передается количество товара
        "PRODUCT_SUBSCRIPTION" => "N",	// Разрешить оповещения для отсутствующих товаров
        "PROPERTY_CODE" => array(
            0 => "NEWPRODUCT",
            1 => "MORE_PHOTO",
        ),
        "SECTION_CODE" => "",	// Код раздела
        "SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
        "SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
        "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
        "SECTION_USER_FIELDS" => array(	// Свойства раздела
            0 => "",
            1 => "",
        ),
        "SEF_MODE" => "N",	// Включить поддержку ЧПУ
        "SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
        "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
        "SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
        "SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
        "SET_STATUS_404" => "N",	// Устанавливать статус 404
        "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
        "SHOW_404" => "N",	// Показ специальной страницы
        "SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
        "SHOW_CLOSE_POPUP" => "N",	// Показывать кнопку продолжения покупок во всплывающих окнах
        "SHOW_DISCOUNT_PERCENT" => "N",	// Показывать процент скидки
        "SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
        "SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
        "TEMPLATE_THEME" => "site",	// Цветовая тема
        "USE_MAIN_ELEMENT_SECTION" => "N",	// Использовать основной раздел для показа элемента
        "USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
        "USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
        "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",	// Фильтр товаров
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",	// Недоступные торговые предложения
        "PROPERTY_CODE_MOBILE" => "",	// Свойства товаров, отображаемые на мобильных устройствах
        "BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",	// Вариант отображения товаров
        "ENLARGE_PRODUCT" => "STRICT",	// Выделять товары в списке
        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",	// Порядок отображения блоков товара
        "SHOW_SLIDER" => "Y",	// Показывать слайдер для товаров
        "LABEL_PROP_MOBILE" => "",	// Свойства меток товара, отображаемые на мобильных устройствах
        "LABEL_PROP_POSITION" => "top-left",	// Расположение меток товара
        "SHOW_MAX_QUANTITY" => "N",	// Показывать остаток товара
        "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",	// Сообщение о недоступности услуги
        "DISPLAY_COMPARE" => "N",	// Разрешить сравнение товаров
        "USE_ENHANCED_ECOMMERCE" => "N",	// Отправлять данные электронной торговли в Google и Яндекс
        "LAZY_LOAD" => "N",	// Показать кнопку ленивой загрузки Lazy Load
        "MESS_BTN_LAZY_LOAD" => "Показать ещё",	// Текст кнопки "Показать ещё"
        "LOAD_ON_SCROLL" => "N",	// Подгружать товары при прокрутке до конца
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",	// Не подключать js-библиотеки в компоненте
        "SLIDER_INTERVAL" => "3000",	// Интервал смены слайдов, мс
        "SLIDER_PROGRESS" => "N",	// Показывать полосу прогресса
        "USE_OFFER_NAME" => "N",
        "SECTIONS_OFFSET_MODE" => "N",
        "SECTIONS_SECTION_ID" => "",
        "SECTIONS_SECTION_CODE" => "",
        "SECTIONS_TOP_DEPTH" => "2",
        "SHOW_SECTIONS" => "Y",
        "DEFERRED_LOAD" => "N",
        "CYCLIC_LOADING" => "N",
        "CYCLIC_LOADING_COUNTER_NAME" => "cycleCount"
    ),
    false
);?>
<?endif;?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>