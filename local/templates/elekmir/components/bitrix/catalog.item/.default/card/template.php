<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array|null $price
 * @var float|int|null $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */

?>
<div class="catalog-item__img">
    <?
    if(!empty($morePhoto)){
        if(!empty($morePhoto[0]['SRC'])){
            $imgPreview = $morePhoto[0]['SRC'];
        } else {
            $imgPreview = SITE_TEMPLATE_PATH."/images/no-photo.jpg";
        }
    }
    ?>
    <img src="<?=$imgPreview?>" alt="<?=$imgTitle?>" title="<?=$imgTitle?>">
</div>
<div class="catalog-item__title"><?=$item["NAME"]?></div>
<div>
    <div class="catalog-item__info">
        <?foreach($item["DISPLAY_PROPERTIES"] as $pid=>$arProperty):
            echo '<b>'.$arProperty["NAME"].':</b>&nbsp;';

            if(is_array($arProperty["DISPLAY_VALUE"]))
                echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
            else
                echo $arProperty["DISPLAY_VALUE"];
            ?><br />
        <?endforeach?>
    </div>
    <div class="catalog-item__price-box">
        <div class="catalog-item__price">
            <span class="catalog-price"><?=$item["OFFERS"][0]["ITEM_PRICES"][$item["OFFERS"][0]["ITEM_PRICE_SELECTED"]]["PRINT_PRICE"]?></span> <span>за <?=$item["OFFERS"][0]["ITEM_MEASURE"]["TITLE"]?></span>
        </div>

        <?foreach($item["PRICES"] as $code=>$arPrice):?>
            <?if($arPrice["CAN_ACCESS"]):?>
                <div class="catalog-item__price">
                    <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                        <s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
                    <?else:?>
                        <span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
                    <?endif;?>
                    <span>руб. за м</span>
                </div>
            <?endif;?>
        <?endforeach;?>

    </div>
<?=$arParams['BASKET_URL']?>
    <form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="<?=$arParams['ADD_TO_BASKET_ACTION']?>">
        <input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $item["OFFERS"][0]["ID"]?>">
        <button class="btn btn-blue catalog-item__btn" type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo $arParams['MESS_BTN_ADD_TO_BASKET']?>"><?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?></button>
    </form>
</div>
