<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$d3SanatoriumId = 0;
$hostParts = explode('.', $_SERVER['HTTP_HOST']);
$d3 = '';
if (count($hostParts) === 3)
	$d3 = $hostParts[0];
if ($d3 && $d3 != 'www')
{
	$redirect = \Local\Catalog\Sanatorium::checkRedirect($d3);
	if ($redirect)
		LocalRedirect('https://' . $redirect . '.putevochka.com', true, '301 Moved Permanently');

	$d3SanatoriumId = \Local\Catalog\Sanatorium::getIdByCode($d3);
}

if ($d3SanatoriumId)
	require($_SERVER["DOCUMENT_ROOT"] . "/sanatorium/index.php");
else
	require($_SERVER["DOCUMENT_ROOT"] . "/404.php");