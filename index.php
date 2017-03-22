<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?><?$APPLICATION->SetTitle("Главная");?> <!-- Каталог !-->

<?
$APPLICATION->IncludeComponent('tim:filter_top', '', array());
?>
<?
$APPLICATION->IncludeComponent('tim:empty', 'main_san', array());
?>
<?
$APPLICATION->IncludeComponent('tim:empty', 'main_slide_city', array());
?>
<?
$APPLICATION->IncludeComponent('tim:empty', 'main_comments', array());
?>

 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>