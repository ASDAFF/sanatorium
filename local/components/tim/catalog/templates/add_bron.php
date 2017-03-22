<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


$name = $_POST["name"];
$phone = $_POST["phone"];
$room = $_POST["room"];
$san = $_POST["san"];
$adults = $_POST["adults"];
$child = $_POST["child"];
$date_on = $_POST["date_on"];
$date_off = $_POST["date_off"];
$transfer = $_POST["transfer"];

if ($transfer == "on"){
    $transfer = 1;
} else {
    $transfer = 0;
}

if(CModule::IncludeModule('iblock')) {

    $el = new CIBlockElement;

    $PROP = array();
    $PROP['FROM']["VALUE"] = $date_on;
    $PROP['TO']["VALUE"] = $date_off;
    $PROP['PHONE']["VALUE"] = $phone;
    $PROP['SANATORIUM']["VALUE"] = $san;
    $PROP['ROOM_SAN']["VALUE"] = $room;
    $PROP['ADULTS']["VALUE"] = $adults;
    $PROP['CHILD']["VALUE"] = $child;
    $PROP['TRANSFER']["VALUE"] = $san;

    $arLoadProductArray = Array(
        "MODIFIED_BY" => 1,
        "IBLOCK_SECTION_ID" => false,
        "PROPERTY_VALUES" => $PROP,
        "IBLOCK_ID" => 20,
        "NAME" => $name,
        "ACTIVE" => "N"
    );

    if ($PRODUCT_ID = $el->Add($arLoadProductArray))
        //echo "New ID: " . $PRODUCT_ID;
        echo "Спасибо. Мы с Вами свяжемся";
    else
        echo "Error: " . $el->LAST_ERROR;
}


?>