<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/** @global CMain $APPLICATION */

$APPLICATION->SetTitle("Главная");

$APPLICATION->IncludeComponent('tim:empty', 'index_filter');

$APPLICATION->IncludeComponent('tim:empty', 'main_san');
$APPLICATION->IncludeComponent('tim:empty', 'main_slide_city');
$APPLICATION->IncludeComponent('tim:empty', 'reviews.list');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");