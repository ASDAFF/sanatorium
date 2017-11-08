<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$return = [];

$iblockElement = new \CIBlockElement();
$filter = array(
	'IBLOCK_ID' => \Local\Catalog\Sanatorium::IBLOCK_ID,
);
$select = array(
	'ID', 'NAME', 'CODE',
);
$rsItems = $iblockElement->GetList(array(), $filter, false, false, $select);
while ($item = $rsItems->GetNext())
{
	$path = $_SERVER['DOCUMENT_ROOT'] . '/prices/' . $item['CODE'] . '/';
	$files = scandir($path);
	$priceFilename = '';
	foreach ($files as $filename)
	{
		if ($filename != '.' && $filename != '..')
		{
			$priceFilename = $filename;
			break;
		}
	}
	if ($priceFilename)
		$return[$item['CODE']] = $priceFilename;
}

header('Content-Type: application/json');
echo json_encode($return);