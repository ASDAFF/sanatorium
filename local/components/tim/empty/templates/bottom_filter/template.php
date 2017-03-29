<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (defined('HIDE_BOTTOM_FILTER') && HIDE_BOTTOM_FILTER == 'Y')
	return false;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$data = \Local\Catalog\Sanatorium::getDataByFilter(array());
$priceMax = ceil($data['PRICE']['MAX'] / 100) * 100;

?>
<div class="search-fix">
	<div class="search-dark">
		<div class="el-search engBox-body">
			<div class="line">
				<div class="eng-icon-city"></div>
				<div class="select city">
					<a href="javascript:void(0);" class="slct">(любой город)</a>
					<ul id="city-vibor-bot" class="drop"><?

						foreach ($data['CITY'] as $cityId => $cnt)
						{
							$city = \Local\Catalog\City::getById($cityId);
							?>
							<li data-code="<?= $city['CODE'] ?>"><?= $city['NAME'] ?></li><?
						}
						?>
					</ul>
				</div>
				<div class="eng-icon-city-grey"></div>
				<div class="money">
					Цена в сутки
				</div>
				<div class="money-vibor">
					<span id="slider-range-value-d-from">0</span>
					<div id="slider-range-d" class='slider-range'></div>
					<span id="slider-range-value-d-to"><?= $priceMax ?></span>
				</div>
				<a class="btn filter-find" href="javascript:void(0)">Найти</a>
			</div>
			<div class="el-search-btn">Расширенный поиск</div>
		</div>
	</div>
</div><?