<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$APPLICATION->SetPageProperty("MENU","N")?>
<?
$this->setFrameMode(true);
if(CResort::CheckSmartFilterSEF($arParams, __DIR__.'/section.php', $component)){
	return;
}
// get element
$arItemFilter = CResort::GetCurrentElementFilter($arResult['VARIABLES'], $arParams);

$arElement = CCache::CIblockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'N')), $arItemFilter, false, false, array('ID', 'PREVIEW_TEXT', 'IBLOCK_SECTION_ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'PROPERTY_LINK_PROJECTS'));
$arSort=array($arParams["SORT_BY1"]=>$arParams["SORT_ORDER1"], $arParams["SORT_BY2"]=>$arParams["SORT_ORDER2"]);
$arSort["CACHE"]=array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'Y');

$arElementNext = CCache::CIblockElement_GetList($arSort, array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "SECTION_ID" => $arElement["IBLOCK_SECTION_ID"], ">ID" => $arElement["ID"] ), false, false, array('ID', 'DETAIL_PAGE_URL', 'IBLOCK_ID'));

$arSection = CCache::CIBlockSection_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arElement['IBLOCK_ID']), 'MULTI' => 'N')), CResort::GetCurrentSectionFilter($arResult['VARIABLES'], $arParams), false, array('ID', 'NAME', 'SECTION_PAGE_URL'));
$url=($arSection["SECTION_PAGE_URL"] ? $arSection["SECTION_PAGE_URL"] : $arResult['FOLDER'].$arResult['URL_TEMPLATES']['news']);
?>
<?if(!$arElement && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="alert alert-warning"><?=GetMessage("ELEMENT_NOTFOUND")?></div>
<?elseif(!$arElement && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?CResort::goto404Page();?>
<?else:?>
	<?CResort::AddMeta(
		array(
			'og:description' => $arElement['PREVIEW_TEXT'],
			'og:image' => (($arElement['PREVIEW_PICTURE'] || $arElement['DETAIL_PICTURE']) ? CFile::GetPath(($arElement['PREVIEW_PICTURE'] ? $arElement['PREVIEW_PICTURE'] : $arElement['DETAIL_PICTURE'])) : false),
		)
	);?>
	<?if ($APPLICATION->GetShowIncludeAreas()){?>
		<div class="edit_area_block"></div></div></div></div></div>		
		<div><div><div><div>
	<?}else{?>
	    </div></div>
	<?}?>
	<div class="catalog detail" itemscope itemtype="http://schema.org/Product">
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.detail",
			"catalog",
			Array(
				"S_ASK_QUESTION" => $arParams["S_ASK_QUESTION"],
				"S_ORDER_PRODUCT" => $arParams["S_ORDER_PRODUCT"],
				"T_GALLERY" => $arParams["T_GALLERY"],
				"T_DOCS" => $arParams["T_DOCS"],
				"T_PROJECTS" => $arParams["T_PROJECTS"],
				"T_CHARACTERISTICS" => $arParams["T_CHARACTERISTICS"],
				"T_VIDEO" => $arParams["T_VIDEO"],
				"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
				"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
				"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
				"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
				"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
				"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
				"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"META_KEYWORDS" => $arParams["META_KEYWORDS"],
				"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
				"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
				"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
				"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
				"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
				"ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],
				"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
				"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
				"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
				"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
				"CHECK_DATES" => $arParams["CHECK_DATES"],
				"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
				"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
				"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
				"USE_SHARE" 			=> $arParams["USE_SHARE"],
				"SHARE_HIDE" 			=> $arParams["SHARE_HIDE"],
				"SHARE_TEMPLATE" 		=> $arParams["SHARE_TEMPLATE"],
				"SHARE_HANDLERS" 		=> $arParams["SHARE_HANDLERS"],
				"SHARE_SHORTEN_URL_LOGIN"	=> $arParams["SHARE_SHORTEN_URL_LOGIN"],
				"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
				"BRAND_PROP_CODE" => $arParams["DETAIL_BRAND_PROP_CODE"],
				"BRAND_USE" => $arParams["DETAIL_BRAND_USE"],
			),
			$component
		);?>
	</div>
	<div class="row nomargin under_content">
		<div class="maxwidth-theme">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div style="clear:both"></div>
						<a class="back-url pull-left" href="<?=$url;?>"><i class="fa fa-chevron-left"></i><?=GetMessage('BACK_LINK')?></a>
						<?if($arElementNext["ID"]){?>
							<a class="back-url next pull-right" href="<?=$arElementNext["DETAIL_PAGE_URL"];?>"><?=GetMessage('NEXT_LINK')?><i class="fa fa-chevron-right"></i></a>
						<?}?>
						<div style="clear:both"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<?// projects links?>
		<?if(in_array('LINK_PROJECTS', $arParams['DETAIL_PROPERTY_CODE']) && $arElement['PROPERTY_LINK_PROJECTS_VALUE']):?>
			<?$arProjects = CCache::CIBlockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]['aspro_resort_content']['aspro_resort_projects'][0]), 'MULTI' => 'Y')), array('ID' => $arElement['PROPERTY_LINK_PROJECTS_VALUE'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'), false, false, array('ID', 'NAME', 'IBLOCK_ID', 'DETAIL_PAGE_URL', 'PREVIEW_PICTURE', 'DETAIL_PICTURE'));?>
			
			<?if ($APPLICATION->GetShowIncludeAreas()){?>
				</div></div></div></div></div>		
				<div><div><div><div>
			<?}else{?>
			    </div></div>
			<?}?>
			<div class="greyline">
				<div class="row">
					<div class="maxwidth-theme">
						<div class="col-md-12">
							<div class="catalog item-views table front detail">
								<div class="top_wrapper_block">
									<h3 class="title_block"><?=(strlen($arParams['T_PROJECTS']) ? $arParams['T_PROJECTS'] : GetMessage('T_PROJECTS'))?></h3>
									<?
									$countmd = 4;
									$countsm = 3;
									$countxs = 2;
									$countxsm = 1;
									$colmd = 3;
									$colsm = 4;
									$colxs = 6;
									$qntyItems = count($arProjects);
									?>
									<div class="flexslider unstyled row" data-plugin-options='{"animation": "slide", "directionNav": true, "itemMargin":30, "controlNav" :true, "animationLoop": true, "slideshow": false, "counts": [<?=$countmd?>, <?=$countsm?>, <?=$countxs?>, <?=$countxsm?>]}'>
										<ul class="slides">
											<?foreach($arProjects as $i => $arItem){
												// edit/add/delete buttons for edit mode
												$arItemButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], $arItem['ID'], 0, array('SESSID' => false, 'CATALOG' => true));
												$this->AddEditAction($arItem['ID'], $arItemButtons['edit']['edit_element']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
												$this->AddDeleteAction($arItem['ID'], $arItemButtons['edit']['delete_element']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
												$thumb = $arItem['PREVIEW_PICTURE'] ? $arItem['PREVIEW_PICTURE'] : $arItem['DETAIL_PICTURE'];
												if($thumb){
													$img=CFile::ResizeImageGet($thumb, array('width' => 300, 'height' => 260), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
													// print_r($arItem);
												}?>
												<li class="col-md-<?=$colmd?> col-sm-<?=$colsm?> col-xs-<?=$colxs?>">
													<div class="item" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
														<div>
															<div class="image">
																<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="blink">
																	<?if($thumb):?>
																		<img src="<?=$img["src"];?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" class="img-responsive" />
																	<?else:?>
																		<img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/images/noimage.png" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" />
																	<?endif;?>
																</a>
															</div>																		
															<div class="text">
																<div class="cont">
																	<?// element name?>
																	<div class="title">
																		<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="color_link">
																			<span><?=$arItem['NAME']?></span>
																		</a>
																	</div>								
																</div>
															</div>
														</div>
													</div>
												</li>
											<?}?>
										</ul>
									</div>
									<script type="text/javascript">
									$(document).ready(function(){
										$('.catalog.item-views.table .item .image').sliceHeight({slice: <?=$qntyItems?>, autoslicecount: false, lineheight: -3});
										// $('.catalog.item-views.table .title').sliceHeight({slice: <?=$qntyItems?>, autoslicecount: false});
										$('.catalog.item-views.table .cont').sliceHeight({slice: <?=$qntyItems?>, autoslicecount: false});
										$('.catalog.item-views.table .item').sliceHeight({slice: <?=$qntyItems?>, autoslicecount: false, classNull: '.footer_button'});
									});
									</script>									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?endif;?>
	
	<?
	if(is_array($arElement['IBLOCK_SECTION_ID']) && count($arElement['IBLOCK_SECTION_ID']) > 1){
		CResort::CheckAdditionalChainInMultiLevel($arResult, $arParams, $arElement);
	}
	?>
	<script type="text/javascript">
		$('.container .maxwidth-theme .col-md-3.left-menu-md').remove();
		$('.container .maxwidth-theme .content-md').removeClass('col-md-9');
		$('.container .maxwidth-theme .content-md').removeClass('col-sm-9');
		$('.container .maxwidth-theme .content-md').removeClass('col-xs-8');
		$('.container .maxwidth-theme .content-md').addClass('col-md-12');
		$('.body').addClass('detail_page');
	</script>
<?endif;?>
