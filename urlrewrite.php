<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/catalog/([^/]+)/([^/]+)/(?:([^/]+)/)?(?:\\?(.*))?\$#",
		"RULE" => "SECTION_CODE=\$1&ELEMENT_CODE=\$2&ELEMENT_SECTION=\$3&\$4",
		"ID" => "",
		"PATH" => "/catalog/index.php",
	),
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),
	array(
		"CONDITION" => "#^/company/licenses/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/company/licenses/index.php",
	),
	array(
		"CONDITION" => "#^/company/partners/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/info/partners/index.php",
	),
	array(
		"CONDITION" => "#^/company/partners/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/company/partners/index.php",
	),
	array(
		"CONDITION" => "#^/company/reviews/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/company/reviews/index.php",
	),
	array(
		"CONDITION" => "#^/company/vacancy/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/company/vacancy/index.php",
	),
	array(
		"CONDITION" => "#^/company/history/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/company/history/index.php",
	),
	array(
		"CONDITION" => "#^/info/articles/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/info/articles/index.php",
	),
	array(
		"CONDITION" => "#^/company/staff/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/company/staff/index.php",
	),
	array(
		"CONDITION" => "#^/sanatorium/#",
		"RULE" => "",
		"ID" => "tim:catalog",
		"PATH" => "/sanatorium/index.php",
	),
	array(
		"CONDITION" => "#^/info/promo/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/info/promo/index.php",
	),
	array(
		"CONDITION" => "#^/info/stock/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/info/stock/index.php",
	),
	array(
		"CONDITION" => "#^/services/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/services/index.php",
	),
	array(
		"CONDITION" => "#^/projects/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/projects/index.php",
	),
	array(
		"CONDITION" => "#^/info/faq/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/info/faq/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/catalog/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/catalog/index_old.php",
	),
	array(
		"CONDITION" => "#^/events/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/events/index.php",
	),
	array(
		"CONDITION" => "#^/promo/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/promo/index.php",
	),
);

?>