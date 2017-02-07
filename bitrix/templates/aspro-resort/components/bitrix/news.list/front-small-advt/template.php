<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?if($arResult['ITEMS']):?>
	<?
	$colmd = 4;
	$colsm = 4;
	$colxs = 6;
	?>
	<div class="item-views catalog sections front">
		<div class="items row">
			<?foreach($arResult['ITEMS'] as $arItem):
				if(!$arItem['DETAIL_PICTURE']['SRC'])
					continue;?>
				<?
				// edit/add/delete buttons for edit mode
				//$arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
				//$this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
				//$this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				
				// preview picture
				if($bSectionImage = strlen($arItem['DETAIL_PICTURE']['SRC']) && in_array('DETAIL_PICTURE', $arParams['FIELD_CODE'])){
					// $arSectionImage = CFile::ResizeImageGet($arItem['PICTURE'], array('width' => 361, 'height' => 254), BX_RESIZE_IMAGE_EXACT, true);
					$arSectionImage = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width' => 500, 'height' => 500), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					$imageSectionSrc = $arSectionImage['src'];
				}
				?>
				<div class="col-md-<?=$colmd?> col-sm-<?=$colsm?> col-xs-<?=$colxs?>">
					<div class="item<?=($bSectionImage ? '' : ' wti')?> wline" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
						<?if (isset($arItem['DISPLAY_PROPERTIES']['LINK']) && strlen($arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'])):?>
							<a href="<?=$arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']?>" class="dark_block_animate"></a>
						<?else:?>
							<span class="dark_block_animate"></span>
						<?endif;?>
						<?// icon or preview picture?>
						
						<?/*if($bSectionImage):?>
							<div class="image scale_block_animate">
								<a href="<?=$arItem['SECTION_PAGE_URL']?>">
									<img src="<?=$imageSectionSrc?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" class="img-responsive" />
								</a>
							</div>
						<?endif;*/?>
						<div class="img_block scale_block_animate" style="background-image: url('<?=$imageSectionSrc;?>');"></div>
						<div class="info">
							<?// section name?>
							<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
								<div class="title">
									<span class="wrap_outer titles">
										<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="outer_text">
											<span class="inner_text"><?=strip_tags($arItem["~NAME"], "<br><br/>");?></span>
										</a>
									</span>
								</div>
							<?endif;?>

							<?// section preview text?>
							<?if(strlen($arItem['DETAIL_TEXT'])):?>
								<div class="text">
									<?=$arItem['DETAIL_TEXT']?>
								</div>
							<?endif;?>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>

<script type="text/javascript">
/*$(document).ready(function() {
	try{
		if(arResortOptions.THEME.CATALOG_INDEX == 'Y'){
			$('.catalog.item-views.sections.front').show();
		}
		else{
			$('.catalog.item-views.sections.front').remove();
		}
	}
	catch(e){}
});*/
</script>