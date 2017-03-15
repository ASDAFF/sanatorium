<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

setlocale(LC_ALL, 'ru_RU.UTF-8');

$name = $_POST["name"];
$txt = $_POST["txt"];
$city = $_POST["city"];
$san = $_POST["san"];
$mail = $_POST["mail"];
$mark = $_POST["mark"];
$date = strftime("%d %B %Y")." года";

CModule::IncludeModule('iblock');
if ($name != "" && $txt!= "" && $city != "" && $san != "" && $mail != "mail") {

    $el = new CIBlockElement;

    $PROP = array();
    $PROP['SAN_NAME']["VALUE"] = $san;
    $PROP['CITY']["VALUE"] = $city;
    $PROP['MAIL']["VALUE"] = $mail;
    $PROP['MARK']["VALUE"] = $mark;
    $PROP['DATE']["VALUE"] = $date;

    $arLoadProductArray = Array(
        "MODIFIED_BY"    => 1,
        "IBLOCK_SECTION_ID" => false,
        "PROPERTY_VALUES" => $PROP,
        "IBLOCK_ID"      => 30,
        "NAME"           => $name,
        "ACTIVE"         => "N",
        "PREVIEW_TEXT"   => $txt
    );
    $PRODUCT_ID = $el->Add($arLoadProductArray);
}
?>