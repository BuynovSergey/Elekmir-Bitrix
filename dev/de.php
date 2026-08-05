<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
$arFavorite = array(18, 20, 30);
$key = array_search(18, $arFavorite);
if($key !== false){
    unset($arFavorite[$key]);
    pr($key);
}
pr($arFavorite);


