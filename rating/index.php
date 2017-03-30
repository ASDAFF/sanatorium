<?
/** @global CMain $APPLICATION */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рейтинг санаториев");

$APPLICATION->IncludeComponent('tim:empty', 'rating');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");