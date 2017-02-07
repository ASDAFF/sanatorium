<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?// element name?>
<?if($arParams['DISPLAY_NAME'] != 'N' && strlen($arResult['NAME'])):?>
	<h2 class="title_block" itemprop="name"><?=$arResult['NAME']?></h2>
<?endif;?>
<div class="greyline">
	<div class="row">
		<div class="maxwidth-theme">
			<div class="col-md-12">
				<div class="head<?=($arResult['GALLERY'] ? '' : ' wti')?>">
					<div class="row">
						<?if($arResult['GALLERY']):?>
							<div class="col-md-7 col-sm-7">
								<div class="row galery">
									<div class="inner">
										<?$countAll = count($arResult['GALLERY']);?>
										<?if(($countAll)>1){?>
											<div class="flexslider unstyled row" id="slider" data-plugin-options='{"animation": "slide", "directionNav": true, "controlNav" :false, "animationLoop": true, "sync": ".detail .galery #carousel", "slideshow": false, "counts": [1, 1, 1]}'>
										<?}else{?>
											<div class="flexslider unstyled row" id="slider">
										<?}?>
											<ul class="slides items">
												<?$countAll = count($arResult['GALLERY']);?>
												<?foreach($arResult['GALLERY'] as $i => $arPhoto):?>
													<li class="col-md-1 col-sm-1 item">
														<a href="<?=$arPhoto['DETAIL']['SRC']?>" class="fancybox" rel="gallery" target="_blank" title="<?=$arPhoto['TITLE']?>">
															<img src="<?=$arPhoto['PREVIEW']['src']?>" class="img-responsive inline" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" itemprop="image" />
															<span class="zoom">
																<i></i>
															</span>
														</a>
													</li>
												<?endforeach;?>
											</ul>
										</div>
										<?if($arResult['DISPLAY_PROPERTIES']['STIKERS']['VALUE']):?>
											<div class="wrap_stickers">
												<div class="stickers">
													<?foreach($arResult["DISPLAY_PROPERTIES"]["STIKERS"]["VALUE_XML_ID"] as $key=>$class){?>
														<div class="sticker_<?=strtolower($class);?>"><?=$arResult["DISPLAY_PROPERTIES"]["STIKERS"]["VALUE"][$key]?></div>
													<?}?>
												</div>
											</div>
										<?endif;?>
									</div>
									<script type="text/javascript">
									$(document).ready(function(){
										$('.detail .galery .inner .item').sliceHeight({slice: <?=$countAll?>, lineheight: -3, opacity:"Y", minHeight:475});
									});
									</script>
								</div>
							</div>
						<?endif;?>
						
						<div class="<?=($arResult['GALLERY'] ? 'col-md-5 col-sm-5' : 'col-md-12 col-sm-12');?>">
							<div class="info" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
								<?
								$frame = $this->createFrame('info')->begin('');
								$frame->setAnimation(true);
								?>
								<?/*if($arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE_XML_ID'] || strlen($arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE'])):?>
									<div class="hh">
										<?if(strlen($arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE'])):?>
											<span class="label label-<?=$arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE_XML_ID']?>" itemprop="availability" href="http://schema.org/InStock"><?=$arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE']?></span>
										<?endif;?>
										<?if(strlen($arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE'])):?>
											<span class="article">
												<?=GetMessage('ARTICLE')?>&nbsp;<span><?=$arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']?></span>
											</span>
										<?endif;?>
										<hr/>
									</div>
								<?endif;*/?>
								<?
								$isSizes=($arResult['DISPLAY_PROPERTIES']['SIZE']['VALUE'] ? true : false);
								$isPrices=(strlen($arResult['DISPLAY_PROPERTIES']['PRICE']['VALUE']) || strlen($arResult['DISPLAY_PROPERTIES']['PRICE_WEEKEND']['VALUE']) ? true : false);
								?>
								<?if($isPrices || $isSizes):?>
									<div class="row1 foot big">
										<?if($isSizes){?>
											<div class="item_f <?=(!$isPrices ? "" : "wprice");?><?//=(!$isPrices ? 'col-md-12 col-sm-12 col-xs-12' : 'col-md-4 col-sm-4 col-xs-12')?>">
													<div class="size_block">
														<?=$arResult['DISPLAY_PROPERTIES']['SIZE']['VALUE'];?><?=GetMessage('SIZE_UNIT');?>
													</div>
											</div>
										<?}?>
										<?// element price?>
										<?if(strlen($arResult['DISPLAY_PROPERTIES']['PRICE']['VALUE'])):?>
											<div class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
												<div class="price_new">
													<span class="price_name"><?=$arResult['DISPLAY_PROPERTIES']['PRICE']['NAME']?></span>
													<span class="price_val"><?=CResort::FormatPriceShema($arResult['DISPLAY_PROPERTIES']['PRICE']['VALUE'])?></span>
												</div>
												<?if($arResult['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE']):?>
													<div class="price_old">
														<?=GetMessage('PRICE_OLD_TITLE')?> <span class="price_val"><?=$arResult['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE']?></span>
													</div>
												<?endif;?>
											</div>
										<?endif;?>
										<?if(strlen($arResult['DISPLAY_PROPERTIES']['PRICE_WEEKEND']['VALUE'])):?>
											<div class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
												<div class="price_new">
													<span class="price_name"><?=$arResult['DISPLAY_PROPERTIES']['PRICE_WEEKEND']['NAME']?></span>
													<span class="price_val"><?=CResort::FormatPriceShema($arResult['DISPLAY_PROPERTIES']['PRICE_WEEKEND']['VALUE'])?></span>
												</div>
												<?if($arResult['DISPLAY_PROPERTIES']['PRICE_WEEKEND_OLD']['VALUE']):?>
													<div class="price_old">
														<?=GetMessage('PRICE_OLD_TITLE')?> <span class="price_val"><?=$arResult['DISPLAY_PROPERTIES']['PRICE_WEEKEND_OLD']['VALUE']?></span>
													</div>
												<?endif;?>
											</div>
										<?endif;?>
									</div>
								<?endif;?>
								<?if(strlen($arResult['FIELDS']['PREVIEW_TEXT'])):?>
									<div class="previewtext" itemprop="description">
										<?// element detail text?>
										<?if($arResult['DETAIL_TEXT_TYPE'] == 'text'):?>
											<p><?=$arResult['FIELDS']['PREVIEW_TEXT'];?></p>
										<?else:?>
											<?=$arResult['FIELDS']['PREVIEW_TEXT'];?>
										<?endif;?>
									</div>
								<?endif;?>
								<div class="more_block"><span><?=GetMessage('MORE_TEXT_BOTTOM');?></span></div>
								<?if($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES' || $arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'YES'):?>
									<div class="order">
										<?if($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
											<span class="btn btn-default" data-event="jqm" data-param-id="<?=CCache::$arIBlocks[SITE_ID]['aspro_resort_form']['aspro_resort_form_price'][0]?>" data-name="order_product" data-product="<?=$arResult['NAME']?>" data-autoload-TYPE="<?=$arResult['NAME']?>"><?=(strlen($arParams['S_ORDER_PRODUCT']) ? $arParams['S_ORDER_PRODUCT'] : GetMessage('S_ORDER_PRODUCT'))?></span>
										<?endif;?>
										<?if($arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'YES'):?>
											<span class="btn btn-default white" data-event="jqm" data-param-id="<?=CCache::$arIBlocks[SITE_ID]['aspro_resort_form']['aspro_resort_question'][0]?>" data-name="question" data-autoload-NEED_PRODUCT="<?=$arResult['NAME']?>"><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : GetMessage('S_ASK_QUESTION'))?></span>
										<?endif;?>
										<?/*<div class="text"><?=GetMessage('MORE_TEXT')?></div>*/?>
									</div>
								<?endif;?>
								<?if($arParams['USE_SHARE'] == 'Y'):?>
									<div class="share">
										<hr />
										<span class="text"><?=GetMessage('SHARE_TEXT')?></span>
										<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
										<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8" async="async"></script>
										<div class="ya-share2" data-services="vkontakte,facebook,twitter,viber,whatsapp,odnoklassniki,moimir"></div>
									</div>
								<?endif;?>
								<?$frame->end();?>
							</div>
						</div>
					</div>
				</div>

				<?/*tizers block start*/?>
				<?$useBrands = ('Y' == $arParams['BRAND_USE']);
				if($useBrands){?>
					<?$APPLICATION->IncludeComponent("bitrix:catalog.brandblock", "resort", array(
						"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
						"IBLOCK_ID" => $arParams['IBLOCK_ID'],
						"ELEMENT_ID" => $arResult['ID'],
						"ELEMENT_CODE" => "",
						"PROP_CODE" => $arParams["BRAND_PROP_CODE"],
						"CACHE_TYPE" => $arParams['CACHE_TYPE'],
						"CACHE_TIME" => $arParams['CACHE_TIME'],
						"CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
						"ELEMENT_COUNT" => 5,
						"WIDTH" => "60",
						"WIDTH_SMALL" => "60",
						"HEIGHT" => "60",
						"HEIGHT_SMALL" => "60",
						),
						$component,
						array("HIDE_ICONS" => "Y")
					);?>
				<?}?>
				<?/*tizers block end*/?>				
			</div>
		</div>
	</div>
</div>

<div class="row nomargin under_content">
	<div class="maxwidth-theme">
		<div class="col-md-12">
			<div class="scroll_block"></div>

			<?/*element detail textblock start*/?>
			<?if(strlen($arResult['FIELDS']['DETAIL_TEXT'])):?>
				<div class="content" itemprop="description">
					<h4 class="title_block"><?=(strlen($arParams['T_DESCRIPTION']) ? $arParams['T_DESCRIPTION'] : GetMessage('T_DESCRIPTION'))?></h4><br>
					<?if($arResult['DETAIL_TEXT_TYPE'] == 'text'):?>
						<p><?=$arResult['FIELDS']['DETAIL_TEXT'];?></p>
					<?else:?>
						<?=$arResult['FIELDS']['DETAIL_TEXT'];?>
					<?endif;?>
				</div>
			<?endif;?>
			<?/*element detail text block end*/?>
			
			
			<?/*element detail planirovki start*/?>
			<?if ($arResult['PLANIROVKA']):?>
				<?$intCountPlans=count($arResult['PLANIROVKA']);
				switch($intCountPlans){
					case 2: $col='6'; $slice=2; break;
					case 1: $col='12'; $slice=1; break;
					default: $col='4'; $slice=3; break;
				}?>
				<div class="row plans_list">
					<?foreach($arResult['PLANIROVKA'] as $arFile){?>
						<div class="col-md-<?=$col;?> galery">
							<div class="plans_block border_block item">
								<div class="img_block">
									<a href="<?=$arFile['DETAIL']['SRC']?>" class="fancybox blink" rel="plans" target="_blank" title="<?=$arFile['TITLE']?>">
										<img class="img-responsive" src="<?=$arFile["PREVIEW"]["src"]?>" alt="<?=$arFile["ALT"];?>" title="<?=$arFile["TITLE"];?>"/> 
										<span class="zoom">
											<i></i>
										</span>	
									</a>
								</div>
								<div class="text">
									<?=$arFile["TITLE"];?>
								</div>
							</div>
						</div>
					<?}?>
				</div>
				<hr/>
				<script type="text/javascript">
					$(document).ready(function(){
						$('.detail .plans_block .img_block').sliceHeight({slice: <?=$slice?>, lineheight: -3});
						$('.detail .plans_block .text').sliceHeight({slice: <?=$slice?>});
						//$('.detail .plans_block').sliceHeight({'opacity':'Y'});
					})
				</script>
			<?endif;?>
			<?/*element detail planirovki end*/?>		
			

			<?/*characteristics and docs files block start*/?>
			<?if($arResult['CHARACTERISTICS'] || $arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['VALUE']):?>
				<div class="row">
					<?// characteristics?>
					<?if($arResult['CHARACTERISTICS']):?>
						<div class="col-md-<?=($arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['VALUE'] ? '8' : '8')?>">
							<div class="wraps">		
								<h4 class="title_block"><?=(strlen($arParams['T_CHARACTERISTICS']) ? $arParams['T_CHARACTERISTICS'] : GetMessage('T_CHARACTERISTICS'))?></h4>
								<div class="chars">
									<div class="char-wrapp">
										<table class="props_table">
											<?foreach($arResult['CHARACTERISTICS'] as $keyProp => $arProp):?>
												<tr class="char">
													<td class="char_name <?=($arProp['HINT'] ? 'whint' : '');?>">												
														<span>
															<?=$arProp['NAME']?>
															<?if($arProp['HINT']):?>
																<div class="hint">
																	<span class="icons" data-toggle="tooltip" data-placement="top" title="<?=$arProp['HINT']?>"><i>?</i></span>
																</div>
															<?endif;?>
														</span>
													</td>
													<td class="char_value">
														<span>
															<?if(is_array($arProp['DISPLAY_VALUE'])):?>
																<?foreach($arProp['DISPLAY_VALUE'] as $key => $value):?>
																	<?if($arProp['DISPLAY_VALUE'][$key + 1]):?>
																		<?=$value.'&nbsp;/ '?>
																	<?else:?>
																		<?=$value?>
																	<?endif;?>
																<?endforeach;?>
															<?else:?>
																<?=$arProp['DISPLAY_VALUE']?><?=(strpos($keyProp, 'SIZE_') !== false ? '&nbsp'.GetMessage('SIZE_UNIT') : '')?>
															<?endif;?>
														</span>
													</td>
												</tr>
											<?endforeach;?>
										</table>
									</div>
								</div>					
							</div>
						</div>
					<?endif;?>
					<?// docs files?>
					<?if($arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['VALUE']):?>
						<div class="col-md-<?=($arResult['CHARACTERISTICS'] ? '4' : '12')?>">
							<div class="wraps">
								<h4 class="title_block"><?=(strlen($arParams['T_DOCS']) ? $arParams['T_DOCS'] : GetMessage('T_DOCS'))?></h4>
								<div class="row docs">
									<?foreach($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $docID):?>
										<?$arItem = CResort::get_file_info($docID);?>
										<div class="col-md-12 item">
											<?
											$fileName = substr($arItem['ORIGINAL_NAME'], 0, strrpos($arItem['ORIGINAL_NAME'], '.'));
											$fileTitle = (strlen($arItem['DESCRIPTION']) ? $arItem['DESCRIPTION'] : $fileName);
											?>
											<div class="icons  <?=$arItem['TYPE']?>">
												<a href="<?=$arItem['SRC']?>" target="_blank" title="<?=$fileTitle?>"></a>
											</div>
											<div class="text">
												<a href="<?=$arItem['SRC']?>" target="_blank" title="<?=$fileTitle?>"><?=$fileTitle?></a>
												<?=GetMessage('CT_NAME_SIZE')?>:
												<span><?=CResort::filesize_format($arItem['FILE_SIZE']);?></span>
											</div>
										</div>
									<?endforeach;?>
								</div>
							</div>
						</div>
					<?endif;?>
				</div>
				<hr class="big" />
			<?endif;?>
			<?/*characteristics and docs files block end*/?>

			<?/*big galery block start*/?>
				<?if($arResult["GALLERY_BIG"]){?>
					<h4 class="title_block"><?=(strlen($arParams['T_GALLERY']) ? $arParams['T_GALLERY'] : GetMessage('T_GALLERY'))?></h4>
					<div class="item-views portfolio front">	
						<div class="row" itemscope itemtype="http://schema.org/ItemList">
							<?foreach($arResult["GALLERY_BIG"] as $arBigItem){?>
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="item wline">
										<a href="<?=$arBigItem["DETAIL"]["SRC"]?>" class="dark_block_animate fancybox_ext" rel="big_gallery" title="<?=$arBigItem["TITLE"];?>"></a>
										<div class="img_block scale_block_animate" style="background-image: url('<?=$arBigItem["PREVIEW"]["src"];?>');"></div>						
									</div>
								</div>
							<?}?>
						</div>
					</div>
				<?}?>
			<?/*big galery block end*/?>

			<?
			$frame = $this->createFrame('order')->begin('');
			$frame->setAnimation(true);
			?>
			<?// order?>
			<?if($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
				<div class="order-block">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-5 valign">
							<span class="btn btn-default btn-lg" data-event="jqm" data-param-id="<?=CCache::$arIBlocks[SITE_ID]['aspro_resort_form']['aspro_resort_form_price'][0]?>" data-name="order_product" data-product="<?=$arResult['NAME']?>" data-autoload-TYPE="<?=$arResult['NAME']?>"><?=(strlen($arParams['S_ORDER_PRODUCT']) ? $arParams['S_ORDER_PRODUCT'] : GetMessage('S_ORDER_PRODUCT'))?></span>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-7 valign">
							<div class="text">
								<span>
									<?$APPLICATION->IncludeComponent(
										'bitrix:main.include',
										'',
										Array(
											'AREA_FILE_SHOW' => 'file',
											'PATH' => SITE_DIR.'include/ask_product.php',
											'EDIT_TEMPLATE' => ''
										)
									);?>
								</span>
							</div>
						</div>
					</div>
				</div>
			<?endif;?>
			<?$frame->end();?>
		</div>
	</div>
</div>