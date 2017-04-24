<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$data = \Local\Catalog\Sanatorium::getDataByFilter(array());
$priceMax = ceil($data['PRICE']['MAX'] / 100) * 100;

?>
<div class="el-full-bg" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
	<div class="el-search engBox-body">
		<h1 class="title title-bg">Путевочка - сервис подбора и бронирования<br> санаториев КМВ</h1>
		<div class="title-sm ">Выберите путевку по официальной цене санатория</div>

		<div class="line">
			<div class="eng-icon-city"></div>
			<div class="city controlgroup">
				<select id="city-vibor-top">
					<option value="0">(любой город)</option><?
					foreach ($data['CITY'] as $cityId => $cnt)
					{
						$city = \Local\Catalog\City::getById($cityId);
						?>
						<option value="<?= $city['CODE'] ?>"><?= $city['NAME'] ?></option><?
					}
					?>
				</select>
			</div>
			<div class="eng-icon-city-grey"></div>
			<div class="money">
				Цена в сутки
			</div>
			<div class="money-vibor">
				<span id="slider-range-value-from">0</span>
				<div id="slider-range"></div>
				<span id="slider-range-value-to"><?= $priceMax ?></span>
			</div>
			<a class="btn filter-find" href="javascript:void(0)">Найти</a>
		</div>
		<div class="el-search-btn">Расширенный поиск</div>
	</div>
</div><?
