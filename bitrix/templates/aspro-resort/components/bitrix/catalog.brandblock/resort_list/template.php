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

if (empty($arResult["BRAND_BLOCKS"]))
	return;
$strRand = $this->randString();
$strObName = 'obIblockBrand_'.$strRand;
$blockID = 'bx_IblockBrand_'.$strRand;
$mouseEvents = 'onmouseover="'.$strObName.'.itemOver(this);" onmouseout="'.$strObName.'.itemOut(this)"';


?>
<div class="bx_item_detail_inc_two profit_block">

<h4 class="title_block"><?=$arParams["TITLE_BLOCK"];?></h4>
<div class="items row">
<?

$handlerIDS = array();

foreach ($arResult["BRAND_BLOCKS"] as $blockId => $arBB)
{
	$brandID = 'brand_'.$arResult['ID'].'_'.$strRand;
	$popupID = $brandID.'_popup';

	$usePopup = $arBB['FULL_DESCRIPTION'] !== false;
	$useLink = $arBB['LINK'] !== false;
	if ($useLink)
		$arBB['LINK'] = htmlspecialcharsbx($arBB['LINK']);
	$bImage = $arBB['PICT']['SRC'];
	$arImage = ($bImage ? CFile::ResizeImageGet($arBB['PICT'], array('width' => 60, 'height' => 60), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
	$imageSrc = ($bImage ? $arImage['src'] : false);

	switch ($arBB['TYPE'])
	{
		default:
			?>
			<div class="item_block col-md-6 col-sm-6">
				<div class="item<?=($bImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<?if($bImage):?>
						<div class="image">
							<?if($useLink):?><a href="<?=$arBB['LINK']?>"><?endif;?>
							<img src=<?=$imageSrc?> />
							<?if($useLink):?></a><?endif;?>
						</div>
					<?endif;?>
					<div class="text_block">
						<div class="title">
							<?if($useLink):?><a href="<?=$arBB['LINK']?>"><?endif;?>
								<?=$arBB['NAME']?>
							<?if($useLink):?></a><?endif;?>
						</div>
						<?if($arBB['FULL_DESCRIPTION']){?>
							<div class="descr">
								<?=$arBB['FULL_DESCRIPTION'];?>
							</div>
						<?}?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<?
	}
	if ($usePopup)
		$handlerIDS[] = $brandID;
}
?>
	</div>
</div>
<hr/>
<?
if (!empty($handlerIDS))
{
	$jsParams = array(
		'blockID' => $blockID
	);
?>
	<script type="text/javascript">
		var <? echo $strObName; ?> = new JCIblockBrands(<? echo CUtil::PhpToJSObject($jsParams); ?>);
	</script>
<?}