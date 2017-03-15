<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы");
?>
<?
$APPLICATION->IncludeComponent('tim:empty', 'reviews', array());
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>