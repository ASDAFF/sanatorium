<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$slideCity = \Local\Catalog\SlideCity::getAll(array(), array(), array());

?>


<div class="el-lech engBox-body">
    <div class="title">
        О лечении в городах КМВ
    </div>
    <div id="slider" class="flexslider">
        <ul class="slides">
            <? foreach ($slideCity as $item) {?>
            <li><a href="" class="item">
                    <div class="img">
                        <img src="<?=$item['PREVIEW_PICTURE']?>">
                    </div>
                    <div class="inf">
                        <b><?=$item['NAME']?></b>
                        <?=$item['NAME']?>
                        <p>
                            <?=$item['PREVIEW_TEXT']?>
                        </p>
                    </div>
                </a>
            </li>
            <?}?>
        </ul>
    </div>

    <div id="carousel" class="flexslider">
        <ul class="slides el-lech-page">
            <? foreach ($slideCity as $item) {?>
                <li>
                    <div class="line">
                    </div>
                    <?=$item['NAME']?>
                </li>
            <?}?>
        </ul>
    </div>
</div>


