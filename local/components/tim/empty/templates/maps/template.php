<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @global CMain $APPLICATION */
/** @var array $arParams */

$cities = \Local\Catalog\City::getAll();
$citiesData = [
    [
		'TITLE' => 'Санатории КМВ на карте',
		'BC' => '<a href="/">Главная</a> <span class="divider">/</span> <span>Карты</span>',
    ],
];

?>
<div id="cron_full" class="head_block">
	<div id="cron" class="engBox-body"><?

		$APPLICATION->IncludeComponent('bitrix:breadcrumb', '');

		?>
		<div id="cron-title"><h1><? $APPLICATION->ShowTitle(false); ?></h1></div>
	</div>
</div><?

?>
<div class="engBox-body">
    <div class="engText"><!--seo_text1--></div>
</div><?

/*
?>
<div class="elMaps">
    <div class="engBox-body">
        <div class="it-title">Санатории Кавказских Минеральных Вод</div>
        <div class="it-text">
            <p>
                «Путёвочка» – это бесплатный сервис бронирования санаториев на КМВ. На нашем сайте вы можете ознакомиться с полным списком санаториев и выбрать самые оптимальные для вас варианты отдыха на Кавказских Минеральных Водах и забронировать путёвку. Профессиональные менеджеры проконсультируют вас по любым вопросам, связанным с лечением в санаториях - помогут определиться с необходимым профилем для лечения различных заболеваний, расскажут об актуальных акциях и скидках в санаториях.
            </p>
            <p>
                На нашем сайте вы покупаете путевки по официальным ценам. Каждый клиент получает бесплатный трансфер до санатория, скидки на любые экскурсии по Северному Кавказу, а также возможность бронирования номеров из закрытого резервного фонда здравниц. Вместе с нами вы сделаете правильный выбор и останетесь довольны лечением и отдыхом!
            </p>
        </div>
    </div>
</div><?
*/
?>
<div class="elMapsMenu"><?

	$active = $_REQUEST['city'] ? '' : ' class="active"';
	$cityCode = '';
    ?>
    <div class="left"><a<?= $active ?> href="/maps/">Карта санаториев КМВ</a></div>
    <div class="right"><?

		foreach ($cities['ITEMS'] as $city)
		{
			$active = '';
			if ($_REQUEST['city'] == $city['CODE'])
			{
				$active = ' class="active"';
				$cityCode = $city['CODE'];
				$APPLICATION->AddChainItem($city['NAME'], '/maps/' . $city['CODE'] . '/');
				$APPLICATION->SetTitle('Санатории ' . $city['UF_RODIT'] . ' на карте');
				$APPLICATION->SetPageProperty('title', 'Санатории ' . $city['UF_RODIT'] . ' на карте');
			}
			?>
            <a<?= $active ?> href="/maps/<?= $city['CODE'] ?>/"><?= $city['NAME'] ?></a><?

			$citiesData[$city['CODE']] = [
                'TITLE' => 'Санатории ' . $city['UF_RODIT'] . ' на карте',
                'BC' => '<a href="/">Главная</a> <span class="divider">/</span> <a href="/maps/">Карты</a> <span class="divider">/</span> <span>' . $city['NAME'] . '</span>',
            ];
		}

        ?>
    </div>
</div><?

$items = \Local\Catalog\Sanatorium::get(
	array('PROPERTY_PRICE' => 'asc'),
	array(),
	false
);
$file = new \CFile();
$pm = [];
foreach ($items['ITEMS'] as $item)
{
	if (!$item['YMAP'])
	    continue;

	$ymap = explode(',', $item['YMAP']);
    $img = $file->ResizeImageGet(
        $item['PREVIEW_PICTURE'],
        array(
            'width' => 261,
            'height' => 1000
        ),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );
	$city = \Local\Catalog\City::getById($item['CITY']);

    $pm[$city['CODE']][] = [
        'x' => $ymap[0],
        'y' => $ymap[1],
        'img' => $img['src'],
        'name' => 'Санаторий ' . $item['NAME'],
        'map' => 'КМВ, ' . $city['NAME'],
        'price' => $item['PRICE'] . ' р.',
        'url' => $item['DETAIL_PAGE_URL'],
    ];
}

?>

<div id="map"></div>
<script src="//api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
<script>var mapPM = <?= json_encode($pm, JSON_UNESCAPED_UNICODE) ?>;</script>
<script>var citiesData = <?= json_encode($citiesData, JSON_UNESCAPED_UNICODE) ?>;</script>
<script>var cityCode = '<?= $cityCode ?>';</script>