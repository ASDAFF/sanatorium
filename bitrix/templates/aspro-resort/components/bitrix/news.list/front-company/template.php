<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?if($arResult['ITEMS']){?>
<div class="company front">
	<div class="top_wrapper_block">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."include/front-company.php",
				"EDIT_TEMPLATE" => "standard.php"
			)
		);?>
		<div class="items row">
			<?foreach($arResult['ITEMS'] as $key => $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// use detail link?
				$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? $arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' : true);
				// preview image
				$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
				$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 300, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
				$imageSrc = ($bImage ? $arImage['src'] : false);
				$bActiveDate = strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arItem['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']));
				?>
				<div class="col-md-12">
					<div class="item<?=($bImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
						<div class="row">
							<?if($bImage):?>
								<div class="col-md-3">
									<div class="image">
										<?if($bDetailLink):?><a href="<?=$arItem['LIST_PAGE_URL']?>"><?endif;?>
											<img src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-responsive" />
										<?if($bDetailLink):?></a><?endif;?>
									</div>
								</div>
							<?endif;?>
							
							<div class="col-md-<?=($bImage ? '9' : '12');?>">
								<div class="info">	
									<?// element preview text?>
									<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
										<div class="text">
											<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
										</div>
									<?endif;?>
									<?if(strlen($arItem['DISPLAY_PROPERTIES']['property1']['VALUE'])||strlen($arItem['DISPLAY_PROPERTIES']['property2']['VALUE'])||strlen($arItem['DISPLAY_PROPERTIES']['property3']['VALUE'])||strlen($arItem['DISPLAY_PROPERTIES']['property4']['VALUE'])):?>
										<div class="props row items">
											<?for($i=1;$i<=4;$i++){?>
												<?if(strlen($arItem['DISPLAY_PROPERTIES']['property'.$i]['VALUE'])):?>
													<div class="prop item col-md-3 col-sm-6 col-xs-6">
															<?//print_r($arItem['DISPLAY_PROPERTIES']['property1']);?>
															<div class="value spincrement1" data-value="<?=$arItem['DISPLAY_PROPERTIES']['property'.$i]['VALUE']?>">0</div>
															<div class="text"><?=$arItem['DISPLAY_PROPERTIES']['property'.$i]['NAME']?></div>
													</div>
												<?endif;?>
											<?}?>
										</div>
									<?endif;?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('.company.front .item .props .prop').sliceHeight();
	});
</script>
<?}?>