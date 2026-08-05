<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->IncludeComponent(
    "bitrix:catalog.compare.list",
    "footer",
    array(
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "2",
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "DETAIL_URL" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
        "COMPARE_URL" => "/catalog/compare.php",
        "NAME" => "CATALOG_COMPARE_LIST",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
);