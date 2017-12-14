<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var Local\Catalog\TimCatalog $component */

$product = $component->product;
$tabCode = $component->tabCode;
if (!$tabCode)
	$tabCode = 'main';

$arYMap = explode(',', $product['YMAP']);

$phone = '8 800 775 2604';
$siteName = 'Путевочка';
$tabs = array(
	'main' => array(
		'NAME' => 'О санатории',
	    'TITLE' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] . ' — официальный сайт Путевочка',
	    'DESCR' => 'Бронирование санатория «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
		    ' на официальном сайте сервиса «' . $siteName . '». Заказ оздоровительных путевок в санаторий «' .
		    $product['TITLE'] . '» по телефону ' . $phone . '.',
	    'KW' => 'Санаторий ' . $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'],
        'BASE_URL' => true,
	),
	'rooms' => array(
		'NAME' => 'Номера и цены',
	    'TITLE' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] . ': номера и цены на 2017 год',
	    'DESCR' => 'Цены на 2017 год в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
		    '. Бронируйте номера в санаторий «' . $product['TITLE'] . '» на сайте или по телефону ' . $phone . '.',
	    'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' цены на 2017 год',
	),
	/*'profiles' => array(
		'NAME' => 'Профили лечения',
	    'TITLE' => 'Профили лечения в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
	    'DESCR' => 'Получить консультацию специалиста по профилям лечения в санатории «' . $product['TITLE'] . '» г.' .
		    $product['CITY']['UF_PREDL'] . ' Вы можете на сайте или по телефону ' . $phone . '.',
	    'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' профили лечения',
	),*/
	'programms' => array(
		'NAME' => 'Программы лечения',
		'TITLE' => 'Программы лечения в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Получить консультацию специалиста по программам лечения в санатории «' . $product['TITLE'] . '» г.' .
			$product['CITY']['UF_PREDL'] . ' Вы можете на сайте или по телефону ' . $phone . '.',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' программы лечения',
		'BASE_URL' => true,
	),
	'infra' => array(
		'NAME' => 'Инфраструктура',
		'TITLE' => 'Инфраструктура санатория «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
			' : инфраструктура. Получить информацию по инфраструктуре санатория «' . $product['TITLE'] .
			'» Вы можете на сайте или по телефону ' . $phone . '.',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' инфраструктура',
		'BASE_URL' => true,
	),
	/*'feed' => array(
		'NAME' => 'Питание',
		'TITLE' => 'Питание в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
			' : питание. Получить информацию по питанию в санатории «' . $product['TITLE'] .
			'» Вы можете на сайте или по телефону ' . $phone . '.',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' питание',
	),*/
	'child' => array(
		'NAME' => 'Детям',
		'TITLE' => 'Размещение детей в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Получить информацию по лечению или размещению детей в санатории «' . $product['TITLE'] .
			'» Вы можете на сайте или по телефону ' . $phone . '.',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' размещение детей',
		'BASE_URL' => true,
	),
	'video' => array(
		'NAME' => 'Видео',
		'TITLE' => 'Видео о санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
			' : видео. Информация о санатории «' . $product['TITLE'] . '» на официальном сайте сервиса «' . $siteName . '».',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' видео',
	),
	'reservation' => array(
		'NAME' => 'Бронирование',
		'TITLE' => 'Бронирование в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => '',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' бронировании',
	),
	'action' => array(
		'NAME' => 'Акции',
		'TITLE' => 'Акции в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
			' : акции. Получить информацию об акциях в санатории «' . $product['TITLE'] .
			'» Вы можете на сайте или по телефону ' . $phone . '.',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' акции',
	),
	'docs' => array(
		'NAME' => 'Документы для заезда',
		'TITLE' => 'Документы для заезда в санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Какие документы требуются для заезда в санаторий «' . $product['TITLE'] . '» в ' .
			$product['CITY']['UF_PREDL'] . '. Узнать как получить документы Вы можете на сайте или по телефону  ' . $phone . '.',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' документы для заезда',
		'BASE_URL' => true,
	),
	'reviews' => array(
		'NAME' => 'Отзывы',
		'TITLE' => 'Отзывы о санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
			' : отзывы. Информация о санатории «' . $product['TITLE'] . '» на официальном сайте сервиса «' . $siteName . '».',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' отзывы',
	),
	'map' => array(
		'NAME' => 'Карта',
		'TITLE' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] . ' на карте',
		'DESCR' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
			' : карта. Информация о санатории «' . $product['TITLE'] . '» на официальном сайте сервиса «' . $siteName . '».',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' карта',
	),
	'newyear' => array(
		'NAME' => 'Новый Год',
		'TITLE' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] . ' новый год 2018 — «' . $siteName . '»',
		'DESCR' => 'Цены на новый год 2018 в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
			'. Забронируйте санаторий «' . $product['TITLE'] . '» на новый год по телефону ' . $phone,
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' карта',
	),
);

foreach ($tabs as $code => $tab)
{
	$upCode = strtoupper($code);
	foreach ($tab as $k => $v)
		if ($product['SEO'][$upCode][$k])
			$tabs[$code][$k] = $product['SEO'][$upCode][$k];
}

$tabName = $product['NAME'];
$tabH1 = '';
$style = ' style="display:none;"';
if ($tabCode != 'main')
{
	$tabName = $tabs[$tabCode]['NAME'];
	$tabH1 = ': ' . $tabName;
	$style = '';
}

$currentTab = $tabs[$tabCode];

?>
<div id="cron_full">
    <div id="cron" class="engBox-body">
        <div id="cron-right">
            <div class="rating-title">Рейтинг</div>
	        <div class="rating" title="<?= $product['RATING'] ?>"><?
		        for ($i = 0; $i < 5; $i++)
		        {
			        $cl = 'of';
			        $st = '';
			        if ($product['RATING'] > $i)
			        {
				        $cl = 'on';
				        $x = ($product['RATING'] - $i) * 100;
				        if ($x < 100)
					        $st = ' style="width:' . $x . '%"';
			        }
			        ?>
			        <div class="star"><span class="<?= $cl ?>"<?= $st ?>></span></div><?
		        }
		        ?>
	        </div>
            <div>
                <div class="price">Цена от <b><?= $product['PRODUCT']['PRICE'] ?></b> руб</div><span>за человека в сутки</span>
            </div>
        </div>
        <div id="cron-crox">
            <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" class="js-bc-detail" href="<?= $product['DETAIL_PAGE_URL'] ?>"<?= $style ?>><span itemprop="title">Санаторий <?= $product['NAME'] ?></span></a></span>
            <span class="js-bc-sep"<?= $style ?>> - </span><span class="js-bc-last"><?= $tabName ?></span>
        </div>
        <div id="cron-title"><h1>Санаторий <?= $product['NAME'] ?><span class="js-tab-name"><?= $tabH1 ?></span></h1></div>
    </div>
</div>
<div class="engBox-body page-card" itemscope itemtype="http://schema.org/Hotel">
    <div class="engBox-center">
    <div id="content">
        <span itemprop="name" style="display:none;"><?= $product['NAME'] ?></span>
        <span itemprop="priceRange" style="display:none;"><?= $product['PRODUCT']['PRICE'] ?></span>
        <span itemprop="starRating" style="display:none;"><?= $product['RATING'] ?></span>
        <span itemprop="telephone" style="display:none;">88007752604</span>
        <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
            <meta itemprop="latitude" content="<?= $arYMap[0] ?>" />
            <meta itemprop="longitude" content="<?= $arYMap[1] ?>" />
        </div><?

        //
        // Адрес
        //


        //
        // Картинки
        //
		$alt = 'Санаторий ' . $product['NAME'] . ' ' . $product['CITY']['NAME'];
	    $file = new \CFile();
	    $pics = array();
        $arWaterMark = array(
            array(
                'name' => 'watermark',
                'position' => 'center',
                'size' => 'real',
                'file' => $_SERVER['DOCUMENT_ROOT'] . '/images/watermarks/big.png',
            ),
        );
	    foreach ($product['PICTURES'] as $value)
	    {
		    $img = $file->ResizeImageGet(
			    $value,
			    array(
				    'width' => 10000,
				    'height' => 526
			    ),
			    BX_RESIZE_IMAGE_PROPORTIONAL,
			    true,
                $arWaterMark
		    );
		    $pics[] = $img;
	    }
        ?>
        <span itemprop="image" style="display:none;">https://putevochka.com<?= $pics[0]['src'] ?></span>
        <div id="sync1" class="owl-carousel" itemprop="photos"><?
            foreach ($pics as $img)
            {
                ?>
                <div class="item"><img src="<?= $img['src'] ?>" alt="<?= $alt ?>" title="<?= $alt ?>" /></div><?
            }
            ?>
        </div>
        <div class="all-photo-cont"><a target="_blank" href="<?= $product['DETAIL_PAGE_URL'] ?>photo/" class="all-photo"><span>смотреть все фотографии</span></a></div>
        <div id="sync2" class="owl-carousel"><?
	        foreach ($pics as $img)
            {
                ?>
                <div class="item"><img src="<?= $img['src'] ?>" alt="<?= $alt ?>" title="<?= $alt ?>" /></div><?
            }
            ?>
        </div><?

		//
		// Заголовки табов
		//
		?>
        <div id="tabs" class="content-menu content-menu-buttons-box">
            <ul id="content-menu-show" class="content-menu-buttons" data-id="<?= $product['ID'] ?>"><?

				foreach ($tabs as $code => $tab)
				{
					$name = $tab['NAME'];
					$class = '';
					if ($code == $tabCode)
						$class = ' class="active"';
					$href = $product['DETAIL_PAGE_URL'];
					if (!$tab['BASE_URL'])
						$href .= $code . '/';
					?>
					<li<?= $class?> data-title="<?= $tab['TITLE'] ?>"><a id="tab-<?= $code ?>" data-id="#<?= $code ?>" href="<?= $href ?>"><?= $name ?></a></li><?
				}
				?>
			</ul>
            <div class="content-border"></div><?

			//
			// Содержание табов
			//
			?>
			<div id="tabs-content"><?

				foreach ($tabs as $code => $tab)
				{
					$class = $code == $tabCode ? ' active' : ($code == 'reservation' ? '' : ' empty');
					?>
					<div class="tab-pane<?= $class ?>" id="<?= $code ?>"><?

						if ($code == $tabCode)
							\Local\Catalog\Sanatorium::printTab($product, $code);

						if ($code == 'reservation')
							include('calc_tab.php');

						?>
					</div><?
				}

			?>
			</div>
		</div>
    </div>
    </div><?

	//
	// Форма справа "Узнать стоимость" (сломанное бронирование)
	//
    include ('calc.php');

    ?>
    <div class="engBox-right"><?
        $APPLICATION->IncludeComponent('tim:empty', 'banners');
        ?>
    </div>
</div><?

//
// Форма "задать вопрос"
//
$APPLICATION->IncludeComponent('tim:empty', 'feedback_form');

$APPLICATION->SetTitle($product['NAME']);
$APPLICATION->SetPageProperty('title', $currentTab['TITLE']);
$APPLICATION->SetPageProperty('description', $currentTab['DESCR']);
$APPLICATION->SetPageProperty('keywords', $currentTab['KW']);

$APPLICATION->SetPageProperty('og_title', $currentTab['TITLE']);
$APPLICATION->SetPageProperty('og_description', $currentTab['DESCR']);
$APPLICATION->SetPageProperty('og_url', P_HREF . $APPLICATION->GetCurDir());
if ($pics[0]['src'])
    $APPLICATION->SetPageProperty('og_image', P_HREF . $pics[0]['src']);
$APPLICATION->SetPageProperty('og_type', 'website');
