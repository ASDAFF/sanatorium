<?
/** @global CMain $APPLICATION */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Санатории КМВ на карте");

$APPLICATION->IncludeComponent('tim:empty', 'maps');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");