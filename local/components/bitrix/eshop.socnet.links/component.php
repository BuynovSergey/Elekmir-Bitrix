<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$arResult["SOCSERV"] = array();

if (isset($arParams["TELEGRAM"]) && !empty($arParams["TELEGRAM"]))
	$arResult["SOCSERV"]["TELEGRAM"] = array(
		"LINK" => $arParams["TELEGRAM"],
		"CLASS" => "icon-telegram",
		"NAME" => "Telegram",
	);

if (isset($arParams["VKONTAKTE"]) && !empty($arParams["VKONTAKTE"]))
	$arResult["SOCSERV"]["VKONTAKTE"] = array(
		"LINK" => $arParams["VKONTAKTE"],
		"CLASS" => "icon-vk",
		"NAME" => "Vkontakte",
	);

$this->IncludeComponentTemplate();
?>