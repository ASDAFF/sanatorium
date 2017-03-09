<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?><?$APPLICATION->SetTitle("Главная");?> <!-- Каталог !-->

<?
$APPLICATION->IncludeComponent('tim:filter', '', array(
	'AJAX' => $isAjax,
));
?>

<?/*<div class="el-full-bg">
	<div class="el-search engBox-body">
		<div class="title title-bg">
			 Путевочка - сервис подбора и бронирования<br>
			 санаториев КМВ
		</div>
		<div class="title-sm ">
			 Выберите путевку по официальной цене санатория
		</div>
		<div class="line">
			<div class="eng-icon-city">
			</div>
			<div class="city controlgroup">
				<select id="city-vibor">
					<option>Пятигорск</option>
					<option>Ессентуки</option>
				</select>
			</div>
			<div class="eng-icon-city-grey">
			</div>
			<div class="money">
				 Цена в сутки
			</div>
			<div class="money-vibor">
 <span id="slider-range-value1">1500</span>
				<div id="slider-range">
				</div>
 <span id="slider-range-value2">15000</span>
			</div>
 <a class="btn" href="">Найти</a>
		</div>
		<div class="el-search-btn" id="el-search-btn">
			 Расширенный поиск
		</div>
		<div class="el-search-btn" style="margin-right: 10px;">
			 Сброс
		</div>
	</div>
</div>
<div class="el-search-select engBox-body" id="el-search-select" style="display: none;">
	<div class="title">
		 Направление лечения
	</div>
	<fieldset class="profiles">
 <label for="checkbox-1">Лечение гастроэнтерологических заболеваний</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-1" id="checkbox-1"> <label for="checkbox-2">Лечение мужского и женского бесплодия</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-2" id="checkbox-2"> <label for="checkbox-3">Желудочныо-кишечный тракт</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-3" id="checkbox-3"> <label for="checkbox-4">Лечение мужского и женского бесплодия</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-4" id="checkbox-4"> <label for="checkbox-5">Желудочныо-кишечный тракт</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-5" id="checkbox-5"> <label for="checkbox-6">Желудочныо-кишечный тракт</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-6" id="checkbox-6"> <label for="checkbox-7">Желудочныо-кишечный тракт</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-7" id="checkbox-7"> <label for="checkbox-8">Желудочныо-кишечный тракт</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-8" id="checkbox-8"> <label for="checkbox-9">Желудочныо-кишечный тракт</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-9" id="checkbox-9"> <label for="checkbox-10">Желудочныо-кишечный тракт</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-10" id="checkbox-10"> <label for="checkbox-11">Желудочныо-кишечный тракт</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-11" id="checkbox-11"> <label for="checkbox-12">Желудочныо-кишечный тракт</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-12" id="checkbox-12">
	</fieldset>
	<div class="title">
		 Дополнительные услуги
	</div>
	<fieldset class="extra-serv">
		<div class="tbl">
 <label for="checkbox-1.1">Тренажерный сайт</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-1.1" id="checkbox-1.1"> <label for="checkbox-2.2">Бассейн</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-2.2" id="checkbox-2.2"> <label for="checkbox-3.3">Все включено</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-3.3" id="checkbox-3.3"> <label for="checkbox-4.4">Парковка</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-4.4" id="checkbox-4.4"> <label for="checkbox-5.5">Без лечения</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-5.5" id="checkbox-5.5"> <label for="checkbox-6.6">SPA</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-6.6" id="checkbox-6.6">
		</div>
	</fieldset>
	<div class="title">
		 Специализированные
	</div>
	<fieldset class="spec-serv-1">
		<div class="tbl">
 <label for="checkbox-1.0">Военные санатории</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-1.0" id="checkbox-1.0"> <label for="checkbox-2.0">Санатории РЖД</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-2.0" id="checkbox-2.0"> <label for="checkbox-3.0">Санатории МВД</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-3.0" id="checkbox-3.0"> <label for="checkbox-4.0">Санатории ФСБ</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-4.0" id="checkbox-4.0"> <label for="checkbox-5.0">Санатории Мин. Обороны</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-5.0" id="checkbox-5.0">
		</div>
	</fieldset>
	<fieldset class="spec-serv-2">
 <label for="checkbox-1.01">Для пенсионеров</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-1.01" id="checkbox-1.01"> <label for="checkbox-2.01">Для пожилых людей</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-2.01" id="checkbox-2.01"> <label for="checkbox-3.01">Санатории для всей семьи</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-3.01" id="checkbox-3.01"> <label for="checkbox-4.01">Детские санатории</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-4.01" id="checkbox-4.01"> <label for="checkbox-5.01">С детьми от года</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-5.01" id="checkbox-5.01"> <label for="checkbox-6.01">С детьми от 4-х</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-6.01" id="checkbox-6.01"> <label for="checkbox-7.01">Для людей с инвалидностью</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-7.01" id="checkbox-7.01"> <label for="checkbox-8.01">Санатории для мам и детей</label> <input class="el-search-dop-input" type="checkbox" name="checkbox-8.01" id="checkbox-8.01">
	</fieldset>
</div>*/?>



<div class="el-full-bg-ser">
	<div class="el-sanat-list engBox-body">
		<div class="title">
			 Санаторий - ТОП 12 Кавказские Минеральные Воды
		</div>
        <?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"sanatorii", 
	array(
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "21",
		"IBLOCK_TYPE" => "aspro_resort_catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "12",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "sanatorii",
		"VARIABLE_ALIASES" => array(
			"SECTION_ID" => "SECTION_ID",
			"ELEMENT_ID" => "ELEMENT_ID",
		)
	),
	false
);?>


<!-- <a href="" class="item">-->
<!--		<div class="img">-->
<!-- <img src="/local/templates/san/images/img2.jpg">-->
<!--		</div>-->
<!--		<div class="text eng-animations">-->
<!-- <b>Санаторий машук</b>-->
<!--			КМВ, Пятигорск <i href="">Подробнее</i>-->
<!--		</div>-->
<!--		<div class="money">-->
<!-- <b>от 3000 р.</b>СУТКИ-->
<!--		</div>-->
<!-- </a> <a href="" class="item">-->
<!--		<div class="img">-->
<!-- <img src="/local/templates/san/images/img2.jpg">-->
<!--		</div>-->
<!--		<div class="text eng-animations">-->
<!-- <b>Санаторий машук</b>-->
<!--			КМВ, Пятигорск <i href="">Подробнее</i>-->
<!--		</div>-->
<!--		<div class="money">-->
<!-- <b>от 3000 р.</b>СУТКИ-->
<!--		</div>-->
<!-- </a> <a href="" class="item">-->
<!--		<div class="img">-->
<!-- <img src="/local/templates/san/images/img2.jpg">-->
<!--		</div>-->
<!--		<div class="text eng-animations">-->
<!-- <b>Санаторий машук</b>-->
<!--			КМВ, Пятигорск <i href="">Подробнее</i>-->
<!--		</div>-->
<!--		<div class="money">-->
<!-- <b>от 3000 р.</b>СУТКИ-->
<!--		</div>-->
<!-- </a> <a href="" class="item">-->
<!--		<div class="img">-->
<!-- <img src="/local/templates/san/images/img2.jpg">-->
<!--		</div>-->
<!--		<div class="text eng-animations">-->
<!-- <b>Санаторий машук</b>-->
<!--			КМВ, Пятигорск <i href="">Подробнее</i>-->
<!--		</div>-->
<!--		<div class="money">-->
<!-- <b>от 3000 р.</b>СУТКИ-->
<!--		</div>-->
<!-- </a> <a href="" class="item">-->
<!--		<div class="img">-->
<!-- <img src="/local/templates/san/images/img2.jpg">-->
<!--		</div>-->
<!--		<div class="text eng-animations">-->
<!-- <b>Санаторий машук</b>-->
<!--			КМВ, Пятигорск <i href="">Подробнее</i>-->
<!--		</div>-->
<!--		<div class="money">-->
<!-- <b>от 3000 р.</b>СУТКИ-->
<!--		</div>-->
<!-- </a> <a href="" class="item">-->
<!--		<div class="img">-->
<!-- <img src="/local/templates/san/images/img2.jpg">-->
<!--		</div>-->
<!--		<div class="text eng-animations">-->
<!-- <b>Санаторий машук</b>-->
<!--			КМВ, Пятигорск <i href="">Подробнее</i>-->
<!--		</div>-->
<!--		<div class="money">-->
<!-- <b>от 3000 р.</b>СУТКИ-->
<!--		</div>-->
<!-- </a> <a href="" class="item">-->
<!--		<div class="img">-->
<!-- <img src="/local/templates/san/images/img2.jpg">-->
<!--		</div>-->
<!--		<div class="text eng-animations">-->
<!-- <b>Санаторий машук</b>-->
<!--			КМВ, Пятигорск <i href="">Подробнее</i>-->
<!--		</div>-->
<!--		<div class="money">-->
<!-- <b>от 3000 р.</b>СУТКИ-->
<!--		</div>-->
<!-- </a> <a href="" class="item">-->
<!--		<div class="img">-->
<!-- <img src="/local/templates/san/images/img2.jpg">-->
<!--		</div>-->
<!--		<div class="text eng-animations">-->
<!-- <b>Санаторий машук</b>-->
<!--			КМВ, Пятигорск <i href="">Подробнее</i>-->
<!--		</div>-->
<!--		<div class="money">-->
<!-- <b>от 3000 р.</b>СУТКИ-->
<!--		</div>-->
<!-- </a>-->


		<div class="top-s-searchbox">
			<div class="btn btn-all">
 <a href="">смотреть все санатории</a>
			</div>
			<form class="s-searchbox">
 <input type="search" placeholder="Введите название санатория......" name="search" class="s-searchbox-input"> <input type="submit" class="s-searchbox-submit" value="Найти">
			</form>
		</div>
	</div>
</div>
<div class="el-lech engBox-body">
	<div class="title">
		 О лечении в городах КМВ
	</div>
	<div id="slider" class="flexslider">
		<ul class="slides">
			<li> <a href="" class="item">
			<div class="img">
 <img src="/local/templates/san/images/img3.jpg">
			</div>
			<div class="inf">
 <b>Пятигорск</b>
				КМВ, Пятигорск
				<p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
				</p>
			</div>
 </a> </li>
			<li> <a href="" class="item">
			<div class="img">
 <img src="/local/templates/san/images/img3.jpg">
			</div>
			<div class="inf">
 <b>Пятигорск</b>
				КМВ, Пятигорск
				<p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
				</p>
			</div>
 </a> </li>
			<li> <a href="" class="item">
			<div class="img">
 <img src="/local/templates/san/images/img3.jpg">
			</div>
			<div class="inf">
 <b>Пятигорск</b>
				КМВ, Пятигорск
				<p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
				</p>
			</div>
 </a> </li>
			<li> <a href="" class="item">
			<div class="img">
 <img src="/local/templates/san/images/img3.jpg">
			</div>
			<div class="inf">
 <b>Пятигорск</b>
				КМВ, Пятигорск
				<p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
				</p>
			</div>
 </a> </li>
		</ul>
	</div>
	<div id="carousel" class="flexslider">
		<ul class="slides el-lech-page">
			<li>
			<div class="line">
			</div>
			 Железноводск </li>
			<li>
			<div class="line">
			</div>
			 Железноводск </li>
			<li>
			<div class="line">
			</div>
			 Железноводск </li>
			<li>
			<div class="line">
			</div>
			 Железноводск </li>
		</ul>
	</div>
</div>
<div id="comments">
	<div class="engBox-body">
		<div class="title">
			 Отзывы
		</div>
		<div class="item mobile icon-comment-full">
			<div class="date icon-comment">
				 26 октября 2016
			</div>
			<div class="title">
				 Имя Фамилия
			</div>
			<div class="city">
				 г. Санкт-Петербург
			</div>
			<div class="text">
				 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
			</div>
			<div class="btn">
 <a href="#">Читать далее</a>
			</div>
		</div>
		<div class="item mobile icon-comment-full">
			<div class="date icon-comment">
				 26 октября 2016
			</div>
			<div class="title">
				 Имя Фамилия
			</div>
			<div class="city">
				 г. Санкт-Петербург
			</div>
			<div class="text">
				 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
			</div>
			<div class="btn">
 <a href="#">Читать далее</a>
			</div>
		</div>
		<div class="btn">
 <a href=""> Все отзывы</a>
		</div>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>