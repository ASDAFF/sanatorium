<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?ob_start();?>
	<?/*banners big start*/?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"front-banners-big",
		array(
			"IBLOCK_TYPE" => "aspro_resort_content",
			"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_resort_content"]["aspro_resort_advtbig"][0],
			"NEWS_COUNT" => "30",
			"SORT_BY1" => "SORT",
			"SORT_ORDER1" => "ASC",
			"SORT_BY2" => "ID",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "",
			"FIELD_CODE" => array(
				0 => "NAME",
				1 => "PREVIEW_TEXT",
				2 => "PREVIEW_PICTURE",
				3 => "DETAIL_PICTURE",
				4 => ""
			),
			"PROPERTY_CODE" => array(
				0 => "BANNERTYPE",
				1 => "TEXTCOLOR",
				2 => "LINKIMG",
				3 => "BUTTON1TEXT",
				4 => "BUTTON1LINK",
				4 => "BUTTON1CLASS",
				5 => "BUTTON2TEXT",
				6 => "BUTTON2LINK",
				7 => "BUTTON2CLASS",
				7 => ""
			),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600000",
			"CACHE_FILTER" => "Y",
			"CACHE_GROUPS" => "N",
			"PREVIEW_TRUNCATE_LEN" => "",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_STATUS_404" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"INCLUDE_SUBSECTIONS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "Новости",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
			"PAGER_SHOW_ALL" => "N",
			"AJAX_OPTION_ADDITIONAL" => ""
		),
		false
	);?>
	<?/*banners big end*/?>

	<?/*banners small start*/?>
	<div class="row">
		<div class="maxwidth-theme">
			<div class="col-md-12">
				<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front-small-advt", 
	array(
		"IBLOCK_TYPE" => "aspro_resort_content",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_resort_content"]["aspro_resort_advtsmall"][0],
		"NEWS_COUNT" => "30",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
			2 => "",
			3 => "",
			4 => "",
			5 => "",
			6 => "LINK",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SHOW_DETAIL_LINK" => "Y",
		"COMPONENT_TEMPLATE" => "front-small-advt",
		"SET_LAST_MODIFIED" => "N",
		"SHOW_SECTIONS" => "Y",
		"SHOW_GOODS" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
			</div>
		</div>
	</div>
	<?/*banners small end*/?>

	<?/*banners small start*/?>
	<div class="row">
		<div class="maxwidth-theme">
			<div class="col-md-12">
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list", 
					"front-banners-small", 
					array(
						"IBLOCK_TYPE" => "aspro_resort_content",
						"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_resort_content"]["aspro_resort_tizers"][0],
						"NEWS_COUNT" => "5",
						"SORT_BY1" => "SORT",
						"SORT_ORDER1" => "ASC",
						"SORT_BY2" => "ID",
						"SORT_ORDER2" => "ASC",
						"FILTER_NAME" => "",
						"FIELD_CODE" => array(
							0 => "NAME",
							1 => "",
						),
						"PROPERTY_CODE" => array(
							0 => "",
							1 => "LINK",
							2 => "ICON",
							3 => "",
						),
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600000",
						"CACHE_FILTER" => "Y",
						"CACHE_GROUPS" => "N",
						"PREVIEW_TRUNCATE_LEN" => "",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"SET_TITLE" => "N",
						"SET_STATUS_404" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"INCLUDE_SUBSECTIONS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
						"PAGER_SHOW_ALL" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"SET_BROWSER_TITLE" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_META_DESCRIPTION" => "N",
						"COMPONENT_TEMPLATE" => "front-banners-small",
						"SET_LAST_MODIFIED" => "N",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"SHOW_404" => "N",
						"MESSAGE_404" => ""
					),
					false
				);?>
			</div>
		</div>
	</div>
	<?/*banners small end*/?>
	
	<?/*services start*/?>
	<div class="greyline front_services_wrap">
		<div class="row">
			<div class="maxwidth-theme">
				<div class="col-md-12">
					<div class="front_tizers_wrap">
						<div class="front_title"><h3 class="title_block">К вашим услугам</h3></div>
						<?$GLOBALS['arServicesItemsFilter'] = array('!PROPERTY_SHOW_FRONT_PAGE' => false);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list", 
							"front-teasers-pictures", 
							array(
								"IBLOCK_TYPE" => "aspro_resort_content",
								"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_resort_content"]["aspro_resort_services"][0],
								"NEWS_COUNT" => "16",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "ASC",
								"FILTER_NAME" => "arServicesItemsFilter",
								"FIELD_CODE" => array(
									0 => "NAME",
									1 => "PREVIEW_TEXT",
									2 => "PREVIEW_PICTURE",
									3 => "",
								),
								"PROPERTY_CODE" => array(
									0 => "",
									1 => "LINK",
									2 => "ICON",
									3 => "",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "3600000",
								"CACHE_FILTER" => "Y",
								"CACHE_GROUPS" => "N",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => "",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
								"PAGER_SHOW_ALL" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"SHOW_DETAIL_LINK" => "Y",
								"SET_BROWSER_TITLE" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_META_DESCRIPTION" => "N",
								"COMPONENT_TEMPLATE" => "front-teasers-pictures",
								"SET_LAST_MODIFIED" => "N",
								"PAGER_BASE_LINK_ENABLE" => "N",
								"SHOW_404" => "N",
								"MESSAGE_404" => ""
							),
							false
						);?>
					</div>
				</div>
			</div>
		</div>		
	</div>	
	<?/*services end*/?>

	<?/*gallery start*/?>
	<?if($bGalleryIndex):?>
		<div class="row">
			<div class="maxwidth-theme">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="front_title">
								<h3 class="title_block">Фотогалерея</h3>
							</div>
							<?$APPLICATION->IncludeComponent(
								"bitrix:news.detail", 
								"front_gallery", 
								array(
									"ACTIVE_DATE_FORMAT" => "d.m.Y",
									"ADD_ELEMENT_CHAIN" => "N",
									"ADD_SECTIONS_CHAIN" => "N",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"BROWSER_TITLE" => "-",
									"CACHE_GROUPS" => "Y",
									"CACHE_TIME" => "36000000",
									"CACHE_TYPE" => "A",
									"CHECK_DATES" => "Y",
									"COMPONENT_TEMPLATE" => "front_gallery",
									"DETAIL_URL" => "",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"DISPLAY_DATE" => "N",
									"DISPLAY_NAME" => "N",
									"DISPLAY_PICTURE" => "N",
									"DISPLAY_PREVIEW_TEXT" => "N",
									"DISPLAY_TOP_PAGER" => "N",
									"ELEMENT_CODE" => "",
									"ELEMENT_ID" => "43",
									"FIELD_CODE" => array(
										0 => "",
										1 => "",
									),
									"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_resort_content"]["aspro_resort_gallery"][0],
									"IBLOCK_TYPE" => "aspro_resort_content",
									"IBLOCK_URL" => "",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"MESSAGE_404" => "",
									"META_DESCRIPTION" => "-",
									"META_KEYWORDS" => "-",
									"PAGER_BASE_LINK_ENABLE" => "N",
									"PAGER_SHOW_ALL" => "N",
									"PAGER_TEMPLATE" => ".default",
									"PAGER_TITLE" => "Страница",
									"PROPERTY_CODE" => array(
										0 => "",
										1 => "PHOTOS",
										2 => "",
									),
									"SET_BROWSER_TITLE" => "N",
									"SET_CANONICAL_URL" => "N",
									"SET_LAST_MODIFIED" => "N",
									"SET_META_DESCRIPTION" => "N",
									"SET_META_KEYWORDS" => "N",
									"SET_STATUS_404" => "N",
									"SET_TITLE" => "N",
									"SHOW_404" => "N",
									"USE_PERMISSIONS" => "N",
									"USE_SHARE" => "N",
									"SHOW_COUNT_PHOTOS" => "8"
								),
								false
							);?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?endif;?>
	<?/*gallery end*/?>

	<?/*company start*/?>
	<div class="row">
		<div class="maxwidth-theme">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<?$GLOBALS['arCompanyItemsFilter'] = array('!PROPERTY_COMPANY_BLOCK' => false);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list", 
							"front-company", 
							array(
								"IBLOCK_TYPE" => "aspro_resort_content",
								"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_resort_content"]["aspro_resort_company"][0],
								"NEWS_COUNT" => "1",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arCompanyItemsFilter",
								"FIELD_CODE" => array(
									0 => "NAME",
									1 => "PREVIEW_TEXT",
									2 => "PREVIEW_PICTURE",
									3 => "",
								),
								"PROPERTY_CODE" => array(
									0 => "",
									1 => "property1",
									2 => "property2",
									3 => "property3",
									4 => "property4",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "3600000",
								"CACHE_FILTER" => "Y",
								"CACHE_GROUPS" => "N",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "j F Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => "",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
								"PAGER_SHOW_ALL" => "Y",
								"AJAX_OPTION_ADDITIONAL" => "",
								"SHOW_DETAIL_LINK" => "Y",
								"SET_BROWSER_TITLE" => "Y",
								"SET_META_KEYWORDS" => "Y",
								"SET_META_DESCRIPTION" => "Y",
								"COMPONENT_TEMPLATE" => "front-company",
								"SET_LAST_MODIFIED" => "N",
								"PAGER_BASE_LINK_ENABLE" => "N",
								"SHOW_404" => "N",
								"MESSAGE_404" => ""
							),
							false
						);?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?/*company end*/?>
		
	<?/*start news*/?>	
	<div class="row">
		<div class="maxwidth-theme">
			<div class="col-md-12">
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list", 
					"front-news", 
					array(
						"IBLOCK_TYPE" => "aspro_resort_content",
						"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_resort_content"]["aspro_resort_news"][0],
						"NEWS_COUNT" => "3",
						"SORT_BY1" => "ACTIVE_FROM",
						"SORT_ORDER1" => "DESC",
						"SORT_BY2" => "SORT",
						"SORT_ORDER2" => "ASC",
						"FILTER_NAME" => "",
						"FIELD_CODE" => array(
							0 => "NAME",
							1 => "PREVIEW_PICTURE",
							2 => "DATE_ACTIVE_FROM",
							3 => "",
						),
						"PROPERTY_CODE" => array(
							0 => "",
							1 => "",
						),
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600000",
						"CACHE_FILTER" => "Y",
						"CACHE_GROUPS" => "N",
						"PREVIEW_TRUNCATE_LEN" => "",
						"ACTIVE_DATE_FORMAT" => "j F Y",
						"SET_TITLE" => "N",
						"SET_STATUS_404" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"INCLUDE_SUBSECTIONS" => "Y",
						"PAGER_TEMPLATE" => ".default",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
						"PAGER_SHOW_ALL" => "Y",
						"AJAX_OPTION_ADDITIONAL" => "",
						"SHOW_DETAIL_LINK" => "Y",
						"SET_BROWSER_TITLE" => "Y",
						"SET_META_KEYWORDS" => "Y",
						"SET_META_DESCRIPTION" => "Y"
					),
					false
				);?>
			</div>
		</div>
	</div>
	<?/*news end*/?>

	<?/*widget instagram start*/?>
	<?if($bInstagramIndex):?>	
		<script>
			$(document).ready(function() {
				$.ajax({
					url: '/include/note_instagram.php',
					success: function(html) {
						$('#instagram').html(html);
						$('.instagram .item').sliceHeight();
					}
				});
			});
		</script>
		<div class="maxwidth-theme" id="instagram"></div>
	<?endif;?>
	<?/*widget instagram end*/?>
		
	<?/*google map start*/?>
	<?if($bMapIndex):?>	
		<div class="main_map_block">
			<div class="maxwidth-theme">
				<div class="main_contacts_wrap">
					<?$APPLICATION->IncludeFile(SITE_DIR.'include/main_contacts.php', array(), array('MODE' => 'html', 'NAME' => GetMessage('INCLUDE_CONTACTS')));?>
				</div>
			</div>
			<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("map-block");?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:map.google.view", 
				"resort", 
				array(
					"INIT_MAP_TYPE" => "ROADMAP",
					"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:54.935858423779;s:10:\"google_lon\";d:59.221268310547;s:12:\"google_scale\";i:7;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:13:\"Аспро: Курорт\";s:3:\"LON\";d:59.230728149414;s:3:\"LAT\";d:54.914908688182;}}}",
					"MAP_WIDTH" => "100%",
					"MAP_HEIGHT" => "500",
					"CONTROLS" => array(
						//0 => "SMALL_ZOOM_CONTROL",
					),
					"OPTIONS" => array(
						0 => "ENABLE_DBLCLICK_ZOOM",
						1 => "ENABLE_DRAGGING",
					),
					"MAP_ID" => "",
					"COMPONENT_TEMPLATE" => "resort",
					'ZOOM_BLOCK' => array(
						'POSITION' => 'right bottom'
					)
				),
				false
			);
			?>
			<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("map-block", "");?>
		</div>
	<?endif;?>
	<?/*google map end*/?>

	<?/*question start*/?>
	<div class="color_block">
		<div class="row">
			<div class="maxwidth-theme">
				<div class="col-md-12">
					<div class="block front">
						<div class="row">
							<div class="col-md-3 col-sm-3">
								<div class="front-text1">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"PATH" => SITE_DIR."include/front-text1.php",
											"EDIT_TEMPLATE" => "standard.php"
										)
									);?>
								</div>
							</div>
							<div class="col-md-7 col-sm-6">
								<div class="front-text2">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"PATH" => SITE_DIR."include/front-text2.php",
											"EDIT_TEMPLATE" => "standard.php"
										)
									);?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
								<div class="front-text3">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"PATH" => SITE_DIR."include/front-text3.php",
											"EDIT_TEMPLATE" => "standard.php"
										)
									);?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?/*question end*/?>
<?$indexProlog = ob_get_clean();?>

<?ob_start();?>	
<?$indexEpilog = ob_get_clean();?>