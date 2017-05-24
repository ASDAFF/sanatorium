<?
/** @global CMain $APPLICATION */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Цены");
$APPLICATION->SetTitle("Цены");

$APPLICATION->IncludeComponent('tim:empty', 'prices');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
