<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/** @global CMain $APPLICATION */

$APPLICATION->SetTitle("Главная");

$APPLICATION->IncludeComponent('tim:empty', 'index_filter');

$APPLICATION->IncludeComponent('tim:empty', 'main_san', array());
$APPLICATION->IncludeComponent('tim:empty', 'main_slide_city', array());
$APPLICATION->IncludeComponent('tim:empty', 'main_comments', array());

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");