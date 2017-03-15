<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var Local\Catalog\TimCatalog $component */

$product = $component->product;
$tabCode = $component->tabCode;

$tabs = array(
	'main' => 'Главная',
	't2' => 'Еще вкладка',
	't3' => 'Третья',
	't4' => 'Четвертая',
);

//
// Заголовки табов
//
?>
<ul id="tabs" data-id="<?= $product['ID'] ?>"><?

	foreach ($tabs as $code => $name)
	{
		$class = '';
		if ($code == $tabCode)
			$class = ' class="active"';
		$href = $product['DETAIL_PAGE_URL'];
		if ($code != 'main')
			$href .= $code . '/';
		?>
		<li<?= $class?>><a id="tab-<?= $code ?>" data-id="#<?= $code ?>" href="<?= $href ?>"><?= $name ?></a></li><?
	}
	?>
</ul><?

//
// Содержание табов
//
?>
<div id="tabs-content"><?

	foreach ($tabs as $code => $name)
	{
		$class = $code == $tabCode ? ' active' : ' empty';
		?>
		<div class="tab-pane<?= $class ?>" id="<?= $code ?>"><?

			if ($code == $tabCode)
				\Local\Catalog\Sanatorium::printTab($product, $code);

			?>
		</div><?
	}

?>
</div><?


debugmessage($product);


$APPLICATION->AddChainItem('Санатории', '/sanatorium/');
$APPLICATION->AddChainItem($product['CITY']['NAME'], '/sanatorium/' . $product['CITY']['CODE'] . '/');
$APPLICATION->AddChainItem($product['NAME']);

$APPLICATION->SetTitle($product['NAME']);
if ($product['TITLE'])
	$APPLICATION->SetPageProperty('title', $product['TITLE']);
if ($product['DESCRIPTION'])
	$APPLICATION->SetPageProperty('description', $product['DESCRIPTION']);
