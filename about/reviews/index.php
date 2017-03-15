<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы о сервисе");
?>

<?
$APPLICATION->IncludeComponent('tim:empty', 'reviews_serv', array());
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>