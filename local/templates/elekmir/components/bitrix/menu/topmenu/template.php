<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
//pr($arResult);
?>
<nav class="main-menu scroll-sm" data-level="0">
    <div class="close-menu"></div>
    <div class="menu-wrap">
        <div class="header-menu-box">
            <?if (!empty($arResult)):?>
                <ul class="header-menu">
                    <?foreach($arResult as $arItem):
                        if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel && $arItem["DEPTH_LEVEL"] == 1):?>
                            </ul></li>
                        <?endif?>
                        <?if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                            continue;
                        ?>
                        <?if ($arItem["DEPTH_LEVEL"] == 1): //элементы первого уровня?>
                            <?if ($arItem["PARAMS"]["catalog"]): //для первого элемента - калатог?>
                                <li class="item-catalog-box<?($arItem["SELECTED"] ? " selected" : "")?>">
                                    <a href="<?=$arItem["LINK"]?>" class="link-1 item-catalog">
                                        <i class="icon icon-menu icon-20 icon-white js-but-submenu"></i>
                                        <span><?=$arItem["TEXT"]?></span>
                                        <span class="icon but-submenu js-but-submenu"></span>
                                    </a>
                            <?else:?>
                                <li class="<?($arItem["PARAMS"]["catalog"] ? "item-catalog-box" : "")?><?($arItem["SELECTED"] ? " selected" : "")?>">
                                    <a href="<?=$arItem["LINK"]?>"<?=($arItem["DEPTH_LEVEL"] == 1 ? ' class="link-1"' : '')?>>
                                        <span><?=$arItem["TEXT"]?></span>
                                    </a>
                            <?endif;?>
                        <?else:?>
                            <li class="<?=($arItem["DEPTH_LEVEL"] == 2 ? "s-menu-b" : "")?><?=($arItem["SELECTED"] ? " selected" : "")?>">
                                <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                        <?endif;?>
                        <?if ($arItem["IS_PARENT"] && $arItem["DEPTH_LEVEL"] == 1): //открытие подменю?>
                            <ul class="dropdown">
                                <li class="icon menu-prev">Назад</li>
                        <?else:?>
                        </li>
                        <?endif;?>

                        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
                    <?endforeach?>
                    <?/*if ($previousLevel > 1)://close last item tags?>
                        <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
                    <?endif*/?>
                </ul>
            <?endif?>
            <div class="for-mobile">
                <div class="menu-contacts">
                    <div class="menu-phone">
                        <i class="icon icon-phone icon-main icon-24"></i>
                        <div class="menu-phone-col">
                            <a href="tel:+74952102478">8 (495) 210-24-78</a>
                            <a href="tel:+78002506278">8 (800) 250-62-78</a>
                        </div>
                    </div>
                    <div class="menu-soc">
                        <a href="#">
                            <i class="icon icon-vk icon-bg-circle icon-centered icon-bg-white icon-xxl-bg-40 icon-bg-50 icon-main"></i>
                        </a>
                        <a href="#">
                            <i class="icon icon-telegram icon-bg-circle icon-centered icon-bg-white icon-xxl-bg-40 icon-bg-50 icon-main"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<?if($old):?>
    <li class="item-catalog-box">
        <a href="/catalog/" class="link-1 item-catalog">
            <i class="icon icon-menu icon-20 icon-white js-but-submenu"></i>
            <span>Каталог</span>
            <span class="icon but-submenu js-but-submenu"></span>
        </a>

    </li>
<ul class="dropdown">
    <li class="icon menu-prev">Назад</li>
    <li class="s-menu-b"><a href="/catalog/provod_kabel/">Провод/Кабель</a></li>
    <li><a href="/catalog/provod_kabel/lapptherm/">LAPPTHERM</a></li>
    <li><a href="/catalog/provod_kabel/razovye_postavki/">Разовые поставки</a></li>
    <li><a href="/catalog/provod_kabel/sip_instrument/">СИП - инструмент</a></li>
</ul>
<?endif;?>