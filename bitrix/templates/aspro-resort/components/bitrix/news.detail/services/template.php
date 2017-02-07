<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?// element name?>
<?if($arParams['DISPLAY_NAME'] != 'N' && strlen($arResult['NAME'])):?>
	<h2 class="title_block"><?=$arResult['NAME']?></h2>
<?endif;?>

<?// single detail image?>
<?if($arResult['FIELDS']['DETAIL_PICTURE']):?>
	<?
	$atrTitle = (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE'] : $arResult['NAME']));
	$atrAlt = (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT'] : $arResult['NAME']));
	?>
	<?if($arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'LEFT'):?>				
		<div class="detailimage image-left col-md-4 col-sm-4 col-xs-12"><a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" title="<?=$atrTitle?>"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></a></div>
	<?elseif($arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'RIGHT'):?>
		<div class="detailimage image-right col-md-4 col-sm-4 col-xs-12"><a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" title="<?=$atrTitle?>"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></a></div>
	<?elseif($arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'TOP'):?>
		<script type="text/javascript">
		$(document).ready(function() {
			$('section.page-top').remove();
			$('<div class="row"><div class="col-md-12"><div class="detailimage image-head"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></div></div></div>').insertBefore('.body > .main > .container > .row');
		});
		</script>
	<?else:?>
		<div class="detailimage image-wide"><a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" title="<?=$atrTitle?>"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></a></div>
	<?endif;?>
<?endif;?>

<?/* ask question block start */?>
<?if($arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'YES'):?>
	<div class="ask_a_question">
		<div class="inner">
			<span class="btn btn-default" data-event="jqm" data-param-id="<?=CCache::$arIBlocks[SITE_ID]['aspro_resort_form']['aspro_resort_question'][0]?>" data-autoload-need_product="<?=$arResult['NAME']?>" data-name="question"><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : GetMessage('S_ASK_QUESTION'))?></span></span>
			<div class="margin-bottom-20">
				<?$APPLICATION->IncludeComponent(
					 'bitrix:main.include',
					 '',
					 Array(
						  'AREA_FILE_SHOW' => 'file',
						  'PATH' => SITE_DIR.'include/ask_question.php',
						  'EDIT_TEMPLATE' => ''
					 )
				);?>
			</div>
		</div>
	</div>
<?endif;?>
<?/* ask question block end */?>

<?// date active from or dates period active?>
<?/*if(strlen($arResult['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arResult['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']))):?>
	<div class="period">
		<?if(strlen($arResult['DISPLAY_PROPERTIES']['PERIOD']['VALUE'])):?>
			<span class="label color_bg"><?=$arResult['DISPLAY_PROPERTIES']['PERIOD']['VALUE']?></span>
		<?else:?>
			<span class="label color_bg"><?=$arResult['DISPLAY_ACTIVE_FROM']?></span>
		<?endif;?>
	</div>
<?endif;*/?>

<?if(strlen($arResult['FIELDS']['DETAIL_TEXT']) || strlen($arResult['FIELDS']['PREVIEW_TEXT'])):?>
	<div class="content">
		<?// element preview text?>
		<?if(strlen($arResult['FIELDS']['PREVIEW_TEXT'])):?>
			<?if($arResult['PREVIEW_TEXT_TYPE'] == 'text'):?>
				<p><?=$arResult['FIELDS']['PREVIEW_TEXT'];?></p>
			<?else:?>
				<?=$arResult['FIELDS']['PREVIEW_TEXT'];?>
			<?endif;?>
		<?endif;?>

		<?// element detail text?>
		<?if(strlen($arResult['FIELDS']['DETAIL_TEXT'])):?>
			<?if($arResult['DETAIL_TEXT_TYPE'] == 'text'):?>
				<p><?=$arResult['FIELDS']['DETAIL_TEXT'];?></p>
			<?else:?>
				<?=$arResult['FIELDS']['DETAIL_TEXT'];?>
			<?endif;?>
		<?endif;?>
	</div>
<?endif;?>

<hr/>

<?/*tizers block start*/?>
<?$useBrands = ('Y' == $arParams['BRAND_USE']);
if($useBrands){?>
	<?$APPLICATION->IncludeComponent("bitrix:catalog.brandblock", "resort_list", array(
		"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"ELEMENT_ID" => $arResult['ID'],
		"ELEMENT_CODE" => "",
		"PROP_CODE" => $arParams["BRAND_PROP_CODE"],
		"CACHE_TYPE" => $arParams['CACHE_TYPE'],
		"CACHE_TIME" => $arParams['CACHE_TIME'],
		"CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
		"ELEMENT_COUNT" => 4,
		"TITLE_BLOCK" => (strlen($arParams['T_PROFIT']) ? $arParams['T_PROFIT'] : GetMessage('T_PROFIT')),
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

<?// display properties?>
<?$arDisplayPropertiesCodes = array_diff(array_keys($arResult['DISPLAY_PROPERTIES']), array('PERIOD', 'PHOTOS', 'DOCUMENTS', 'LINK_GOODS', 'LINK_STAFF', 'LINK_REVIEWS', 'LINK_PROJECTS', 'LINK_SERVICES', 'FORM_ORDER', 'FORM_QUESTION', 'PHOTOPOS'));?>
<?if($arResult['DISPLAY_PROPERTIES'] && $arDisplayPropertiesCodes):?>
	<div class="properties">
		<?foreach($arResult['DISPLAY_PROPERTIES'] as $PCODE => $arProperty):?>
			<?if(in_array($PCODE, $arDisplayPropertiesCodes)):?>
				<div class="property">
					<?if($arProperty['XML_ID']):?>
						<i class="fa <?=$arProperty['XML_ID']?>"></i>&nbsp;
					<?else:?>
						<?=$arProperty['NAME']?>:&nbsp;
					<?endif;?>
					<?if(is_array($arProperty['DISPLAY_VALUE'])):?>
						<?$val = implode('&nbsp;/ ', $arProperty['DISPLAY_VALUE']);?>
					<?else:?>
						<?$val = $arProperty['DISPLAY_VALUE'];?>
					<?endif;?>
					<?if($PCODE == 'SITE'):?>
						<!--noindex-->
						<?=str_replace("href=", "rel='nofollow' target='_blank' href=", $val);?>
						<!--/noindex-->
					<?elseif($PCODE == 'EMAIL'):?>
						<a href="mailto:<?=$val?>"><?=$val?></a>
					<?else:?>
						<?=$val?>
					<?endif;?>
				</div>
			<?endif;?>
		<?endforeach;?>
	</div>
<?endif;?>

<?// gallery?>
<?if($arResult['GALLERY']):?>
	<div class="wraps">		
		<h4 class="title_block"><?=(strlen($arParams['T_GALLERY']) ? $arParams['T_GALLERY'] : GetMessage('T_GALLERY'))?></h4>
		<div class="item-views portfolio front">	
			<div class="row" itemscope itemtype="http://schema.org/ItemList">
				<?foreach($arResult["GALLERY"] as $arPhoto){?>
					<div class="col-md-3 col-sm-4 col-xs-6">
						<div class="item wline">
							<a href="<?=$arPhoto["DETAIL"]["SRC"]?>" class="dark_block_animate fancybox_ext" rel="big_gallery" title="<?=$arPhoto["TITLE"];?>"></a>
							<div class="img_block scale_block_animate" style="background-image: url('<?=$arPhoto["PREVIEW"]["src"];?>');"></div>						
						</div>
					</div>
				<?}?>
			</div>
		</div>	
		<hr />	
	</div>
<?endif;?>

<?// order?>
<?if($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
	<div class="order-block">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-5 valign">
				<span class="btn btn-default btn-lg" data-event="jqm" data-param-id="<?=CCache::$arIBlocks[SITE_ID]['aspro_resort_form']['aspro_resort_order_services'][0]?>" data-name="order_services" data-autoload-service="<?=$arResult['NAME']?>"><span><?=(strlen($arParams['S_ORDER_SERVICE']) ? $arParams['S_ORDER_SERVICE'] : GetMessage('S_ORDER_SERVICE'))?></span></span>
			</div>
			<div class="col-md-8 col-sm-8 col-xs-7 valign">
				<div class="text">
					<?$APPLICATION->IncludeComponent(
						'bitrix:main.include',
						'',
						Array(
							'AREA_FILE_SHOW' => 'file',
							'PATH' => SITE_DIR.'include/ask_services.php',
							'EDIT_TEMPLATE' => ''
						)
					);?>
				</div>
			</div>
		</div>
	</div>
	<hr />
<?endif;?>

<?// docs files?>
<?if($arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['VALUE']):?>
	<div class="wraps">		
		<h4 class="title_block"><?=(strlen($arParams['T_DOCS']) ? $arParams['T_DOCS'] : GetMessage('T_DOCS'))?></h4>
		<div class="row docs">
			<?foreach($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $docID):?>
				<?$arItem = CResort::get_file_info($docID);?>
				<div class="col-md-6 item">
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
		<hr />
	</div>
<?endif;?>

<?
$frame = $this->createFrame('video')->begin('');
$frame->setAnimation(true);
?>
<?// video?>
<?if($arResult['VIDEO']):?>
	<div class="wraps">		
		<h4 class="title_block"><?=(strlen($arParams['T_VIDEO']) ? $arParams['T_VIDEO'] : GetMessage('T_VIDEO'))?></h4>
		<div class="row video">
			<?foreach($arResult['VIDEO'] as $i => $arVideo):?>
				<div class="col-md-6 item">
					<div class="video_body">
						<video id="js-video_<?=$i?>" width="350" height="217"  class="video-js" controls="controls" preload="metadata" data-setup="{}">
							<source src="<?=$arVideo["path"]?>" type='video/mp4' />
							<p class="vjs-no-js">
								To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video
							</p>
						</video>
					</div>
					<div class="title"><?=(strlen($arVideo["title"]) ? $arVideo["title"] : $i)?></div>
				</div>
			<?endforeach;?>
		</div>
		<hr />
	</div>
<?endif;?>
<?$frame->end();?>