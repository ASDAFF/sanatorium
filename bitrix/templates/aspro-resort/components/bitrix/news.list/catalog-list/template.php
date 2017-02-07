<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?
$frame = $this->createFrame()->begin();
$frame->setAnimation(true);
$bShowImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']);
?>
<div class="catalog item-views list image-<?=$arParams['IMAGE_POSITION']?>">
	<?if($arResult['ITEMS']):?>
		<?if($arParams['DISPLAY_TOP_PAGER']):?>
			<?=$arResult['NAV_STRING']?>
		<?endif;?>

		<div class="row items" itemscope itemtype="http://schema.org/ItemList">
			<?foreach($arResult['ITEMS'] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// use detail link?
				$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? $arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' : true);
				// preview image
				if($bShowImage){
					$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
					$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 380, 'height' => 285), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
					$imageSrc = ($bImage ? $arImage['src'] : SITE_TEMPLATE_PATH.'/images/noimage_product.png');
					$imageDetailSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
				}
				// use order button?
				$bOrderButton = $arItem['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES';
				?>
				<?if($bShowImage):?>
					<?ob_start();?>
						<div class="image">
							<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="blink1" itemprop="url">
							<?elseif($imageDetailSrc):?><a href="<?=$imageDetailSrc?>" alt="<?=($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-inside fancybox" itemprop="url">
							<?endif;?>
								<img class="img-responsive" src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" itemprop="image" />
							<?if($bDetailLink):?></a>
							<?elseif($imageDetailSrc):?><span class="zoom"><i class="fa fa-16 fa-white-shadowed fa-search"></i></span></a>
							<?endif;?>
							<?if (isset($arItem['DISPLAY_PROPERTIES']['STIKERS']) && is_array($arItem['DISPLAY_PROPERTIES']['STIKERS']['VALUE'])):?>
								<div class="stickers">
									<?foreach ($arItem['DISPLAY_PROPERTIES']['STIKERS']['VALUE'] as $key => $sticker):?>
										<span class="sticker <?=($arItem['DISPLAY_PROPERTIES']['STIKERS']['VALUE_XML_ID'][$key])?>"><?=$sticker?></span>
									<?endforeach;?>
								</div>
							<?endif;?>
						</div>
					<?$imgPart = ob_get_clean();?>
				<?endif;?>
				
				<?ob_start();?>
					<div class="text">
						<div class="row">
							<?$colmd = 12 - (strlen($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']) || $bOrderButton ? ($bShowImage ? 3 : 2) : 0);?>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="cont">
									<?// element name?>
									<?if(strlen($arItem['FIELDS']['NAME'])):?>
										<div class="title">
											<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" itemprop="url"><?endif;?>
												<span itemprop="name"><?=$arItem['NAME']?></span>
											<?if($bDetailLink):?></a><?endif;?>
										</div>
									<?endif;?>
									<?if(strlen($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']) || strlen($arItem['DISPLAY_PROPERTIES']['PRICE_WEEKEND']['VALUE'])):?>
										<div class="foot">
											<?// element price?>
											<?if(strlen($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'])):?>
												<div class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
													<div class="price_new">
														<span class="price_name"><?=$arItem['DISPLAY_PROPERTIES']['PRICE']['NAME']?></span>
														<span class="price_val"><?=CResort::FormatPriceShema($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'])?></span>
													</div>
													<?if($arItem['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE']):?>
														<div class="price_old">
															<?=GetMessage('PRICE_OLD_TITLE')?> <span class="price_val"><?=$arItem['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE']?></span>
														</div>
													<?endif;?>
												</div>
											<?endif;?>
											<?if(strlen($arItem['DISPLAY_PROPERTIES']['PRICE_WEEKEND']['VALUE'])):?>
												<div class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
													<div class="price_new">
														<span class="price_name"><?=$arItem['DISPLAY_PROPERTIES']['PRICE_WEEKEND']['NAME']?></span>
														<span class="price_val"><?=CResort::FormatPriceShema($arItem['DISPLAY_PROPERTIES']['PRICE_WEEKEND']['VALUE'])?></span>
													</div>
													<?if($arItem['DISPLAY_PROPERTIES']['PRICE_WEEKEND_OLD']['VALUE']):?>
														<div class="price_old">
															<?=GetMessage('PRICE_OLD_TITLE')?> <span class="price_val"><?=$arItem['DISPLAY_PROPERTIES']['PRICE_WEEKEND_OLD']['VALUE']?></span>
														</div>
													<?endif;?>
												</div>
											<?endif;?>
										</div>
									<?endif;?>
									<?/*
									<?// element section name?>
									<?if(strlen($arItem['SECTION_NAME'])):?>
										<div class="section_name"><?=$arItem['SECTION_NAME']?></div>
									<?endif;?>
									*/?>
									
									<?// element status?>
									<?if(strlen($arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE'])):?>
										<span class="label label-<?=$arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE_XML_ID']?>" itemprop="description"><?=$arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE']?></span>
									<?endif;?>
									
									<?// element article?>
									<?if(strlen($arItem['DISPLAY_PROPERTIES']['ARTICLE']['VALUE'])):?>
										<span class="article" itemprop="description"><?=GetMessage('S_ARTICLE')?>:&nbsp;<span><?=$arItem['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']?></span></span>
									<?endif;?>
									
									<?// element preview text?>
									<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
										<div class="description" itemprop="description">
											<?if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):?>
												<p><?=$arItem['FIELDS']['PREVIEW_TEXT']?></p>
											<?else:?>
												<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
											<?endif;?>
										</div>
									<?endif;?>
											
									<?// element order button?>
									<?if($bOrderButton):?>
										<div class="controls">
											<a class="btn btn-default btn-sm" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=GetMessage('MORE')?></a>
											<span class="btn btn-default white btn-sm" data-event="jqm" data-param-id="<?=CCache::$arIBlocks[SITE_ID]['aspro_resort_form']['aspro_resort_form_price'][0]?>" data-autoload-TYPE="<?=$arItem['NAME']?>" data-name="order_product"><?=(strlen($arParams['S_ORDER_PRODUCT']) ? $arParams['S_ORDER_PRODUCT'] : GetMessage('S_ORDER_PRODUCT'))?></span>
										</div>
									<?endif;?>
								</div>
							</div>
							
						</div>
					</div>
				<?$textPart = ob_get_clean();?>
						
				<div class="wrap col-md-12 col-sm-12 col-xs-6">
					<div class="item<?=(is_array($arItem['PREVIEW_PICTURE']) && strlen($arItem['PREVIEW_PICTURE']['SRC']) ? '' : ' no_image')?><?=($bShowImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product">
						<div class="row">
							<?if(!$bShowImage):?>
								<div class="col-md-12">
									<?=$textPart?>
								</div>
							<?elseif($arParams['IMAGE_POSITION'] == 'right'):?>
								<div class="col-md-6 col-sm-6">
									<?=$textPart?>
								</div>
								<div class="col-md-6 col-sm-6">
									<?=$imgPart?>
								</div>
							<?else:?>
								<div class="col-md-6 col-sm-6">
									<?=$imgPart?>
								</div>
								<div class="col-md-6 col-sm-6">
									<?=$textPart?>
								</div>
							<?endif;?>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
		
		<?if($arParams['DISPLAY_BOTTOM_PAGER']):?>
			<?=$arResult['NAV_STRING']?>
		<?endif;?>
	<?endif;?>
	
	<?// section description?>
	<?if(is_array($arResult['SECTION']['PATH'])):?>
		<?$arCurSectionPath = end($arResult['SECTION']['PATH']);?>
		<?if(strlen($arCurSectionPath['DESCRIPTION']) && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false):?>
			<div class="cat-desc"><hr style="<?=(strlen($arResult['NAV_STRING']) && $arParams['DISPLAY_BOTTOM_PAGER'] ? 'margin-top:2px;' : 'border-color:transparent;margin-top:0;')?>" /><?=$arCurSectionPath['DESCRIPTION']?></div>
		<?endif;?>
	<?endif;?>
</div>
<script>
	$(document).ready(function () {
		$('.item-views .item .description').dotdotdot();
	});
	$(window).resize(function () {
		$('.item-views .item .description').dotdotdot();
		if(window.matchMedia('(max-width: 767px)').matches){
			$('.item-views .item').sliceHeight({'row': 'row'});
		}
	});
</script>
<?$frame->end();?>