<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('aspro.resort');
$id = (isset($_REQUEST["id"]) ? $_REQUEST["id"] : false);
$arTheme = CResort::GetFrontParametrsValues(SITE_ID);
$captcha = ($arTheme["USE_CAPTCHA_FORM"] === "Y" ? "Y" : "N");
$isCallBack = $id == CCache::$arIBlocks[SITE_ID]["aspro_resort_form"]["aspro_corporation_callback"][0];
$isCalculate = $id == CCache::$arIBlocks[SITE_ID]["aspro_resort_form"]["aspro_resort_form_price"][0];
$successMessage = ($isCallBack ? "<p>Наш менеджер перезвонит вам в ближайшее время.</p><p>Спасибо за ваше обращение!</p>" : "Спасибо! Ваше сообщение отправлено!");
$template=($isCalculate ? "popup_cust" : "popup");
?>
<span class="jqmClose top-close fa fa-close"></span>
<?if($id):?>
	<?$APPLICATION->IncludeComponent(
		"aspro:form.resort", $template,
		Array(
			"IBLOCK_TYPE" => "aspro_resort_form",
			"IBLOCK_ID" => $id,
			"USE_CAPTCHA" => $captcha,
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "N",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "100000",
			"AJAX_OPTION_ADDITIONAL" => "",
			//"IS_PLACEHOLDER" => "Y",
			"SUCCESS_MESSAGE" => $successMessage,
			"SEND_BUTTON_NAME" => "Отправить",
			"SEND_BUTTON_CLASS" => "btn btn-default",
			"DISPLAY_CLOSE_BUTTON" => "Y",
			"POPUP" => "Y",
			"CLOSE_BUTTON_NAME" => "Закрыть",
			"CLOSE_BUTTON_CLASS" => "jqmClose btn btn-default bottom-close"
		)
	);?>
<?endif;?>