<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$res = \Local\Catalog\Room::reserve();
echo $res;