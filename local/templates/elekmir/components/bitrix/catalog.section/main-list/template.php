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
$this->setFrameMode(true);
//pr($component);
//pr($arResult['FAVORITES']);
//pr(realpath(__DIR__).'/ajax_template.php');
?>
<?if($arParams["MAIN_SLIDER"] != "Y"):?>
<div id="catalog" itemscope="" itemtype="http://schema.org/ItemList">
    <div class="catalog-box">
<?endif;?>
<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>

<?

if($_GET["debug"]) {
    //unset($arElement["OFFERS"][0]["DISPLAY_PROPERTIES"]);
    unset($arElement["OFFERS"][0]["PROPERTIES"]);
    pr($arElement["DISPLAY_PROPERTIES"]);

}
?>
    <?if($arParams["MAIN_SLIDER"] == "Y"):?>
    <div class='swiper-slide'>
    <?endif;?>
        <a href="<?=$arElement["DETAIL_PAGE_URL"]?>" title="<?=$arElement["NAME"]?>" class="catalog-item" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
        <?
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
        ?>
        <?if($arParams["DISPLAY_COMPARE"]):?>
            <noindex>
                <?if($old):?>
                    onclick="event.preventDefault(); location.href='?action=ADD_TO_COMPARE_LIST&compare_id=<?=$arElement["ID"]?>'"
                    <div class="icon icon-heart catalog-item__favorite icon-centered icon-bg-circle<?=(isset($_SESSION["CATALOG_COMPARE_LIST"][$arParams["IBLOCK_ID"]]["ITEMS"][$arElement["ID"]]) ? " catalog-item__favorite-active" : "")?>" id="compareid_<?=$arElement["ID"]?>" onclick="event.preventDefault(); compare_tov(<?=$arElement["ID"]?>)" title="Отложить"></div>
                <?endif;?>
                <? /*$frame = $this->createFrame('favorite', false)->begin();*/
                    //ob_start();
                ?>
                <div class="icon icon-heart catalog-item__favorite icon-centered icon-bg-circle js-favorite" id="FAVORITE_<?=$arElement["ID"]?>" title="Отложить"></div>
                <?
                    //$this->__component->arResult["CACHED_TPL"] = @ob_get_contents();
                    //ob_get_clean();
                ?>
                <? /*$frame->beginStub(); $frame->end();*/ ?>
            </noindex>
        <?endif?>
        <div class="catalog-item__img">
            <?
                $imgPreview = $arElement["DETAIL_PICTURE"]["SRC"];
                if(empty($imgPreview)){
                    $imgPreview = $arElement["OFFERS"][0]["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["VALUE"][0];
                    if(!empty($imgPreview)){
                        $arFile = CFile::GetFileArray(($imgPreview));
                        $imgPreview = $arFile["SRC"];
                    } else {
                        $imgPreview = SITE_TEMPLATE_PATH."/images/no-photo.jpg";
                    }
                }
            ?>
            <img src="<?=$imgPreview?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>">
        </div>
        <div class="catalog-item__title"><?=$arElement["NAME"]?></div>
        <div>
            <?
            //pr($arElement["OFFERS"]);
            ?>
            <div class="catalog-item__info">
                <?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):
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
                    <span class="catalog-price"><?=$arElement["OFFERS"][0]["ITEM_PRICES"][$arElement["OFFERS"][0]["ITEM_PRICE_SELECTED"]]["PRINT_PRICE"]?></span> <span>за <?=$arElement["OFFERS"][0]["ITEM_MEASURE"]["TITLE"]?></span>
                </div>

                <?foreach($arElement["PRICES"] as $code=>$arPrice):?>
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
            <form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
                <input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arElement["OFFERS"][0]["ID"]?>">
<?if($old):?>
                <input class="btn btn-blue catalog-item__btn" type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CATALOG_ADD")?>">
            <?endif;?>
                <button class="btn btn-blue catalog-item__btn" type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CATALOG_ADD")?>"><?echo GetMessage("CATALOG_ADD")?></button>
            </form>
        </div>
    </a>
    <?if($arParams["MAIN_SLIDER"] == "Y"):?>
    </div>
    <?endif;?>
<?endforeach;?>
<?if($arParams["MAIN_SLIDER"] != "Y"):?>
    </div>
</div>
<?endif;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>