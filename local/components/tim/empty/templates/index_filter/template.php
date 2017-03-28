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
<div class="el-full-bg" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
	<div class="el-search engBox-body">
		<div class="title title-bg">Путевочка - сервис подбора и бронирования<br> санаториев КМВ</div>
		<div class="title-sm ">Выберите путевку по официальной цене санатория</div>

		<div class="line">
			<div class="eng-icon-city"></div>
			<div class="city controlgroup">
				<select id="city-vibor">
					<option name="0">(любой город)</option><?
					foreach ($data['CITY'] as $cityId => $cnt)
					{
						$city = \Local\Catalog\City::getById($cityId);
						?>
						<option name="<?= $city['CODE'] ?>"><?= $city['NAME'] ?></option><?
					}
					?>
				</select>
			</div>
			<div class="eng-icon-city-grey"></div>
			<div class="money">
				Цена в сутки
			</div>
			<div class="money-vibor">
				<span id="slider-range-value1"><?= $priceMin ?></span>
				<div id="slider-range"></div>
				<span id="slider-range-value2"><?= $priceMax ?></span>
			</div>
			<a class="btn filter_find" href="javascript:void(0)">Найти</a>
		</div>
		<div class="el-search-btn" id="el-search-btn">Расширенный поиск</div>
	</div>
</div><?