<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);

if (is_array($arResult["SOCSERV"]) && !empty($arResult["SOCSERV"]))
{
?>
		<?php foreach($arResult["SOCSERV"] as $socserv): ?>
            <a href="<?=htmlspecialcharsbx($socserv["LINK"])?>" target="_blank">
                <i class='soc-item icon <?= htmlspecialcharsbx($socserv["CLASS"])?> icon-white icon-centered'></i>
            </a>
		<?php endforeach ?>

<?php
}
?>