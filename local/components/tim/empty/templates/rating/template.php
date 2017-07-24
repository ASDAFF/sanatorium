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
						$APPLICATION->SetTitle('Рейтинги в ' . $city['UF_PREDL']);
						$APPLICATION->SetPageProperty('title', 'Рейтинг санаториев в ' . $city['UF_PREDL']);
					}
					?>
					<li<?= $active ?>><a href="/rating/<?= $city['CODE'] ?>/"><?= $city['NAME'] ?></a></li><?
				}
				?>
			</ul>
		</div><?

		$APPLICATION->IncludeComponent('bitrix:breadcrumb', '');

		?>
		<div id="cron-title"><h1><? $APPLICATION->ShowTitle(false); ?></h1></div>
	</div>
</div><?

?>
<div class="engBox-body">
    <div class="engText"><!--seo_text1--></div>
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
	array('PROPERTY_RATING' => 'desc'),
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
					$alt = $alt = 'Санаторий ' . $item['NAME'] . ' ' . $city['NAME'];
					$actions = \Local\Catalog\Action::getBySanatorium($item['ID']);

					?>
					<div class="prices-item">
						<a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="item">
							<div class="img"><img src="<?= $img['src'] ?>" alt="<?= $alt ?>" title="<?= $alt ?>" ></div>
							<div class="text eng-animations">
								<b><?= $item['NAME'] ?></b>
								<span>КМВ, <?= $city['NAME'] ?></span>
								<i>Подробнее</i>
							</div>
							<div class="money"><b>от <?= $item['PRICE'] ?> р.</b><span>СУТКИ</span></div>

						</a>
						<div class="extra-options">
							<div class="rating" title="<?= $item['RATING'] ?>"><?
								for ($i = 0; $i < 5; $i++)
								{
									$cl = 'of';
									$style = '';
									if ($item['RATING'] > $i)
									{
										$cl = 'on';
										$x = ($item['RATING'] - $i) * 100;
										if ($x < 100)
											$style = ' style="width:' . $x . '%"';
									}
									?>
									<div class="star"><span class="<?= $cl ?>"<?= $style ?>></span></div><?
								}
								?>
							</div>
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
						</div><?

                        if ($actions)
                        {
                            ?>
                            <div class="action-mark"></div><?
                        }

					?>
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
	array('PROPERTY_RATING' => 'desc'),
	$ids,
	false
);

$title = 'КМВ';
if ($cityId)
{
	$city = \Local\Catalog\City::getById($cityId);
	$title = $city['UF_PREDL'];
}

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
					$buv = '';
					if ($item['DISTANCE'])
						$buv = $item['DISTANCE'] . 'м';
					elseif (in_array($idBuv, $item['INFRA']))
						$buv = 'на территории';
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
