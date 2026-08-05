<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult['ITEMS'] as $k=>$arElement)
{
	$user_id = $arElement['DISPLAY_PROPERTIES']['USER_ID']['DISPLAY_VALUE'];
	if ($user_id)
	{
		$rsUSER = CUser::GetById($user_id);
		$f=$rsUSER->Fetch();
		$arResult['ITEMS'][$k]['DISPLAY_PROPERTIES']['USER_ID']['DISPLAY_VALUE'] = CUser::FormatName(CSite::GetNameFormat(false), array("NAME" => $f['NAME'], "LAST_NAME" => $f['LAST_NAME'], "SECOND_NAME" => $f['SECOND_NAME'], "LOGIN" => $f['LOGIN']));
	}
}

/*global $userID;
$userID = false;
if(isset($GLOBALS['USER']) && $GLOBALS["USER"]->IsAuthorized()) {
	$userID = $GLOBALS['USER']->GetID();
}

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
$arResult['FAVORITES'] = $arFavorite;*/
$this->__component->SetResultCacheKeys(array('CACHED_TPL'));
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
?>
