<?
$cities = \Local\Catalog\City::getAll();
$aMenuLinksExt = array();
foreach ($cities['ITEMS'] as $city)
{
	$aMenuLinksExt[] = array(
		$city['NAME'],
		'/sanatorium/' . $city['CODE'] . '/',
		Array(),
		Array(),
		"",
	);
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
