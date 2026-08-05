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

?>
<div class="catalog-section">
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "tree", Array(
	"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
	"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
	"SECTION_ID"	=>	"0",
	"COUNT_ELEMENTS"	=>	"Y",
	"TOP_DEPTH"	=>	"2",
	"SECTION_URL"	=>	$arParams["SECTION_URL"],
	"CACHE_TYPE"	=>	"N",
	"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
	"DISPLAY_PANEL"	=>	"N",
	"ADD_SECTIONS_CHAIN"	=>	$arParams["ADD_SECTIONS_CHAIN"],
	"SECTION_USER_FIELDS"	=>	$arParams["SECTION_USER_FIELDS"],
	),
	$component
);?>
</div>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<div class="catalog-box">
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>

            <a href="<?=$arElement["DETAIL_PAGE_URL"]?>" title="<?=$arElement["NAME"]?>" class="catalog-item"  id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                <?
                $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
                ?>
                <?if($arParams["DISPLAY_COMPARE"]):?>
                    <noindex>
                        <div class="icon icon-heart catalog-item__favorite icon-centered icon-bg-circle" onclick="event.preventDefault(); location.href='<?echo $arElement["COMPARE_URL"]?>'" title="Отложить"></div>
                    </noindex>
                <?endif?>
                <div class="catalog-item__img">
                    <?
                        $arFile = CFile::GetFileArray(($arElement["OFFERS"][0]["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["VALUE"][0]));
                    ?>
                    <img src="<?=$arFile["SRC"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>">
                </div>
                <div class="catalog-item__title"><?=$arElement["NAME"]?></div>
                <div>

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
                        <?if($arParams["USE_PRODUCT_QUANTITY"]):?>
                            <div><?echo GetMessage("CT_BCS_QUANTITY")?>:</div>
                            <div><input type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" size="5"></div>
                        <?endif;?>

                        <?=pr($arResult["PRICE_MATRIX"])?>
                        <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
                        <input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arElement["OFFERS"][0]["ID"]?>">

                        <?if($old):?>
                            <a href="<?echo $arElement["BUY_URL"]?>" rel="nofollow" class="catalog-item__btn-text"><?echo GetMessage("CATALOG_BUY")?></a>
                            <a href="<?echo $arElement["ADD_URL"]?>" rel="nofollow" class="catalog-item__btn-text"><?echo GetMessage("CATALOG_ADD")?></a>
                            <input class="btn btn-blue catalog-item__btn" type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>">
                        <?endif;?>

                        <input class="btn btn-blue catalog-item__btn" type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CATALOG_ADD")?>">
                    </form>
                </div>
            </a>
        <?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>
</div>

<?if($old):?>
		<td valign="top" width="<?=round(100/$arParams["LINE_ELEMENT_COUNT"])?>%" style="border:1px solid #CCCCCC" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
			<table cellpadding="0" cellspacing="2" border="0">
				<tr>

					<td valign="top"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><b><?=$arElement["NAME"]?></b></a><br /><br />
						<?
						$pub_date = '';
						if ($arElement["ACTIVE_FROM"])
							$pub_date = FormatDate($GLOBALS['DB']->DateFormatToPhp(CSite::GetDateFormat('FULL')), MakeTimeStamp($arElement["ACTIVE_FROM"]));
						elseif ($arElement["DATE_CREATE"])
							$pub_date =  FormatDate($GLOBALS['DB']->DateFormatToPhp(CSite::GetDateFormat('FULL')), MakeTimeStamp($arElement["DATE_CREATE"]));

						if ($pub_date)
							echo '<b>'.GetMessage('PUB_DATE').'</b>&nbsp;'.$pub_date.'<br />';
						?>

						<br />
						<?=$arElement["PREVIEW_TEXT"]?>
					</td>
				</tr>
			</table>

			<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
				<?if($arPrice["CAN_ACCESS"]):?>
					<p><?=$arResult["PRICES"][$code]["TITLE"];?>:&nbsp;&nbsp;
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
						<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
					<?else:?><span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span><?endif;?>
					</p>
				<?endif;?>
			<?endforeach;?>
			<?if(is_array($arElement["PRICE_MATRIX"])):?>
				<table cellpadding="0" cellspacing="0" border="0" width="100%" class="data-table">
				<thead>
				<tr>
					<?if(count($arElement["PRICE_MATRIX"]["ROWS"]) >= 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
						<td valign="top" nowrap><?= GetMessage("CATALOG_QUANTITY") ?></td>
					<?endif?>
					<?foreach($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
						<td valign="top" nowrap><?= $arType["NAME_LANG"] ?></td>
					<?endforeach?>
				</tr>
				</thead>
				<?foreach ($arElement["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?>
				<tr>
					<?if(count($arElement["PRICE_MATRIX"]["ROWS"]) > 1 || count($arElement["PRICE_MATRIX"]["ROWS"]) == 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
						<th nowrap><?
							if (intval($arQuantity["QUANTITY_FROM"]) > 0 && intval($arQuantity["QUANTITY_TO"]) > 0)
								echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
							elseif (intval($arQuantity["QUANTITY_FROM"]) > 0)
								echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
							elseif (intval($arQuantity["QUANTITY_TO"]) > 0)
								echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));
						?></th>
					<?endif?>
					<?foreach($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
						<td><?
							if($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"] < $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"]):?>
								<s><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"])?></s><span class="catalog-price"><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);?></span>
							<?else:?>
								<span class="catalog-price"><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);?></span>
							<?endif?>&nbsp;
						</td>
					<?endforeach?>
				</tr>
				<?endforeach?>
				</table><br />
			<?endif?>

			<?if($arElement["CAN_BUY"]):?>
				<?if($arParams["USE_PRODUCT_QUANTITY"] || count($arElement["PRODUCT_PROPERTIES"])):?>
					<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
					<table border="0" cellspacing="0" cellpadding="2">
					<?if($arParams["USE_PRODUCT_QUANTITY"]):?>
						<tr valign="top">
							<td><?echo GetMessage("CT_BCS_QUANTITY")?>:</td>
							<td>
								<input type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" size="5">
							</td>
						</tr>
					<?endif;?>
					<?foreach($arElement["PRODUCT_PROPERTIES"] as $pid => $product_property):?>
						<tr valign="top">
							<td><?echo $arElement["PROPERTIES"][$pid]["NAME"]?>:</td>
							<td>
							<?if(
								$arElement["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L"
								&& $arElement["PROPERTIES"][$pid]["LIST_TYPE"] == "C"
							):?>
								<?foreach($product_property["VALUES"] as $k => $v):?>
									<label><input type="radio" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]" value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"checked"'?>><?echo $v?></label><br>
								<?endforeach;?>
							<?else:?>
								<select name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
									<?foreach($product_property["VALUES"] as $k => $v):?>
										<option value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"selected"'?>><?echo $v?></option>
									<?endforeach;?>
								</select>
							<?endif;?>
							</td>
						</tr>
					<?endforeach;?>
					</table>
					<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
					<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arElement["ID"]?>">
					<input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>">
					<input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CATALOG_ADD")?>">
					</form>
				<?else:?>
					<noindex>
					<a href="<?echo $arElement["BUY_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_BUY")?></a>&nbsp;<a href="<?echo $arElement["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD")?></a>
					</noindex>
				<?endif?>
			<?elseif((count($arResult["PRICES"]) > 0) || is_array($arElement["PRICE_MATRIX"])):?>
				<?=GetMessage("CATALOG_NOT_AVAILABLE")?>
				<?$APPLICATION->IncludeComponent("bitrix:sale.notice.product", ".default", array(
							"NOTIFY_ID" => $arElement['ID'],
							"NOTIFY_URL" => htmlspecialcharsback($arElement["SUBSCRIBE_URL"]),
							"NOTIFY_USE_CAPTHA" => "N"
							),
							$component
						);?>
			<?endif?>
			&nbsp;
		</td>

		<?$cell++;
		if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
			</tr>
		<?endif?>



		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
			<?while(($cell++)%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
				<td>&nbsp;</td>
			<?endwhile;?>
			</tr>
		<?endif?>
<?endif;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
