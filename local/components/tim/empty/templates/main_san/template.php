<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$sanatorium = \Local\Catalog\Sanatorium::getAll(array(), array(), array());


//echo "<pre>";
//    //print_r($sanatorium);
//echo "</pre>";
?>

<div class="el-full-bg-ser">
    <div class="el-sanat-list engBox-body">
        <div class="title">
            Санаторий - ТОП 12
            <span>Кавказские Минеральные Воды</span>
        </div>
        <?
        $startTop12 = 1;
        $endTop12 = 12;
        ?>
        <? foreach ($sanatorium as $item) if($startTop12++ <= $endTop12) {
            $rooms = \Local\Catalog\Sanatorium::getMinPriceRooms($item['PRICES']);?>
            <a href="" class="item">
                <div class="img"><img src="<?=$item['PREVIEW_PICTURE']?>"></div>
                <div class="text eng-animations">
                    <b>Санаторий <?=$item["NAME"]?></b>
                    <span><?=$item['CITY_NAME']?></span>
                    <i href="<?=$item['DETAIL_PAGE']?>">Подробнее<?=$item['DETAIL_PAGE_URL']?></i>
                </div>
                <div class="money"><b>от <?=$rooms[0]['PRICE']?> р.</b><span>СУТКИ</span></div>
            </a>
        <? } ?>
        <div class="top-s-searchbox">
            <div class="btn btn-all">
                <a href="<?=SITE_DIR . 'sanatorium'?>">смотреть все санатории</a>
            </div>
            <form class="s-searchbox">
                <input type="search" placeholder="Введите название санатория......" name="search"
                       class="s-searchbox-input">
                <input type="submit" class="s-searchbox-submit" value="Найти">
            </form>
        </div>
    </div>
</div>
