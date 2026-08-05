<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */

?>
<a href='<?= $arParams['PATH_TO_BASKET'] ?>' class='header-cart'>
    <i class='icon icon-cart icon-white icon-30'></i>
    <div class='header-cart-cnt js-cnt-cart'><?=intval($arResult['BASKET_COUNT_DESCRIPTION'])?></div>
</a>
