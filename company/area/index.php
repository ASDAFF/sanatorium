<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Фотогалерея и схема участка");
?><p>
	 На территории базы отдыха «Аспро&nbsp;Resort» вы найдете всё необходимое для отдыха и даже больше! 300 метров береговой зоны оборудовано для безопасного купания и активных водных развлечений.&nbsp;
</p>
<p>
	 Также вы можете посетить пейнтбольный клуб, оздоровительный комплекс, воспользоваться теннисным кортом, футбольным полем и площадками для игр в баскетбол и волейбол. База разделена на 3 зоны: санаторий, коттеджный посёлок и кемпинг. На асфальтированных дорожках можно прокатиться на лонгборде или роликах, а лесные тропинки подойдут для велопрогулок.
</p>
<p>
</p>
<div class="area_image">
 <img src="<?=SITE_DIR?>include/images/territory.jpg" class="img-responsive" alt="Территория" title="Территория">
</div>
<div class="row">
	<div class="col-md-12">
		<h3 class="title_block">Фотогалерея</h3>
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"gallery",
	Array(
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
		"FIELD_CODE" => array(0=>"",1=>"",),
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
		"PROPERTY_CODE" => array(0=>"",1=>"PHOTOS",),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N"
	)
);?>
	</div>
</div>
 <br>
 <br>
<h3 class="title_block">Видео</h3>
<iframe width="960" height="720" src="https://www.youtube.com/embed/ET21OUWsJSA?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>