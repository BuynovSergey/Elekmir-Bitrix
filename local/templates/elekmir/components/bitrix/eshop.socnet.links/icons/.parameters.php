<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

$arComponentParameters = array(
	"PARAMETERS" => array(
		"TELEGRAM" => array(
			"NAME" => GetMessage("SOCSERV_TELEGRAM"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
			"PARENT" => "BASE",
		),
		"VKONTAKTE" => array(
			"NAME" => GetMessage("SOCSERV_VKONTAKTE"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
			"PARENT" => "BASE",
		),
	),
);
?>