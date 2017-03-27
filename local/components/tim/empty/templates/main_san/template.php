<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$items = \Local\Catalog\Sanatorium::get(
	array('PROPERTY_RATING' => 'desc'),
	array(),
	array('nPageSize' => 12, 'iNumPage' => 1)
);

?>
<div class="el-full-bg-ser">
    <div class="el-sanat-list engBox-body">
        <div class="title">
            Санаторий - ТОП 12
            <span>Кавказские Минеральные Воды</span>
        </div><?
	    foreach ($items['ITEMS'] as $item) {
	        ?>
            <a href="<?=$item['DETAIL_PAGE_URL']?>" class="item">
                <div class="img"><img src="<?= $item['PREVIEW_PICTURE'] ?>"></div>
                <div class="text eng-animations">
                    <b>Санаторий <?= $item['NAME'] ?></b>
                    <span><?= $item['CITY_NAME'] ?></span>
                    <i>Подробнее</i>
                </div>
                <div class="money"><b>от <?= $item['PRICE'] ?> р.</b><span>СУТКИ</span></div>
            </a><?
	    }
	    ?>
        <div class="top-s-searchbox">
            <div class="btn btn-all">
                <a href="/sanatorium/">смотреть все санатории</a>
            </div>
            <form class="s-searchbox" action="/sanatorium/">
                <input type="search" placeholder="Введите название санатория......" name="q"
                       class="s-searchbox-input">
                <input type="submit" class="s-searchbox-submit" value="Найти">
            </form>
        </div>
    </div>
</div>
