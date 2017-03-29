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
			<span class="nav-sections-title">Акции в санаториях:</span>
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
					<li<?= $active ?>><a href="/action/<?= $city['CODE'] ?>/"><?= $city['NAME'] ?></a></li><?
				}
				?>
			</ul>
		</div><?

		$APPLICATION->IncludeComponent('bitrix:breadcrumb', '');

		?>
		<div id="cron-title"><h1><? $APPLICATION->ShowTitle(); ?></h1></div>
	</div>
</div><?

$class = $isService ? ' service-reviews' : '';
$title = $isService ? '' : ' о санатории';
$actions = \Local\Catalog\Action::getList($cityId, $page);

?>
<div class="engBox-body clearfix">
	<div class="engBox-center">
		<div id="content">
			<div class="actions-list el-sanat-list"><?
				foreach ($actions['ITEMS'] as $item)
				{
					$sanatorium = \Local\Catalog\Sanatorium::getById($item['SANATORIUM']);
					?>
					<div class="actions-item">
						<div class="actions-img">
							<a href="<?= $sanatorium['DETAIL_PAGE_URL'] ?>" class="item">
								<div class="img" style="background:url(<?= $sanatorium['PICTURES'][0] ?>);"></div>
								<div class="text eng-animations">
									<b>Санаторий <?= $sanatorium['NAME'] ?></b>
									<span>КМВ, <?= $sanatorium['CITY']['NAME'] ?></span>
									<i>Забронировать</i>
								</div>
							</a>
						</div>
						<div class="actions-content">
							<div class="actions-title"><?= $item['NAME'] ?></div><?

							$period = '';
							if ($item['ACTIVE_FROM'])
								$period .= ' с ' . $item['ACTIVE_FROM'];
							if ($item['ACTIVE_TO'])
								$period .= ' по ' . $item['ACTIVE_TO'];
							if ($period)
							{
								?>
								<div class="actions-time"><b>Период действия:</b> <span><?= $period ?></span></div><?
							}

							?>
							<div class="actions-descr">
								<p><b>Описание акции:</b></p>
								<?= $item['TEXT'] ?>
							</div>
						</div>
					</div><?
				}
				?>
			</div>
		</div>
	</div>
	<div class="engBox-right">
		<div id="right-ban">
			<a href=""><img src="/images/ban1.jpg"></a>
			<a href=""><img src="/images/ban2.jpg"></a>
			<a href=""><img src="/images/ban3.jpg"></a>
			<a href=""><img src="/images/ban4.jpg"></a>
		</div>
	</div>
</div><?

echo $actions['NAV'];
