<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'catalog-section-list',
		'TITLE' => 'catalog-section-title',
		'LIST' => 'catalog-section',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'catalog-section-list',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?><div class="<? echo $arCurView['CONT']; ?>"><?
if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'])
{
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
?>
<h1 class="<? echo $arCurView['TITLE']; ?>" id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>">
    <a href="<? echo $arResult['SECTION']['SECTION_PAGE_URL']; ?>">
    <?
		echo (
			isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
			? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
			: $arResult['SECTION']['NAME']
		);
	?></a>
</h1>
    <?
}
if (0 < $arResult["SECTIONS_COUNT"])
{
?>
    <?if($arParams['VIEW_MODE'] != "LIST"):?>
        <div class="<? echo $arCurView['LIST']; ?>">
    <?endif;?>
<?
	switch ($arParams['VIEW_MODE'])
	{
		case 'LINE':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'])
				{
					$altValue = (string)($arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_ALT'] ?? '');
					if ($altValue === '')
					{
						$altValue = $arSection['NAME'];
					}
					$titleValue = (string)($arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_TITLE'] ?? '');
					if ($titleValue === '')
					{
						$titleValue = $arSection['NAME'];
					}
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => $altValue,
						'TITLE' => $titleValue,
					);
					unset($titleValue, $altValue);
				}
				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<a
					href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
					class="bx_catalog_line_img"
					style="background-image: url('<? echo $arSection['PICTURE']['SRC']; ?>');"
					title="<? echo $arSection['PICTURE']['TITLE']; ?>"
				></a>
				<h2 class="bx_catalog_line_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
				if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
				{
					?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
				}
				?></h2><?
				if ('' != $arSection['DESCRIPTION'])
				{
					?><p class="bx_catalog_line_description"><? echo $arSection['DESCRIPTION']; ?></p><?
				}
				?><div style="clear: both;"></div>
				</li><?
			}
			unset($arSection);
			break;
		case 'TEXT':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>"><h2 class="bx_catalog_text_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
				if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
				{
					?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
				}
				?></h2></li><?
			}
			unset($arSection);
			break;
		case 'TILE':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'])
				{
					$altValue = (string)($arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_ALT'] ?? '');
					if ($altValue === '')
					{
						$altValue = $arSection['NAME'];
					}
					$titleValue = (string)($arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_TITLE'] ?? '');
					if ($titleValue === '')
					{
						$titleValue = $arSection['NAME'];
					}
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => $altValue,
						'TITLE' => $titleValue,
					);
					unset($titleValue, $altValue);
				}
				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>" class="catalog-section">
				<a
					href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
					class="bx_catalog_tile_img"
					style="background-image:url('<? echo $arSection['PICTURE']['SRC']; ?>');"
					title="<? echo $arSection['PICTURE']['TITLE']; ?>"
					> </a><?
				if ('Y' != $arParams['HIDE_SECTION_NAME'])
				{
					?><h2 class="bx_catalog_tile_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
					if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
					{
						?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
					}
				?></h2><?
				}
				?></li><?
			}
			unset($arSection);
			break;
		case 'LIST':
            $prevDepthLevel = 0;
            foreach ($arResult['SECTIONS'] as &$arSection) {
                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

                if($prevDepthLevel && $prevDepthLevel > $arSection['RELATIVE_DEPTH_LEVEL']){
                    //на понижение
                    echo '</div></div></div>';
                }
                if($prevDepthLevel && $prevDepthLevel < $arSection['RELATIVE_DEPTH_LEVEL']){
                    //на повышение
                    echo '</div>';
                }
                if($prevDepthLevel == 1 && $arSection['RELATIVE_DEPTH_LEVEL'] == $prevDepthLevel){
                    echo '</div></div>';
                }

                if($arSection['RELATIVE_DEPTH_LEVEL'] == 1) {
                    echo '<div id="'.$this->GetEditAreaId($arSection['ID']).'" class="'.$arCurView['LIST'].'"><div class="catalog-section-title">';
                }
                if($arSection['RELATIVE_DEPTH_LEVEL'] == 2 && $prevDepthLevel != $arSection['RELATIVE_DEPTH_LEVEL']) {
                    echo '<div id="'.$this->GetEditAreaId($arSection['ID']).'" class="catalog-section-info"><div class="catalog-section-grid">';
                }

                echo '<a href="'.$arSection["SECTION_PAGE_URL"].'"'.($arSection['RELATIVE_DEPTH_LEVEL'] > 1 ? 'class="catalog-section-item"' : '').'>'.$arSection["NAME"].'</a>';

                if($arSection['RELATIVE_DEPTH_LEVEL'] == 1) {
                    echo '<span class="icon icon-down icon-centered catalog-section-btn"></span>';
                }


                $prevDepthLevel = $arSection['RELATIVE_DEPTH_LEVEL'];
            }
            if($prevDepthLevel > 1){
                echo str_repeat("</div>", $prevDepthLevel+1);
            } else {
                echo str_repeat("</div>", $prevDepthLevel);
            }

			/*$intCurrentDepth = 1;
			$boolFirst = true;
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL'])
				{
					if ($arSection['RELATIVE_DEPTH_LEVEL'] == 2)
						echo "\n",str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']),'<div class="catalog-section-info"><div class="catalog-section-grid">';
				}
				elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL'])
				{
					if (!$boolFirst)
						echo '</div>';
				}
				else
				{
					while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL'])
					{
						if($arSection['RELATIVE_DEPTH_LEVEL'] == 1 && $intCurrentDepth > 1){
                            echo '</div>';
                        }

                        echo '</div>', "\n", str_repeat("\t", $intCurrentDepth), '</div>', "\n", str_repeat("\t", $intCurrentDepth - 1);
						$intCurrentDepth--;
					}

                    echo str_repeat("\t", $intCurrentDepth-1),'</div>';

				}

				echo (!$boolFirst ? "\n" : ''),str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
				?>
            <?if($arSection['RELATIVE_DEPTH_LEVEL'] > 1):?>
                <a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="catalog-section-item"><span class="catalog-section-item__title"><? echo $arSection["NAME"];?></span>
            <?endif;?>
            <div id="<?=$this->GetEditAreaId($arSection['ID']);?>">
            <h2 class="catalog-section-title">
            <a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>"><? echo $arSection["NAME"];?><?
				if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
				{
					?> <span>(<? echo $arSection["ELEMENT_CNT"]; ?>)</span><?
				}
				?></a>

            <?if($boolFirst):?>
                <span class="icon icon-down icon-centered catalog-section-btn"></span>
            <?endif;?></h2>

            <?

				$intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
				$boolFirst = false;
			}
			unset($arSection);
			while ($intCurrentDepth > 1)
			{
				echo '1</div>',"\n",str_repeat("\t", $intCurrentDepth),'d1d</div>',"\n",str_repeat("\t", $intCurrentDepth-1);
				$intCurrentDepth--;
			}
			if ($intCurrentDepth > 0)
			{
				echo '2</div>',"\n";
			}
			*/

			break;
	}
?>
    <?if($arParams['VIEW_MODE'] != "LIST"):?>
        </div>
    <?endif;?>
<?
	echo ('LINE' != $arParams['VIEW_MODE'] && "LIST" != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
}
?></div>