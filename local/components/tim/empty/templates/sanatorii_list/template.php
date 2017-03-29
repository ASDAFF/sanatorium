<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$sanatorium = \Local\Catalog\Sanatorium::getAll(array(), array(), array());


//echo "<pre>";
//    //print_r($sanatorium);
//echo "</pre>";
?>
<div class="el-full-bg2">
    <div class="el-search-result engBox-body">
        <div class="title">Санатории Кавказских Минеральных Вод с бассейном</div>
        <div class="city">Пятигорск: 10 вариантов</div>
        <div class="sort">
            <b>Сортировать по:</b>
            <span>цене путевки</span>
            <a href="">рейтингу санатория</a>
        </div>
        <div class="number"><b>Показывать по:</b>
            <a href="">10</a>
            <span>25</span>
            <a href="">40</a>
            санаториев на странице
        </div>
    </div>

</div>


<?
$start25 = 1;
$end25 = 2;
?>
<? foreach ($sanatorium as $item) if ($start25++ <= $end25) {
    $rooms = \Local\Catalog\Sanatorium::getMinPriceRooms($item['PRICES']); ?>
    <div class="el-search-list engBox-body">
        <div class="item">
            <div class="img">
                <img src="<?= $item['PREVIEW_PICTURE'] ?>">
            </div>
            <div class="text">
                <a href="" class="title">Санаторий <?= $item["NAME"] ?></a>
                <b>Направление лечения:</b>
                <?
                echo "<pre>";
                print_r($rooms);
                echo "</pre>";
                ?>
                <span><?= $rooms['PROFILES'] ?></span>
                <b>Дополнительные параметры:</b>
                <div class="el-icon-list">
                    <li>
                        <img src="<?= SITE_TEMPLATE_PATH; ?>/images/icon/диван.png">
                        <span>Отдых с детьми от 4 лет</span>
                    </li>
                    <li>
                        <img src="<?= SITE_TEMPLATE_PATH; ?>/images/icon/диван.png">
                        <span>Расстояние до бюФета 500м</span>
                    </li>
                    <li>
                        <img src="<?= SITE_TEMPLATE_PATH; ?>/images/icon/диван.png">
                        <span>Расстояние до бюФета 500м</span>
                    </li>
                    <li>
                        <img src="<?= SITE_TEMPLATE_PATH; ?>/images/icon/диван.png">
                        <span>Расстояние до бюФета 500м</span>
                    </li>
                </div>
            </div>
            <div class="inf">
                <div class="star"></div>
                <div class="comment">
                    <div class="reviewStars-input">
                        <style>
                            .reviewStars-input .star-10 {
                                left: 0px;
                            }

                            .reviewStars-input .star-11 {
                                left: 53px;
                            }

                            .reviewStars-input .star-12 {
                                left: 106px;
                            }

                            .reviewStars-input .star-13 {
                                left: 159px;
                            }

                            .reviewStars-input .star-14 {
                                left: 212px;
                            }

                            .reviewStars-input .star-15 {
                                left: 265px;
                            }
                        </style>


                        <input id="star-14" type="radio" name="reviewStars">
                        <label title="gorgeous" for="star-14"></label>

                        <input id="star-13" type="radio" name="reviewStars">
                        <label title="good" for="star-13"></label>

                        <input id="star-12" type="radio" name="reviewStars">
                        <label title="regular" for="star-12"></label>

                        <input id="star-11" type="radio" name="reviewStars">
                        <label title="poor" for="star-11"></label>

                        <input id="star-10" type="radio" name="reviewStars">
                        <label title="bad" for="star-10"></label>
                    </div>
                    <span>10 отзывов</span>
                    <b>Доступно 5 видов номеров</b>
                </div>

                <div class="money">
                    от <b><?= $rooms[0]['PRICE'] ?></b> руб
                </div>
                <span>за номер в сутки</span>
                <a href="" class="btn">Подробнее</a>
            </div>
        </div>
    </div>

<? } ?>

<a href="" class="item">
    <div class="img"><img src="<?= $item['PREVIEW_PICTURE'] ?>"></div>
    <div class="text eng-animations">
        <b>Санаторий <?= $item["NAME"] ?></b>
        <span><?= $item['CITY_NAME'] ?></span>
        <i href="<?= $item['DETAIL_PAGE'] ?>">Подробнее<?= $item['DETAIL_PAGE_URL'] ?></i>
    </div>
    <div class="money"><b>от <?= $rooms[0]['PRICE'] ?> р.</b><span>СУТКИ</span></div>
</a>