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
	),
	'rooms' => array(
		'NAME' => 'Номера и цены',
	    'TITLE' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] . ': номера и цены на 2017 год',
	    'DESCR' => 'Цены на 2017 год в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
		    '. Бронируйте номера в санаторий «' . $product['TITLE'] . '» на сайте или по телефону ' . $phone . '.',
	    'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' цены на 2017 год',
	),
	'profiles' => array(
		'NAME' => 'Профили лечения',
	    'TITLE' => 'Профили лечения в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
	    'DESCR' => 'Получить консультацию специалиста по профилям лечения в санатории «' . $product['TITLE'] . '» г.' .
		    $product['CITY']['UF_PREDL'] . ' Вы можете на сайте или по телефону ' . $phone . '.',
	    'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' профили лечения',
	),
	'programms' => array(
		'NAME' => 'Программы лечения',
		'TITLE' => 'Программы лечения в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Получить консультацию специалиста по программам лечения в санатории «' . $product['TITLE'] . '» г.' .
			$product['CITY']['UF_PREDL'] . ' Вы можете на сайте или по телефону ' . $phone . '.',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' программы лечения',
	),
	'infra' => array(
		'NAME' => 'Инфраструктура',
		'TITLE' => 'Инфраструктура санатория «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
			' : инфраструктура. Получить информацию по инфраструктуре санатория «' . $product['TITLE'] .
			'» Вы можете на сайте или по телефону ' . $phone . '.',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' инфраструктура',
	),
	'feed' => array(
		'NAME' => 'Питание',
		'TITLE' => 'Питание в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
			' : питание. Получить информацию по питанию в санатории «' . $product['TITLE'] .
			'» Вы можете на сайте или по телефону ' . $phone . '.',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' питание',
	),
	'child' => array(
		'NAME' => 'Детям',
		'TITLE' => 'Размещение детей в санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Получить информацию по лечению или размещению детей в санатории «' . $product['TITLE'] .
			'» Вы можете на сайте или по телефону ' . $phone . '.',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' размещение детей',
	),
	'video' => array(
		'NAME' => 'Видео',
		'TITLE' => 'Видео о санатории «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'],
		'DESCR' => 'Санаторий «' . $product['TITLE'] . '» в ' . $product['CITY']['UF_PREDL'] .
			' : видео. Информация о санатории «' . $product['TITLE'] . '» на официальном сайте сервиса «' . $siteName . '».',
		'KW' => $product['TITLE'] . ' в ' . $product['CITY']['UF_PREDL'] . ' видео',
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
	),
);

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
                Цена от <b><?= $product['PRODUCT']['PRICE'] ?></b> руб<br><span>за номер в сутки</span>
            </div>
        </div>
        <div id="cron-crox">
            <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemref="breadcrumb-1"><a itemprop="url" href="/"><span itemprop="title">Главная</span></a></span> -
            <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemref="breadcrumb-2" id="breadcrumb-1"><a itemprop="url" href="/sanatorium/"><span itemprop="title">Санатории</span></a></span> -
            <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemref="breadcrumb-3" id="breadcrumb-2"><a itemprop="url" href="/sanatorium/<?= $product['CITY']['CODE'] ?>/"><span itemprop="title"><?= $product['CITY']['NAME'] ?></span></a></span> -
            <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemref="breadcrumb-4" id="breadcrumb-3"><a itemprop="url" class="js-bc-detail" href="<?= $product['DETAIL_PAGE_URL'] ?>"<?= $style ?>><span itemprop="title"><?= $product['NAME'] ?></span></a></span>
            <span class="js-bc-sep"<?= $style ?>> - </span><span class="js-bc-last"><?= $tabName ?></span>
        </div>
        <div id="cron-title"><h1>Санаторий «<?= $product['NAME'] ?>»<span class="js-tab-name"><?= $tabH1 ?></span></h1></div>
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
        </div>

        //
        // Адрес
        //
        ?>
        <a href="#map" id="content-top" itemprop="address"><?= $product['ADDRESS'] ?></a><?

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
					if ($code != 'main')
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
					$class = $code == $tabCode ? ' active' : ' empty';
					?>
					<div class="tab-pane<?= $class ?>" id="<?= $code ?>"><?

						if ($code == $tabCode)
							\Local\Catalog\Sanatorium::printTab($product, $code);

						?>
					</div><?
				}

			?>
			</div>
		</div>
    </div>
    </div>
    <div class="engBox-right card-form">
        <div id="right-form">
            <form method="POST" id="formx" eng-form="bron" action="javascript:void(null);">
                <div class="controlgroup mobile" style="color: #505050;">
                    <div class="title">Заполните форму<br><span>чтобы узнать стоимость путевки</span></div>

                    <input type="text" id="datepicker" name="date_on" placeholder="Дата заезда" class="icon-date">
                    <input type="text" id="datepicker2" name="date_off" placeholder="Дата выезда" class="icon-date">

                    <div style="margin-top: 5px; ">
                        <div style="float: right;">
                            <select id="car-type" name="adults" class="input-right">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div style=" padding: 4px 8px;">Взрослых</div>
                    </div>
                    <br>
                    <div style="margin-bottom: 15px;">
                        <div style="float: right">
                            <select id="car-type2" name="child" class="input-right">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div style="padding: 4px 8px;">Детей</div>
                    </div>

                    <select id="car-type3" name="room" class="input-right icon-key">
                        <option value="0">Выберите номер</option><?
                        foreach ($product['ROOMS'] as $room)
                        {
                            ?>
                            <option value="<?= $room['ID'] ?>"><?= $room['NAME'] ?></option><?
                        }
                        ?>
                    </select>
                    <br><br>

                    <div class="engInputLog" eng-input="name"></div>
                    <input type="text" name="name" placeholder="Введите имя *"
                           autocomplete="off" class="icon-user" required />

                    <div class="engInputLog" eng-input="phone"></div>
                    <input type="text" name="phone" placeholder="Введите номер телефона *"
                           autocomplete="off" class="icon-phone2" required />







                    <input name="transfer" type="checkbox" class="checkbox-trf" id="checkbox-tr"/>
                    <label for="checkbox-tr" class='checkbox-tr-btn'>Бесплатный трансфер</label>
                    <input type="submit" id="form_btn" class="btn" value="Узнать стоимость со скидкой">
                </div>
            </form>
	        <div id="bronx" class="okno" style="display: none"></div>
        </div>
    </div>
    <div class="engBox-right"><?
        $APPLICATION->IncludeComponent('tim:empty', 'banners');
        ?>
    </div>
</div>
<?
//
// Форма "задать вопрос"
//
$APPLICATION->IncludeComponent('tim:empty', 'feedback_form');
?>

<script type="text/javascript">var yMapPoint = [<?= $product['YMAP'] ?>]</script>
<div id="map" style="width:100%; height:300px"></div>

<?
$APPLICATION->IncludeComponent('tim:empty', 'reviews.list', array(
	'ID' => $product['ID'],
));

$APPLICATION->SetTitle($product['NAME']);
$APPLICATION->SetPageProperty('title', $currentTab['TITLE']);
$APPLICATION->SetPageProperty('description', $currentTab['DESCR']);
$APPLICATION->SetPageProperty('keywords', $currentTab['KW']);

$APPLICATION->SetPageProperty('og_title', $currentTab['TITLE']);
$APPLICATION->SetPageProperty('og_description', $currentTab['DESCR']);
$APPLICATION->SetPageProperty('og_url', 'https://putevochka.com' . $APPLICATION->GetCurDir());
if ($pics[0]['src'])
    $APPLICATION->SetPageProperty('og_image', 'https://putevochka.com' . $pics[0]['src']);
$APPLICATION->SetPageProperty('og_type', 'website');
