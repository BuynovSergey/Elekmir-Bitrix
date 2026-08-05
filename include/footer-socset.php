<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    <div class='footer-soc'>
        <div>Мы в соцсетях:</div>
        <div class='footer-soc-flex'>
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
