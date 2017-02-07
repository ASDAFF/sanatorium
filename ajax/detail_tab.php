<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$sanatorium = \Local\Catalog\Sanatorium::getById($_REQUEST['id']);
if (!$sanatorium)
	return;

\Local\Catalog\Sanatorium::printTab($sanatorium, $_REQUEST['tab']);