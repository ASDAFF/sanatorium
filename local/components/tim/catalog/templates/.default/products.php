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
    <div id="products-summary" class="el-search-result engBox-body">
        <div class="title"><?= $component->seo['H1'] ?></div>
        <div class="city"><?//= $component->countTitle ?></div>
        <div class="sort">
	        <b>Сортировать по:</b><?

	        $url = $component->filter['URL'];
	        if (strpos($url, '?') !== false)
		        $urlPage = $url . '&sort=';
	        else
		        $urlPage = $url . '?sort=';
			foreach ($component->sortParams as $key => $sort)
			{
				if ($sort['CURRENT'])
				{
					?>
					<span><?= $sort['NAME'] ?></span><?
				}
				else
				{
					?>
					<a href="<?= $urlPage ?><?= $key ?>"><?= $sort['NAME'] ?></a><?
				}
			}
	        ?>
        </div>
	    <div class="number"><b>Показывать по:</b><?

		    $url = $component->filter['URL'];
		    if (strpos($url, '?') !== false)
			    $urlPage = $url . '&size=';
		    else
			    $urlPage = $url . '?size=';
			foreach ($component->pageSizes as $size)
			{
				if ($size == $component->navParams['nPageSize'])
				{
					?>
					<span><?= $size ?></span><?
				}
				else
				{
					?>
					<a href="<?= $urlPage ?><?= $size ?>"><?= $size ?></a><?
				}
			}
		    ?>
            санаториев на странице
        </div>
		<div class="filtr">
			<?= $component->countTitle ?>:<?
			foreach ($filter['CUR_FILTERS'] as $item)
			{
				?><div class="filtr-current">
					<span class="filtr-ttl"><?= $item['NAME'] ?></span><a href="<?= $item['HREF']?>" class="filtr-close"></a>
				</div><?
			}
			?>
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

$file = new \CFile();
foreach ($products as $id => $item)
{
	$img = $file->ResizeImageGet(
		$item['PREVIEW_PICTURE'],
		array(
			'width' => 345,
			'height' => 1000
		),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);
	$reviewsCount = \Local\Catalog\Reviews::getCountBySanatorium($id);
	$reviewsCountTitle = '';
	if ($reviewsCount)
		$reviewsCountTitle .= $reviewsCount . pluralize($reviewsCount, array(' отзыв', ' отзыва', ' отзывов'));
	?>
    <div class="el-search-list engBox-body">
    <div class="item">
        <div class="img">
            <img src="<?= $img['src'] ?>">
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
	        if ($item['INFRA'])
	        {
		        ?>
		        <b>Дополнительные параметры:</b>
		        <div class="el-icon-list"><?
			        $infra = \Local\Catalog\Infra::getAll();
			        $cnt = 0;
			        foreach ($infra['ITEMS'] as $infraItem)
			        {
				        if (in_array($infraItem['ID'], $item['INFRA']))
				        {
					        $name = $infraItem['NAME'];
					        if ($infraItem['CODE'] == 'buvet' && $item['DISTANCE'])
						        $name = 'Расстояние до бювета: ' . $item['DISTANCE'];

					        ?>
					        <li>
					        <i class="in-icon icon-<?= $infraItem['CODE'] ?>"></i>
					        <span><?= $name ?></span>
					        </li><?
					        $cnt++;
					        if ($cnt >= 4)
						        break;
				        }
			        }
			        ?>
		        </div><?
	        }
		    ?>
        </div>
        <div class="inf">
            <div class="star"></div>
            <div class="comment">
                <div class="rating">
					<div class="star"><span class="on"></span></div>
					<div class="star"><span class="on"></span></div>
					<div class="star"><span class="on"></span></div>
					<div class="star"><span class="of"></span></div>
					<div class="star"><span class="of"></span></div>
                </div>
	            <span><?= $reviewsCountTitle ?></span><?

	            $cnt = $item['ROOMS_COUNT'];
	            if ($cnt)
	            {
		            $cnt .= pluralize($cnt, array(' вид', ' вида', ' видов'));
		            ?>
		            <b>Доступно <?= $cnt ?> номеров</b><?
	            }

	            ?>
            </div>

            <div class="money">
                от <b><?= $item['PRICE'] ?></b> руб
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
$iEnd = ceil($component->products['NAV']['COUNT'] / $component->navParams['nPageSize']);

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
        <ul id="pagination"><?

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