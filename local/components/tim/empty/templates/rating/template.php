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
		<div class="nav-sections">
			<span class="nav-sections-title">Рейтинг санаториев:</span>
			<ul class="ul_city"><?
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
					<li<?= $active ?>><a href="/rating/<?= $city['CODE'] ?>/"><?= $city['NAME'] ?></a></li><?
				}
				?>
			</ul>
		</div><?

		$APPLICATION->IncludeComponent('bitrix:breadcrumb', '');

		?>
		<div id="cron-title"><h1><? $APPLICATION->ShowTitle(); ?></h1></div>
	</div>
</div><?

$title = 'КМВ';
$ids = array();
if ($cityId)
{
	$data = \Local\Catalog\Sanatorium::getDataByFilter(array('CITY' => array($cityId => $cityId)));
	$ids = $data['IDS'];
	$city = \Local\Catalog\City::getById($cityId);
	$title = $city['UF_PREDL'];
}

$items = \Local\Catalog\Sanatorium::get(
	array('PROPERTY_RATING' => 'desc'),
	$ids,
	false
);

$idWF = \Local\Catalog\Infra::getIdByCode('wi-fi');
$idBas = \Local\Catalog\Infra::getIdByCode('bassein');
$idBuv = \Local\Catalog\Infra::getIdByCode('buvet');
?>
	<div class="prices-rate">
		<div class="engBox-body">
			<div class="prices-rate-ttl">Рейтинг санаториев в <?= $title ?></div><?

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
					<td data-label="Рейтинг">Рейтинг</td>
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
					$buv = '-';
					if (in_array($idBuv, $item['INFRA']))
					{
						$buv = $item['DISTANCE'];
						if ($buv)
							$buv .= ' м';
					}
					$family = $item['FAMILY'] ? 'да' : 'нет';
					?>
					<tr>
					<td><a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $item['NAME'] ?></a></td>
					<td><?= $item['RATING'] ?></td>
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
