<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Сервис онлайн бронирования санаториев на КМВ — «Путевочка». Заказать оздоровительные путевки в санатории Пятигорска, Ессентуков, Кисловодска, Железноводска можно по телефону 8 800 775 2604.");
$APPLICATION->SetPageProperty("keywords", "бронироание санаториев, заказ оздоровительных путевок");
$APPLICATION->SetPageProperty("title", "Путевочка — сервис бронирования санаториев КМВ, заказ путевок в санатории КМВ");
$APPLICATION->SetPageProperty("og_title", "Путевочка");

/** @global CMain $APPLICATION */

$APPLICATION->SetTitle("Главная");

$APPLICATION->IncludeComponent('tim:empty', 'index_filter');

$APPLICATION->IncludeComponent('tim:empty', 'main_san');
$APPLICATION->IncludeComponent('tim:empty', 'main_slide_city');
$APPLICATION->IncludeComponent('tim:empty', 'reviews.list');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");