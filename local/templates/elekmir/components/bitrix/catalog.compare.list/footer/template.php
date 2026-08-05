<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$itemCount = count($arResult);
if($arParams["AJAX_MODE"] == "Y"){
    echo $itemCount;
    die();
}
?>
    <a href='<?=$arParams["COMPARE_URL"]?>' title='<?=GetMessage('TSB1_DELAY_SM')?>' rel='nofollow' class='btn-row btn-like'>
        <i class='icon icon-heart icon-main icon-30'></i>
        <span><?=GetMessage('CP_COMPARE_TEXT_SM')?> <strong class='text-red js-compare-cnt'><?=$itemCount?></strong></span>
    </a>
