<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$reviews = \Local\Catalog\Reviews::getTwo(array(), array(), array());

?>

<div id="comments">
    <div class="engBox-body">
        <div class="title">
            Отзывы
        </div>
        <? foreach ($reviews as $item) {?>
            <div class="item mobile icon-comment-full">
                <div class="date icon-comment">
                    <?=$item['DATE']?>
                </div>
                <div class="title">
                    <?=$item['NAME']?>
                </div>
                <div class="city">
                    <?=$item['CITY']?>
                </div>
                <div class="text">
                    <?=$item['TEXT']?>
                </div>
                <div class="btn">
                    <a href="#">Читать далее</a>
                </div>
            </div>
        <?}?>
        <div class="btn">
            <a href="<?=SITE_DIR . 'reviews'?>">Все отзывы</a>
        </div>
    </div>
</div>