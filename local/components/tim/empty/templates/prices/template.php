<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @global CMain $APPLICATION */
/** @var array $arParams */

$cities = \Local\Catalog\City::getAll();
$cityId = 0;
$page = $_REQUEST['page'];

?>
<div id="cron_full" class="head_block">
	<div id="cron" class="engBox-body">
		<ul class="nav-sections"><?
			foreach ($cities['ITEMS'] as $city)
			{
				$active = '';
				if ($_REQUEST['city'] == $city['CODE'])
				{
					$active = ' class="active"';
					$cityId = $city['ID'];
					$APPLICATION->AddChainItem($city['NAME'], '/action/' . $city['CODE'] . '/');
				}
				?>
				<li<?= $active ?>><a href="/price/<?= $city['CODE'] ?>/">Цены в <?= $city['UF_PREDL'] ?></a></li><?
			}
			?>
		</ul><?

		$APPLICATION->IncludeComponent('bitrix:breadcrumb', '');

		?>
		<div id="cron-title"><h1><? $APPLICATION->ShowTitle(); ?></h1></div>
	</div>
</div><?

if ($page <= 0)
	$page = 1;

$ids = array();
if ($cityId)
{
	$data = \Local\Catalog\Sanatorium::getDataByFilter(array('CITY' => array($cityId => $cityId)));
	$ids = $data['IDS'];
}

$items = \Local\Catalog\Sanatorium::get(
	array('PROPERTY_PRICE' => 'asc'),
	$ids,
	array('nPageSize' => 8, 'iNumPage' => $page)
);

$file = new \CFile();

?>
<div class="el-full-bg-grey">
	<div class="engBox-body prices">
	<div class="el-sanat-list"><?

	$count = 0;
	foreach ($items['ITEMS'] as $item)
	{
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
		?>
		<div class="prices-item">
			<a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="item">
				<div class="img"><img src="<?= $img['src'] ?>"></div>
				<div class="text eng-animations">
					<b><?= $item['NAME'] ?></b>
					<span>КМВ, <?= $city['NAME'] ?></span>
					<i>Подробнее</i>
				</div>
				<div class="money"><b>от <?= $item['PRICE'] ?> р.</b><span>СУТКИ</span></div>

			</a>
			<div class="directions">
				<b>Направления лечения:</b>

				<p><?
					foreach ($item['PROFILES'] as $i => $pid)
					{
						if ($i)
							echo ', ';
						$profile = \Local\Catalog\Profiles::getById($pid);
						echo $profile['NAME'];
					}
					?>
				</p>
			</div>
			<div class="extra-options">
				<b>Дополнительные параметры:</b>
				<ul><?
					$infra = \Local\Catalog\Infra::getAll();
					$cnt = 0;
					foreach ($infra['ITEMS'] as $infraItem)
					{
						$distance = $infraItem['CODE'] == 'buvet' && $item['DISTANCE'];
						if (in_array($infraItem['ID'], $item['INFRA']) || $distance)
						{
							$name = $infraItem['NAME'];
							if ($distance)
								$name = 'Расстояние до бювета: ' . $item['DISTANCE'] . 'м';

							?>
							<li><?= $name ?></li><?
							$cnt++;
							if ($cnt >= 4)
								break;
						}
					}
					?>
				</ul>
			</div>
		</div><?

		$count++;
		if ($count == 4)
		{
			$banners = \Local\Common\Banners::getAll();
			?>
			<div class="banners"><?
				foreach ($banners as $banner)
				{
					?>
					<div class="banners-item"><img src="<?= $banner['PICTURE'] ?>"></div><?
				}
				?>
			</div><?
		}
	}
	?>
	</div>
	</div>
</div>

<div class="el-full-bg-white"><?= $items['PAGINATION'] ?></div><?

//
// Форма "задать вопрос"
//
$APPLICATION->IncludeComponent('tim:empty', 'feedback_form');

$items = \Local\Catalog\Sanatorium::get(
	array('PROPERTY_PRICE' => 'asc'),
	$ids,
	false
);

$title = 'КМВ';
if ($cityId)
{
	$city = \Local\Catalog\City::getById($cityId);
	$title = $city['UF_RODIT'];
}

$idWF = \Local\Catalog\Infra::getIdByCode('wi-fi');
$idBas = \Local\Catalog\Infra::getIdByCode('bassein');
$idBuv = \Local\Catalog\Infra::getIdByCode('buvet');
?>
<div class="prices-rate">
	<div class="engBox-body">
		<div class="prices-rate-ttl">Цены на лечение в санаториях <?= $title ?></div><?

		/*?>
		<p>Предлагаем рейтинг цен и услуг санаториев в виде интерактивной таблицы. Вы можете сортировать таблицу по
			любому из приведенных столбцов.</p>

		<p>Сортировка происходит путем простого нажатия на заголовок столбца, таким образом Вы можете отсортировать
			по интересующему вас пункту.</p><?*/

		?>
		<table class="prices-rate-tbl">
			<thead>
			<tr>
				<td data-label="Санатории <?= $title ?>">Санатории <?= $title ?></td>
				<td data-label="Цена">Цена</td>
				<td data-label="Интернет Wi-Fi">Интернет Wi-Fi</td>
				<td data-label="Бассейн">Бассейн</td>
				<td data-label="Расстояние до бювета">Расстояние до бювета</td>
				<td data-label="Семейный отдых">Семейный отдых</td>
			</tr>
			</thead>
			<tbody><?
			foreach ($items['ITEMS'] as $item)
			{
				$wf = in_array($idWF, $item['INFRA']) ? 'да' : 'нет';
				$bas = in_array($idBas, $item['INFRA']) ? 'да' : 'нет';
				$buv = '';
				if ($item['DISTANCE'])
					$buv = $item['DISTANCE'] . 'м';
				elseif (in_array($idBuv, $item['INFRA']))
					$buv = 'на территории';
				$family = $item['FAMILY'] ? 'да' : 'нет';
				?>
				<tr>
					<td><a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $item['NAME'] ?></a></td>
					<td><?= $item['PRICE'] ?></td>
					<td><?= $wf ?></td>
					<td><?= $bas ?></td>
					<td><?= $buv ?></td>
					<td><?= $family ?></td>
				</tr><?
			}
			?>
			</tbody>
		</table>
	</div>
</div>
<?

