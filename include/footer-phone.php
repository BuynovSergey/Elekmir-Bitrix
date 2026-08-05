<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class='box-icon footer-phone'>
    <i class='icon icon-phone icon-white icon-centered icon-bg-circle icon-18 icon-bg-46'></i>
    <div class='box-icon__des-i'>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            ".default",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "COMPONENT_TEMPLATE" => ".default",
                "EDIT_TEMPLATE" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "PATH" => "/include/phone.php"
            ),
            false
        ); ?>
    </div>
</div>