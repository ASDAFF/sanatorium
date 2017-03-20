<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @var array $products */
/** @global CMain $APPLICATION */
/** @var Local\Catalog\TimCatalog $component */

if ($filter['CUR_FILTERS']) {
    ?>
    <div id="current-filters"><?

    foreach ($filter['CUR_FILTERS'] as $item) {
        ?><span><a href="<?= $item['HREF'] ?>">x</a><?= $item['NAME'] ?></span><?
    }

    ?>
    </div><?
}

?>
    <div id="sanatorium">

<?
if (count($products) <= 0) {
    ?>
    <p class="empty">Не найдено ни одного подходящего санатория. Попробуйте отключить какой-нибудь фильтр</p><?
}

foreach ($products as $id => $item) {
    $rooms = \Local\Catalog\Sanatorium::getMinPriceRooms($item['PRICES']);
    $pr = \Local\Catalog\Profiles::getList($item['PROFILES']);
    $info = \Local\Catalog\Sanatorium::getInfo($item['INFRASTRUCTURES']);
    $program = \Local\Catalog\Sanatorium::getParam($item['PROGRAMMS']);
//    echo "<pre>";
//    print_r($item);
//    echo "</pre>";
//    debugmessage($item);
    ?>
    <div class="el-search-list engBox-body">
    <div class="item">
        <div class="img">
            <img src="<?= $item['PREVIEW_PICTURE'] ?>">
        </div>
        <div class="text">
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="title">Санаторий <?= $item['NAME'] ?></a>
            <b>Направление лечения:</b>
            <span>
                <?if(!empty($item['PROFILES'])){
                    foreach ($pr as $value): ?>
                        <?= $value['NAME'] ?>,
                    <?endforeach;
                }
                ?>
            </span>
            <b>Дополнительные параметры:</b>
            <div class="el-icon-list">
                <li>
                    <? if ($item['CHILD4'] != 0 && $item['CHILD1'] != 0) { ?>
                        <img src="<?= SITE_TEMPLATE_PATH; ?>/images/icon/диван.png">
                        <span>Отдых с детьми от 0 лет</span>
                    <? } elseif ($item['CHILD4'] != 0 && $item['CHILD1'] == 0) { ?>
                        <img src="<?= SITE_TEMPLATE_PATH; ?>/images/icon/диван.png">
                        <span>Отдых с детьми от 4 лет</span><?
                    } elseif ($item['CHILD4'] == 0 && $item['CHILD1'] != 0) { ?>
                        <img src="<?= SITE_TEMPLATE_PATH; ?>/images/icon/диван.png">
                        <span>Отдых с детьми от 0 лет</span>т<?
                    } else { ?>
                        <img src="<?= SITE_TEMPLATE_PATH; ?>/images/icon/диван.png"><?
                    } ?>
                </li>
                <? if ($item['DISTANCE'] < 500) { ?>
                    <img src="<?= SITE_TEMPLATE_PATH; ?>/images/icon/диван.png">
                <? } else { ?><img src="<?= SITE_TEMPLATE_PATH; ?>/images/icon/диван.png"><span>
                    Расстояние до бюФета <?= $item['DISTANCE'] ?>м</span><?
                } ?>
                </li>
                <?
                    $s=1;
                    $f=2;
                ?>
                <?if(!empty($item['INFRASTRUCTURES'])){
                    foreach ($info as $value) if($s++ <= $f ) {?>
                        <li>
                            <i class="in-icon"><img src="<?= $value['PREVIEW_PICTURE'] ?>"></i>
                            <span><?= $value['NAME'] ?></span>
                        </li>
                    <?}?>
                <?}
                ?>
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
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="btn">Подробнее</a>
        </div>
    </div>
    </div><?
}
?>
    </div><?

//
// Постраничка
//
$iCur = $component->products['NAV']['PAGE'];
$iEnd = ceil($component->products['NAV']['COUNT'] / $component::PAGE_SIZE);

if ($iEnd > 1) {
    $iStart = $iCur - 2;
    $iFinish = $iCur + 2;
    if ($iStart < 1) {
        $iFinish -= $iStart - 1;
        $iStart = 1;
    }
    if ($iFinish > $iEnd) {
        $iStart -= $iFinish - $iEnd;
        if ($iStart < 1) {
            $iStart = 1;
        }
        $iFinish = $iEnd;
    }

    $url = $component->filter['URL'];
    if (strpos($url, '?') !== false)
        $urlPage = $url . '&page=';
    else
        $urlPage = $url . '?page=';

    ?>

    <div class="el-full-bg-grey">
    <div class="el-page engBox-body">
        <ul><?

            if ($iCur > 1) {
                if ($iCur == 2)
                    $href = $url;
                else
                    $href = $urlPage . ($iCur - 1);
                ?>
                <li class="prev">
                <a href="<?= $href ?>" data-page="<?= ($iCur - 1) ?>"></a>
                </li><?
            } else {
                ?>
                <li class="prev">
                    <span></span>
                </li><?
            }
            if ($iStart > 1) {
                $href = $url;
                ?>
                <li>
                <a href="<?= $href ?>" data-page="1">1</a>
                </li><?

                if ($iStart > 2) {
                    ?>
                    <li>
                        <span>...</span>
                    </li><?
                }
            }
            for ($i = $iStart; $i <= $iFinish; $i++) {
                if ($i == $iCur) {
                    ?>
                    <li>
                    <span class="active"><?= $i ?></span>
                    </li><?
                } else {
                    if ($i == 1)
                        $href = $url;
                    else
                        $href = $urlPage . $i;
                    ?>
                    <li>
                    <a href="<?= $href ?>" data-page="<?= $i ?>"><?= $i ?></a>
                    </li><?
                }
            }
            if ($iFinish < $iEnd) {
                if ($iFinish < $iEnd - 1) {
                    ?>
                    <li>
                        <span>...</span>
                    </li><?
                }

                $href = $urlPage . $iEnd;
                ?>
                <li>
                <a href="<?= $href ?>" data-page="<?= $iEnd ?>"><?= $iEnd ?></a>
                </li><?
            }
            if ($iCur < $iEnd) {
                $href = $urlPage . ($iCur + 1);
                ?>
                <li class="next">
                <a href="<?= $href ?>" data-page="<?= ($iCur + 1) ?>"></a>
                </li><?
            } else {
                ?>
                <li class="next">
                    <span></span>
                </li><?
            }

            ?>
        </ul>
    </div>
    </div><?

}

?>
<? /*<div class="seo-text"><?
// Описание выводим только на первой странице.
if ($component->navParams['iNumPage'] == 1) {
    echo $component->seo['TEXT'];
}
?>
    </div>*/ ?><?