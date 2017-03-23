<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CMain $APPLICATION */
$APPLICATION->IncludeComponent('tim:empty', 'main_managers', array());

?>
<div id="phone">
    <div class="engBox-body">
        <div class="phone"><i class="icon-phome-mega"></i>8 800 800 00 00</div>
        <div class="text">Исходящие вызовы по России бесплатны.<br>
            Проконсультируем вас по любому вопросу, поможем подобрать подходящие путевки для вас и вашей семьи
        </div>
    </div>
</div>
<footer>
    <div class="engBox-body">
        <div>
            <div class="left">
                <?$APPLICATION->IncludeFile(SITE_DIR."include/logo.php",array(),array("MODE"=>"html"));?>
            </div>
            <div class="center">© 2016 «Санатории Кавказа»</div>
            <div class="right">
                <a href=""><img src="<?=SITE_TEMPLATE_PATH;?>/images/webmaster.png"></a>
            </div>
        </div>
    </div>
</footer>

<?
$APPLICATION->IncludeComponent('tim:filter_top', 'bottom', array());
?>

<?
/*
 <div class="search-fix">
<div class="el-search-select engBox-body" id="el-search-select-d"  style="display: none;">
    <div class="title">Направление лечения</div>
    <fieldset class="profiles">
        <label for="checkbox-1d">Лечение гастроэнтерологических заболеваний</label>
        <input class="el-search-dop-input" type="checkbox" name="checkbox-1d" id="checkbox-1d">
        <label for="checkbox-2d">Лечение мужского и женского бесплодия</label>
        <input class="el-search-dop-input" type="checkbox" name="checkbox-2d" id="checkbox-2d">
        <label for="checkbox-3d">Желудочныо-кишечный тракт</label>
        <input class="el-search-dop-input" type="checkbox" name="checkbox-3d" id="checkbox-3d">
        <label for="checkbox-4d">Лечение мужского и женского бесплодия</label>
        <input class="el-search-dop-input" type="checkbox" name="checkbox-4d" id="checkbox-4d">
        <label for="checkbox-5d">Желудочныо-кишечный тракт</label>
        <input class="el-search-dop-input" type="checkbox" name="checkbox-5d" id="checkbox-5d">
        <label for="checkbox-6d">Желудочныо-кишечный тракт</label>
        <input class="el-search-dop-input" type="checkbox" name="checkbox-6d" id="checkbox-6d">
    </fieldset>

	<div class="title">Направление лечения</div>
    <fieldset class="profiles">
        <label for="checkbox-1d0">Лечение гастроэнтерологических заболеваний</label>
        <input class="el-search-dop-input" type="checkbox" name="checkbox-1d0" id="checkbox-1d0">
        <label for="checkbox-2d0">Лечение мужского и женского бесплодия</label>
        <input class="el-search-dop-input" type="checkbox" name="checkbox-2d" id="checkbox-2d0">
        <label for="checkbox-3d0">Желудочныо-кишечный тракт</label>
        <input class="el-search-dop-input" type="checkbox" name="checkbox-3d0" id="checkbox-3d0">
        <label for="checkbox-4d0">Лечение мужского и женского бесплодия</label>
        <input class="el-search-dop-input" type="checkbox" name="checkbox-4d0" id="checkbox-4d0">
        <label for="checkbox-5d0">Желудочныо-кишечный тракт</label>
        <input class="el-search-dop-input" type="checkbox" name="checkbox-5d0" id="checkbox-5d0">
        <label for="checkbox-6d0">Желудочныо-кишечный тракт</label>
        <input class="el-search-dop-input" type="checkbox" name="checkbox-6d0" id="checkbox-6d0">
    </fieldset>
</div>


<div class="search-dark">
<div class="el-search engBox-body">
	<div class="line">
		<div class="eng-icon-city"></div>
		<div class="select city">
			<a href="javascript:void(0);" class="slct">Выберите город</a>
			<ul class="drop">
				<li><a href="">Пятигорск</a></li>
				<li><a href="">Ессентуки</a></li>
				<li><a href="">Железноводск</a></li>
			</ul>
			<input type="hidden" id="select-city" />
		</div>
		<div class="eng-icon-city-grey"></div>
		<div class="money">
			Цена в сутки</div>
		<div class="money-vibor">
			<span id="slider-range-value01">1500</span>
			<div id="slider-range-d" class='slider-range'></div>
			<span id="slider-range-value02">15000</span>
		</div>
		<a class="btn" href="">Найти</a>
	</div>
	<div class="el-search-btn reset" style="margin-right: 10px;">Сброс</div>
	<div class="el-search-btn" id="el-search-btn-d">Расширенный поиск<i id="icon-down-top-d"></i></div>
</div>
</div>


</div>
 */
?>
</body>
</html>