<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$data = \Local\Catalog\Sanatorium::getDataByFilter(array());
$priceMin = $data['PRICE']['MIN'];
$priceMax = $data['PRICE']['MAX'];

?>
<div class="search-fix">
	<input type="hidden" id="select-city" />
	<div class="search-dark">
		<div class="el-search engBox-body">
			<div class="line">
				<div class="eng-icon-city"></div>
				<div class="select city">
					<a href="javascript:void(0);" class="slct">Выберите город</a>
					<ul id="city-vibor" class="drop"><?

						foreach ($data['CITY'] as $cityId => $cnt)
						{
							$city = \Local\Catalog\City::getById($cityId);
							?>
							<li name="<?= $city['CODE'] ?>"><?= $city['NAME'] ?></li><?
						}
						?>
					</ul>
					<input type="hidden" id="select-city"/>
				</div>
				<div class="eng-icon-city-grey"></div>
				<div class="money">
					Цена в сутки
				</div>
				<div class="money-vibor">
					<span id="slider-range-value01"><?= $priceMin ?></span>
					<div id="slider-range-d" class='slider-range'></div>
					<span id="slider-range-value02"><?= $priceMax ?></span>
				</div>
				<a class="btn filter_find" href="javascript:void(0)">Найти</a>
			</div>
			<div class="el-search-btn reset" style="margin-right: 10px;">Сброс</div>
			<div class="el-search-btn" id="el-search-btn-d">Расширенный поиск<i id="icon-down-top-d"></i></div>
		</div>
	</div>
</div><?