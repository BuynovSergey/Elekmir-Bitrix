<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/styles.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/template_styles.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/swiper-bundle.min.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/tracker_phoneicon.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/snow.css");
Asset::getInstance()->addString("<link rel='shortcut icon' type='image/x-icon' href='".SITE_TEMPLATE_PATH."/images/favicon.ico' />");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/main.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery.maskedinput.min.js");

global $arSite;
global $arFavorites;
$userID = $GLOBALS["USER"]->GetID();
$rsCSite = CSite::GetByID("elekmir");
$arSite = $rsCSite->Fetch();// pr($arSite);

$mainPage = false;
$page404 = false;

if ($APPLICATION->GetCurDir() == SITE_DIR){
    $mainPage = true;
}

if(defined("ERROR_404") && ERROR_404 == 'Y') {
    $page404 = true;
}
//$new_year = true;

$arFavorites = [];
if($GLOBALS["USER"]->IsAuthorized()){
    $HLBlock = new HLBlock(4);
    $arFavoriteHbl = $HLBlock->getData(array('ID', 'UF_JSON'), array('UF_USER' => $userID));
    if(!empty($arFavoriteHbl)) {
        foreach ($arFavoriteHbl as $favorite) {
            $arFavorites = json_decode($favorite['UF_JSON'], true);
        }
    }
} else {
    if(isset($_SESSION['FAVORITES'])){
        $arFavorites = json_decode($_SESSION['FAVORITES']);
    }
}

?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
<meta property='og:type' content='website' />
<meta property='og:title' content='".($current_sub[AlternativeTitle] ? $current_sub[AlternativeTitle] : $f_title)."' />
<meta property='og:description' content='$current_sub[Description]' />
<meta property='og:image' content='https://elekmir.ru/ext_images/1843/img_136c7fa622f5cdff1b25098659013cd4' />

<meta property='og:url'              content='https://elekmir.ru<?=$_SERVER['REQUEST_URI']?>' />
<meta property='og:site_name'        content='elekmir.ru - надежный партнер и поставщик качественной электротехнической продукции' />
<meta property='og:locale'           content='ru_RU' />
<meta property='og:locale:alternate' content='en_US' />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <? $APPLICATION->ShowHead()?>

    <title><? $APPLICATION->ShowTitle(); ?></title>
</head>
<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<?

/*$APPLICATION->IncludeComponent(
    "mibazarow:favorites.add",
    "",
    array(
    )
);*/?>
<?if($new_year):?>
    <div class='ng-top-left'></div>
    <div class='ng-top-right'></div>
    <div class='ng-bottom-left'></div>
    <div class='ng-bottom-right'></div>
<?endif;?>
<header class='header<?=($mainPage ? " main-header" : "")?>'>
    <div class='header-top'>
        <div class='main'>
            <div class='logo for-mobile'><a href='/'><img src='<?=SITE_TEMPLATE_PATH?>/images/logo.png' alt='<?=$arSite['SITE_NAME']?>' title='<?=$arSite['SITE_NAME']?>' /></a></div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/header-phone.php"
                )
            );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/header-worktime.php"
                )
            );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket.line",
                "header-cart",
                Array(
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
                    "SHOW_TOTAL_PRICE" => "Y"
                )
            );?>

            <button class='header-btn-callback btn btn-blue js-callback'>Заказать звонок</button>
            <div class='menu-but'>
                <div class='menu-ico'><span></span></div>
            </div>
        </div>
    </div>
    <div class='main'>
        <div class='header-middle'>
            <div class='logo'>
                <?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_TEMPLATE" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"PATH" => "/include/header-logo.php"
	),
	false
);?>
            </div>
            <div class='search-box'>
<form action='/catalog/' class='form-search'>
                <input class='js-search' type='text' name='q' value='' placeholder='Поиск по товарам, брендам, категориям'>
                <button type='submit' class='icon icon-search icon-centered icon-white'></button>
            </form>
<div class='js-search-content'></div>
</div>
            <div class='header-soc'>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:eshop.socnet.links",
                    "icons",
                    array(
                        "VKONTAKTE" => "https://vk.com/bitrix_1c",
                        "TELEGRAM" => "",
                    ),
                    false,
                    array(
                        "HIDE_ICONS" => "N"
                    )
                );?>
            </div>
        </div>
        <nav class='main-menu scroll-sm' data-level='0'>
            <div class='close-menu'></div>
            <div class='menu-wrap'>
                <div class='header-menu-box'>
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "topmenu", Array(
	"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
		"MENU_THEME" => "site",
		"CACHE_SELECTED_ITEMS" => "N",
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MAX_LEVEL" => "2",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "podmenu",	// Тип меню для остальных уровней
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
                    <div class='for-mobile'>
                        <div class='menu-contacts'>
                            <div class='menu-phone'>
                                <i class='icon icon-phone icon-main icon-24'></i>
                                <div class='menu-phone-col'>
                                    <a href='tel:+74952102478'>8 (495) 210-24-78</a>
                                    <a href='tel:+78002506278'>8 (800) 250-62-78</a>
                                </div>
                            </div>
                            <div class='menu-soc'>
                                <a href='#'>
                                    <i class='icon icon-vk icon-bg-circle icon-centered icon-bg-white icon-xxl-bg-40 icon-bg-50 icon-main'></i>
                                </a>
                                <a href='#'>
                                    <i class='icon icon-telegram icon-bg-circle icon-centered icon-bg-white icon-xxl-bg-40 icon-bg-50 icon-main'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
<main class='main-outer'>
    <?if(!$mainPage && !$page404 && empty($isSection)):?>
    <div class="cont-vn-header">
        <div class="main">
            <?$APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "universal1",
                array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => SITE_ID,
                    "SHOW_SUBSECTIONS" => "N"
                ),
                false
            );?>
            <h1><?=$APPLICATION->ShowTitle(false);?></h1>
        </div>
    </div>
    <div class="main">
        <div class="cont-vn">
    <?endif;?>