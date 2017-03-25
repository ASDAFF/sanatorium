<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @var array $products */
/** @global CMain $APPLICATION */
/** @var Local\Catalog\TimCatalog $component */

//
// Шапка санаториев
//
?>
<div class="el-full-bg2">
    <div class="el-search-result engBox-body">
        <div class="title">
            Санатории Кавказских Минеральных Вод с бассейном
        </div>
        <div class="city">
            <?
            if ($filter['CUR_FILTERS'])
            {
                foreach ($filter['CUR_FILTERS'] as $item)
                {
                    ?><? /*<a href="<?= $item['HREF'] ?>">x</a>*/ ?><?= $item['NAME'] ?>:<?
                }
            }
            ?><?= $component->countTitle ?>
        </div>
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
</div><?

//
// Элементы
//
?>
<div id="sanatorium"><?

if (count($products) <= 0)
{
    ?>
    <p class="empty">Не найдено ни одного подходящего санатория. Попробуйте отключить какой-нибудь фильтр</p><?
}

foreach ($products as $id => $item)
{
	?>
    <div class="el-search-list engBox-body">
    <div class="item">
        <div class="img">
            <img src="<?= $item['PREVIEW_PICTURE'] ?>">
        </div>
        <div class="text">
	        <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="title">Санаторий <?= $item['NAME'] ?></a><?

	        //
	        // Профили лечения
	        //
	        if ($item['PROFILES'])
	        {
		        ?>
		        <b>Направление лечения:</b>
	            <span><?
		        foreach ($item['PROFILES'] as $i => $pid)
		        {
			        if ($i)
				        echo ', ';
					$profile = \Local\Catalog\Profiles::getById($pid);
			        echo $profile['NAME'];
		        }
		        ?>
                </span><?
	        }

			//
			// Инфраструктура
			//
	        ?>
            <b>Дополнительные параметры:</b>
	        <div class="el-icon-list"><?
		        $infra = \Local\Catalog\Infra::getAll();
		        $cnt = 0;
				foreach ($infra['ITEMS'] as $infraItem)
				{
					if (in_array($infraItem['ID'], $item['INFRA']))
					{
						?>
						<li>
							<i class="in-icon icon-<?= $infraItem['CODE'] ?>"></i>
							<span><?= $infraItem['NAME'] ?></span>
						</li><?
					}
				}
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