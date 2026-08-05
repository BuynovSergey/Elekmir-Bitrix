<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
global $userID;
$userID = false;
if(isset($GLOBALS['USER']) && $GLOBALS["USER"]->IsAuthorized()) {
    $userID = $GLOBALS['USER']->GetID();
}

global $arFavorite;
if($userID) {
    $HLBlock = new HLBlock(4);
    $arFavoriteHbl = $HLBlock->getData(array("ID", "UF_JSON"), array("UF_USER" => $userID));
    if(!empty($arFavoriteHbl)) {
        foreach ($arFavoriteHbl as $favorite) {
            $arFavorite = json_decode($favorite["UF_JSON"], true);
        }
    }
}
if (!is_array($arFavorite)) {
    $arFavorite = array();
}

$arResHTML =  preg_replace_callback(
    "/#FAVORITE_([\d]+)#/is".BX_UTF_PCRE_MODIFIER,
    static function($matches){
        ob_start();

        global $userID;
        global $arFavorite;
        if($userID > 0) {
            if (!is_array($arFavorite)) {
                $arFavorite = array();
            }
             echo ($arFavorite[$matches[1]] ? " catalog-item__favorite-active" : "");
        }
        
         $retrunStr = @ob_get_contents();
         ob_get_clean();
         return $retrunStr;},
$arResult["CACHED_TPL"]);

/*$arResHTML =  preg_replace_callback(
    "/#FAVORITE_TITLE_([\d]+)#/is".BX_UTF_PCRE_MODIFIER,
    static function($matches){
        ob_start();

         global $arFavorite;
         echo ($arFavorite[$matches[1]] ? "Удалить из избранного" : "Добавить в избранное");
         $retrunStr = @ob_get_contents();
         ob_get_clean();
         return $retrunStr;},
    $arResHTML);*/

//echo $arResHTML;