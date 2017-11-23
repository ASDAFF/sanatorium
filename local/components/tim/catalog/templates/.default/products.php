<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @var array $products */
/** @var array $filter */
/** @global CMain $APPLICATION */
/** @var Local\Catalog\TimCatalog $component */

if ($component->seo['TEXT'])
{
	?>
    <div class="engBox-body">
        <div class="engText"><?= $component->seo['TEXT'] ?></div>
    </div><?
}

//if(isset($_GET['test'])):?>
    <div class="engBox-body">
        <div class="form__banner">
            <div class="form__banner__text">
                <span class="form__banner__text_head">Хотите поехать в санаторий на Новый год?</span>
                <span class="form__banner__text_center">У нас лучшие предложения!</span>
                <span class="form__banner__text_footer">Оставьте заявку на отдых и мы Вам перезвоним! </span>
            </div>
            <div class="form__banner__body">
                <form method="post" action="/ajax/sanatorium.php" class="js-sanatorium-form">
                    <div class="form__banner__input">
                        <input name="name" class="form__banner__input__control" type="text" placeholder="имя">
                        <div class="form__banner__input__log"></div>
                    </div>
                    <div class="form__banner__input">
                        <input name="phone" class="form__banner__input__control" type="text" placeholder="телефон">
                        <div class="form__banner__input__log"></div>
                    </div>
                    <div class="form__banner__btn">
                        <span class="form__banner__btn__control">отправить</span>
                    </div>
                </form>
            </div>
            <div class="form__banner__bg">
                <div class="form__banner__bg_santa"></div>
                <div class="form__banner__bg_snow_1"></div>
                <div class="form__banner__bg_snow_2"></div>
                <div class="form__banner__bg_snow_3"></div>
                <div class="form__banner__bg_snow_4"></div>
                <div class="form__banner__bg_snow_5"></div>
                <div class="form__banner__bg_snow_6"></div>
                <div class="form__banner__bg_snow_7"></div>
            </div>
        </div>
    </div>
<?//endif;

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

//
// Собираем массив из меток и элементов инфраструктуры
// в нужной последовательности (сначала фильтруемые)
//
$icons = array();
$ex = array();
foreach ($filter['GROUPS'] as $group)
{
	foreach ($group['ITEMS'] as $code => $item)
	{
        if ($item['CHECKED'])
		{
			if ($group['TYPE'] == 'infra')
            {
				$ex[$item['ID']] = true;
				$icons[] = array(
                    'TYPE' => 'infra',
                    'ID' => $item['ID'],
                    'NAME' => $item['NAME'],
                    'CODE' => $code,
                );
            }
            elseif ($group['TYPE'] == 'flags')
			{
				$icons[] = array(
					'TYPE' => 'flags',
					'ID' => $item['CODE'],
					'NAME' => $item['NAME'],
					'CODE' => $code,
				);
			}
		}
	}
}
$infra = \Local\Catalog\Infra::getAll();
foreach ($infra['ITEMS'] as $infraItem)
{
    if ($ex[$infraItem['ID']])
        continue;

	$icons[] = array(
		'TYPE' => 'infra',
		'ID' => $infraItem['ID'],
		'NAME' => $infraItem['NAME'],
		'CODE' => $infraItem['CODE'],
	);
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
	$city = \Local\Catalog\City::getById($item['CITY']);
	$alt = 'Санаторий ' . $item['NAME'] . ' ' . $city['NAME'];
	$reviewsCount = \Local\Catalog\Reviews::getCountBySanatorium($id);
	$reviewsCountTitle = '';
	if ($reviewsCount)
		$reviewsCountTitle .= $reviewsCount . pluralize($reviewsCount, array(' отзыв', ' отзыва', ' отзывов'));

	$actions = \Local\Catalog\Action::getBySanatorium($item['ID']);

	?>
    <div class="el-search-list engBox-body">
    <div class="item">
        <div class="img">
			<img src="<?= $img['src'] ?>" alt="<?= $alt ?>" title="<?= $alt ?>"><?

			if ($item['NEW_YEAR_TAB'])
			{
				?>
				<a href="<?= $item['DETAIL_PAGE_URL'] ?>newyear/" class="new-year-mark"></a><?
			}

			?>
        </div>
        <div class="text">
			<div class="san-name"><a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="title">Санаторий <?= $item['NAME'] ?></a></div>
			<div class="san-city">г. <?= $city['NAME'] ?></div><?

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
			        $cnt = 0;
			        foreach ($icons as $icoItem)
			        {
			            $distance = false;
			            $exist = false;
			            if ($icoItem['TYPE'] == 'infra')
						{
							$distance = $icoItem['CODE'] == 'buvet' && $item['DISTANCE'];
							$exist = in_array($icoItem['ID'], $item['INFRA']) || $distance;
						}
						elseif ($icoItem['TYPE'] == 'flags')
                        {
                            // в этом случе уже отфильтровано
							$exist = true;
                        }

				        if ($exist)
				        {
					        $name = $icoItem['NAME'];
					        if ($distance)
						        $name = 'Расстояние до бювета: ' . $item['DISTANCE'] . 'м';

					        ?>
					        <li>
                                <i class="in-icon icon-<?= $icoItem['CODE'] ?>"></i>
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
                <div class="rating-title">Рейтинг</div>
	            <div class="rating" title="<?= $item['RATING'] ?>"><?
		            for ($i = 0; $i < 5; $i++)
		            {
			            $cl = 'of';
			            $style = '';
			            if ($item['RATING'] > $i)
			            {
				            $cl = 'on';
				            $x = ($item['RATING'] - $i) * 100;
				            if ($x < 100)
					            $style = ' style="width:' . $x . '%"';
			            }
			            ?>
			            <div class="star"><span class="<?= $cl ?>"<?= $style ?>></span></div><?
		            }
		            ?>
                </div><?

				if ($reviewsCount)
				{
				    ?>
                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>reviews/"><span><?= $reviewsCountTitle ?></span></a><?
				}

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
                от <b><?= $item['PRICE'] ?></b> руб.
            </div>
            <span>за человека в сутки</span>
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="btn">Заказать</a>
        </div><?

		if ($actions)
		{
			?>
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>action/" class="action-mark"><b class="action-mark__text">Акция!</b></a><?
		}

		?>
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
                <a href="<?= P_HREF ?><?= $href ?>" data-page="<?= ($iCur - 1) ?>"></a>
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
                <a href="<?= P_HREF ?><?= $href ?>" data-page="1">1</a>
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
                    <a href="<?= P_HREF ?><?= $href ?>" data-page="<?= $i ?>"><?= $i ?></a>
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
                <a href="<?= P_HREF ?><?= $href ?>" data-page="<?= $iEnd ?>"><?= $iEnd ?></a>
                </li><?
            }
            if ($iCur < $iEnd) {
                $href = $urlPage . ($iCur + 1);
                ?>
                <li class="next">
                <a href="<?= P_HREF ?><?= $href ?>" data-page="<?= ($iCur + 1) ?>"></a>
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

if ($component->seo['TEXT1'])
{
	?>
    <div class="engBox-body">
        <div class="engText"><?= $component->seo['TEXT1'] ?></div>
    </div><?
}


