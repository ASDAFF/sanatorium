<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var Local\Catalog\TimCatalog $component */

$filter = $component->filter;
$products = $component->products['ITEMS'];


$result = array();

// Товары
ob_start();
include('products.php');
$result['HTML'] = ob_get_contents();
ob_end_clean();

// Заголовок
ob_start();
include('head.php');
$result['HEAD'] = ob_get_contents();
ob_end_clean();

// Поисковый запрос
$result['SEARCH'] = $component->searchQuery;

// Заголовок браузера
$result['TITLE'] = $component->seo['TITLE'];
$result['H1'] = $component->seo['H1'];

// Фильтры
$result['FILTERS'] = array();
foreach ($filter['GROUPS'] as $group)
{
	if ($group['TYPE'] == 'price')
	{
		$min = 0;
		$max = $group['MAX'];
		$from = $group['FROM'] ? $group['FROM'] : $min;
		$to = $group['TO'] ? $group['TO'] : $max;
		$result['FILTERS']['PRICE'] = array(
			'FROM' => $from,
			'TO' => $to,
			'MIN' => $min,
			'MAX' => $max,
		);
	}
	else
	{
		foreach ($group['ITEMS'] as $code => $item)
			$result['FILTERS'][$code] = array($item['CNT'], $item['CHECKED'] ? 1 : 0);
	}
}

header('Content-Type: application/json');
echo json_encode($result);