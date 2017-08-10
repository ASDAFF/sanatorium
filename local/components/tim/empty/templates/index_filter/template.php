<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$data = \Local\Catalog\Sanatorium::getDataByFilter(array());
$priceMax = ceil($data['PRICE']['MAX'] / 100) * 100;

?>
<div class="el-full-bg" xmlns="http://www.w3.org/1999/xhtml">
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
	<div class="elIndexVideo">
        <div class="engBox-body">
            <a href="#elAboutBox1-video" class="it-video elAboutBox_fancy">
                <div class="it-video-popap" id="elAboutBox1-video" style="display: none;">
                    <iframe src="https://www.youtube.com/embed/QS8tYQbUrNk" allowfullscreen=""></iframe>
                </div>
                <div class="it-video-body" style="background-image: url('../images/elIndexVideo-1.jpg');">
                    <div class="it-video-body-stab">
                        <div class="it-text"><span>О сервисе бронирования</span></div>
                        <div class="it-play elIndexVideo_play"></div>
                    </div>
                </div>
            </a>
            <a href="#elAboutBox2-video" class="it-video elAboutBox_fancy">
                <div class="it-video-popap" id="elAboutBox2-video" style="display: none;">
                    <iframe src="https://www.youtube.com/embed/8tQOxiI08mI" allowfullscreen=""></iframe>
                </div>
                <div class="it-video-body" style="background-image: url('../images/elIndexVideo-2.jpg');">
                    <div class="it-video-body-stab">
                        <div class="it-text"><span>Ваши выгоды покупки</span></div>
                        <div class="it-play elIndexVideo_play"></div>
                    </div>
                </div>
            </a>
            <a href="#elAboutBox3-video" class="it-video elAboutBox_fancy">
                <div class="it-video-popap" id="elAboutBox3-video" style="display: none;">
                        <iframe src="https://www.youtube.com/embed/e6NP0C7wEDc"></iframe>
                </div>
                <div class="it-video-body" style="background-image: url('../images/elIndexVideo-3.jpg');">
                    <div class="it-video-body-stab">
                        <div class="it-text"><span>Отзыв о сервисе</span></div>
                        <div class="it-play elIndexVideo_play"></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div><?
