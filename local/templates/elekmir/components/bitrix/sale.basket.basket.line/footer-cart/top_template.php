<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
global $arFavorites;
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<div class='footer-panel-left'>
    <?if($USER->IsAuthorized()):?>
        <?if($arParams['SHOW_PERSONAL_LINK'] == 'Y'):?>
            <a href='<?=$arParams['PATH_TO_PROFILE']?>' title='<?=GetMessage('TSB1_LK')?>' rel='nofollow' class='btn-row btn-login'>
                <i class='icon icon-user icon-main icon-30'></i>
                <span><?=GetMessage('TSB1_LK')?></span>
            </a>
        <?endif;?>
    <?else:?>

        <?
        $arParamsToDelete = array(
            "login",
            "login_form",
            "logout",
            "register",
            "forgot_password",
            "change_password",
            "confirm_registration",
            "confirm_code",
            "confirm_user_id",
            "logout_butt",
            "auth_service_id",
            "clear_cache",
            "backurl",
        );

        $currentUrl = urlencode($APPLICATION->GetCurPageParam("", $arParamsToDelete));
        if ($arParams['AJAX'] == 'N')
        {
            ?><script><?=$cartId?>.currentUrl = '<?=$currentUrl?>';</script><?
        }
        else
        {
            $currentUrl = '#CURRENT_URL#';
        }

        /*$pathToRegister = $arParams['PATH_TO_REGISTER'];
        $pathToRegister .= (mb_stripos($pathToRegister, '?') === false ? '?' : '&');
        $pathToRegister .= 'register=yes&backurl='.$currentUrl;*/
        ?>
        <a class='btn-row btn-login js-auth' href='javascript:void(0)' title='<?=GetMessage('TSB1_LOGIN')?>'>
            <i class='icon icon-user icon-main icon-30'></i>
            <span><?=GetMessage('TSB1_LOGIN')?></span>
        </a>

        <?if ($arParams['SHOW_REGISTRATION'] === 'Y'):?>
            <?
            $pathToRegister = $arParams['PATH_TO_REGISTER'];
            $pathToRegister .= (mb_stripos($pathToRegister, '?') === false ? '?' : '&');
            $pathToRegister .= 'register=yes&backurl='.$currentUrl;
            ?>
            <a href='<?=$pathToRegister?>' title='<?=GetMessage('TSB1_REGISTER')?>' rel='nofollow' class='btn-row btn-register'>
                <i class='icon icon-user-plus icon-main icon-30'></i>
                <span><?=GetMessage('TSB1_REGISTER')?></span>
            </a>
        <?endif;?>

    <?endif;?>
    <a href='#' rel='nofollow' class='btn-row btn-like'>
        <i class='icon icon-heart icon-main icon-30'></i>
        <span><?=GetMessage('TSB1_FAVORITE_TEXT_SM')?> <strong class='text-red js-favorite-cnt'><?=count($arFavorites)?></strong></span>
    </a>
    <?
    /*$APPLICATION->IncludeComponent(
            "mibazarow:favorites.line",
            "",
            array(

            )
        );
    $APPLICATION->IncludeComponent("bitrix:catalog.compare.list", "footer", array(
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "2",
            "NAME" => "CATALOG_COMPARE_LIST",
            "DETAIL_URL" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
            "COMPARE_URL" => "/catalog/compare/",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "compare_id"
        )
    );*/
    ?>
</div>
<div class='footer-panel-cart'>
    <?if($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y')):?>
        <div class='btn-cart'>
            <a href='<?= $arParams['PATH_TO_BASKET'] ?>'><i class='icon icon-cart icon-main icon-30'></i></a>
            <a href='<?= $arParams['PATH_TO_BASKET'] ?>'><span><?=GetMessage('TSB1_CART')?></span></a> <strong class='text-red js-cnt-cart'><?=$arResult['NUM_PRODUCTS']?></strong>
        </div>
    <?endif;?>
    <div class='footer-panel-cart__sum'>
        <span class='js-cart-summ'><?=$arResult['TOTAL_PRICE']?></span>
    </div>
    <a href='<?= $arParams['PATH_TO_BASKET'] ?>' class='btn btn-blue text-uppercase'><?=GetMessage('TSB1_2ORDER_SM')?></a>
</div>
