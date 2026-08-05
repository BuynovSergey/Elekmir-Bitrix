<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$rsCSite = CSite::GetByID("elekmir");
$arSite = $rsCSite->Fetch();
?>
<a href="/"><img src="/local/templates/elekmir/images/logo.png" alt="<?=$arSite['SITE_NAME']?>"></a>