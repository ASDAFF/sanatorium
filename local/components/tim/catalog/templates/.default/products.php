<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @var array $products */
/** @global CMain $APPLICATION */
/** @var Local\Catalog\TimCatalog $component */

$noFilters = count($component->filter['SEO']['PARTS']) == 0;

if ($noFilters)
{
	?>
    <div class="engBox-body">
        <div class="engText">
            <div class="it-title">Быстро и удобно купить путевку в санаторий КМВ!</div>
            <p>«Путёвочка» – это бесплатный сервис бронирования санаториев на КМВ. На нашем сайте вы можете ознакомиться
                с полным списком санаториев и выбрать самые оптимальные для вас варианты отдыха на Кавказских
                Минеральных Водах и забронировать путёвку. Профессиональные менеджеры проконсультируют вас по любым
                вопросам, связанным с лечением в санаториях - помогут определиться с необходимым профилем для лечения
                различных заболеваний, расскажут об актуальных акциях и скидках в санаториях.</p>
            <p>На нашем сайте вы покупаете путевки по официальным ценам. Каждый клиент получает бесплатный трансфер до
                санатория, скидки на любые экскурсии по Северному Кавказу, а также возможность бронирования номеров из
                закрытого резервного фонда здравниц. Вместе с нами вы сделаете правильный выбор и останетесь довольны
                лечением и отдыхом! </p>
        </div>
    </div>
	<?
}

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
            <img src="<?= $img['src'] ?>" alt="<?= $alt ?>" title="<?= $alt ?>">
        </div>
        <div class="text">
			<div class="san-name"><a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="title">Санаторий <?= $item['NAME'] ?></a></div><?

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
				        $distance = $infraItem['CODE'] == 'buvet' && $item['DISTANCE'];
				        if (in_array($infraItem['ID'], $item['INFRA']) || $distance)
				        {
					        $name = $infraItem['NAME'];
					        if ($distance)
						        $name = 'Расстояние до бювета: ' . $item['DISTANCE'] . 'м';

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
            <span>за человека в сутки</span>
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="btn">Подробнее</a>
        </div><?

		if ($actions)
		{
			?>
            <div class="action-mark"></div><?
		}

		?>
    </div>
    </div><?
}

?>
</div><?

if ($noFilters)
{
	?>
    <div class="engBox-body">
        <div class="engText">
            <div class="it-title">Лечение в санаториях КМВ – это не только вклад в здоровье, но и приятные
                воспоминания!
            </div>
            <p>Поездка «на воды» уже давно стал хорошо себя зарекомендовавшим трендом. Со времен открытия первых
                целебных источников в начале ХIХ века и сегодня – города-курорты стабильно развивают свою инфраструктуру
                и улучшают туристический сервис. Ежегодно регион КМВ принимает гостей не только из других городов нашей
                страны, но и из разных стран мира. Здравницы Пятигорска, Железноводска, Ессентуков и Кисловодска – это
                учреждения с 200-летней историей, признанные лидеры в сфере санаторно-курортного лечения России.</p>
            <p>Экологически чистый регион КМВ объединяет культуру и традиции десятков народов, в каждом городе-курорте
                свои особенности и все санатории по-своему уникальны. Даже основываясь на своих показаниях к лечению и
                бюджете, вам придется сделать выбор из двух-трех десятков мест. Именно для того, чтобы облегчить эту
                непростую задачу мы создали сервис бесплатного бронирования «Путёвочка». Быстрый поиск для бронирования
                мест в санаториях по многочисленным параметрам, качественные фотографии интерьеров, бесплатные
                консультации по всем интересующим вас вопросам – то, что поможет вам провести время с пользой для
                здоровья и получить массу положительных впечатлений.</p>
        </div>
    </div>
	<?
}

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

