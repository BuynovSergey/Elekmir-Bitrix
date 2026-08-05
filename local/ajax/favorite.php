<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

if(!check_bitrix_sessid() || $_SERVER["REQUEST_METHOD"] != "POST"){
    return;
}

$ID = (int)$_POST['id'];
$userID = $GLOBALS["USER"]->getID();
$result = array();
$arFavorite = array();

if($userID > 0) {
    $HLBlock = new HLBlock(4);
    $favoriteID = false;

    $arFavoriteHbl = $HLBlock->getData(array('ID', 'UF_JSON'), array('UF_USER' => $userID));
    if(!empty($arFavoriteHbl)) {
        foreach ($arFavoriteHbl as $favorite) {
            $favoriteID = $favorite['ID'];
            $arFavorite = json_decode($favorite['UF_JSON'], true);
        }
    }

    if(isset($_SESSION['FAVORITES'])) {
        $arFavoriteTmp = json_decode($_SESSION['FAVORITES'], true);
        //$result['favorite2'] = $arFavoriteTmp;
        $arFavorite = array_merge($arFavoriteTmp,$arFavorite);
        $arFavorite = array_unique($arFavorite);
    }

    if($ID > 0){
        $key = array_search($ID, $arFavorite);
        if ($key !== false) {
            unset($arFavorite[$key]);
        } else {
            $arFavorite[] = $ID;
        }
    }

    if ($favoriteID) {
        $HLBlock->update($favoriteID, array('UF_JSON' => json_encode($arFavorite)));
    } else {
        if(!empty($arFavorite)) {
            $HLBlock->addData(array(array('UF_USER' => $userID, 'UF_JSON' => json_encode($arFavorite))));
        }
    }

    $_SESSION['FAVORITES'] = json_encode($arFavorite);
} else {
    if(isset($_SESSION['FAVORITES'])){
        $arFavorite = json_decode($_SESSION['FAVORITES'], true);
    }
    if($ID > 0) {
        $key = array_search($ID, $arFavorite);
        if ($key !== false) {
            unset($arFavorite[$key]);
        } else {
            $arFavorite[] = $ID;
        }

        $_SESSION['FAVORITES'] = json_encode($arFavorite);
    }
}

if(!empty($_POST['getList'])) {
    $result['favorite'] = $arFavorite;
}
$result['cnt'] = count($arFavorite);
echo json_encode($result);