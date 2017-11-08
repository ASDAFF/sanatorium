<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require $_SERVER["DOCUMENT_ROOT"] . '/local/lib/PHPExcel.php';

$s = file_get_contents('https://putevochka.com/import/san.php');
$input = json_decode($s, true);

$result = [];

foreach ($input as $code => $xls)
{
	//$file = 'https://putevochka.com/prices/' . $code . '/' . $xls;
	//$s = file_get_contents($file);
	$localFile = $_SERVER["DOCUMENT_ROOT"] . '/import/files/' . $code;
	//file_put_contents($localFile, $s);

	$excel = \PHPExcel_IOFactory::load($localFile);
	$sheet = $excel->getSheet(0);
	$ar = $sheet->toArray();

	$result[$code] = $ar;
}

$resultFile = $_SERVER["DOCUMENT_ROOT"] . '/import/result.json';
debugmessage($result);
$js = serialize($result);
debugmessage($js);
file_put_contents($resultFile, $js);
