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

$tabs = array(
	'main' => 'О санатории',
	'rooms' => 'Номера',
	'profiles' => 'Профили лечения',
	'programms' => 'Программы лечения',
	'infra' => 'Инфраструктура',
	'feed' => 'Питание',
	'child' => 'Детям',
	'video' => 'Видео',
	'action' => 'Акции',
	'docs' => 'Документы для заезда',
);

$tabName = $product['NAME'];
$tabH1 = '';
$style = ' style="display:none;"';
if ($tabCode != 'main')
{
	$tabName = $tabs[$tabCode];
	$tabH1 = ': ' . $tabName;
	$style = '';
}

?>
<div id="cron_full">
    <div id="cron" class="engBox-body">
        <div id="cron-right">
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
            <a href="/">Главная</a> -
            <a href="/sanatorium/">Санатории</a> -
            <a href="/sanatorium/<?= $product['CITY']['CODE'] ?>/"><?= $product['CITY']['NAME'] ?></a> -
            <a class="js-bc-detail" href="<?= $product['DETAIL_PAGE_URL'] ?>"<?= $style ?>><?= $product['NAME'] ?></a>
            <span class="js-bc-sep"<?= $style ?>> - </span><span class="js-bc-last"><?= $tabName ?></span>
        </div>
        <div id="cron-title"><h1>Санаторий <?= $product['NAME'] ?><span class="js-tab-name"><?= $tabH1 ?></span></h1></div>
    </div>
</div>
<div class="engBox-body page-card">
    <div class="engBox-center">
    <div id="content"><?

        //
        // Адрес
        //
        ?>
        <a href="#map" id="content-top"><?= $product['ADDRESS'] ?></a><?

        //
        // Картинки
        //
	    $file = new \CFile();
	    $pics = array();
	    foreach ($product['PICTURES'] as $value)
	    {
		    $img = $file->ResizeImageGet(
			    $value,
			    array(
				    'width' => 10000,
				    'height' => 526
			    ),
			    BX_RESIZE_IMAGE_PROPORTIONAL,
			    true
		    );
		    $pics[] = $img;
	    }
        ?>
        <div id="sync1" class="owl-carousel"><?
            foreach ($pics as $img)
            {
                ?>
                <div class="item"><img src="<?= $img['src'] ?>" /></div><?
            }
            ?>
        </div>
        <div id="sync2" class="owl-carousel"><?
	        foreach ($pics as $img)
            {
                ?>
                <div class="item"><img src="<?= $img['src'] ?>" /></div><?
            }
            ?>
        </div><?

		//
		// Заголовки табов
		//
		?>
        <div id="tabs" class="content-menu content-menu-buttons-box">
            <ul id="content-menu-show" class="content-menu-buttons" data-id="<?= $product['ID'] ?>"><?

				foreach ($tabs as $code => $name)
				{
					$class = '';
					if ($code == $tabCode)
						$class = ' class="active"';
					$href = $product['DETAIL_PAGE_URL'];
					if ($code != 'main')
						$href .= $code . '/';
					?>
					<li<?= $class?>><a id="tab-<?= $code ?>" data-id="#<?= $code ?>" href="<?= $href ?>"><?= $name ?></a></li><?
				}
				?>
			</ul>
            <div class="content-border"></div><?

			//
			// Содержание табов
			//
			?>
			<div id="tabs-content"><?

				foreach ($tabs as $code => $name)
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
            <form method="POST" id="formx" action="javascript:void(null);">
                <div class="controlgroup mobile" style="color: #505050;">
                    <div class="title">Забронируйте номер<br><span>Прямо сейчас!</span></div>
                    <input type="text" name="name" placeholder="Введите имя"
                           autocomplete="off" class="icon-user" required />
                    <input type="text" name="phone" placeholder="Введите номер телефона"
                           autocomplete="off" class="icon-phone2" required />
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
                    <div style="margin-top: 30px; ">
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
                    <div>
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
                    <input type="text" id="datepicker" name="date_on" placeholder="Дата заезда" class="icon-date">
                    <input type="text" id="datepicker2" name="date_off" placeholder="Дата выезда" class="icon-date">
                    <input name="transfer" type="checkbox" class="checkbox-trf" id="checkbox-tr"/>
                    <label for="checkbox-tr" class='checkbox-tr-btn'>Бесплатный трансфер</label>
                    <input type="submit" id="form_btn" class="btn" value="ЗАБРОНИРОВАТЬ">
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


<script type="text/javascript">
    ymaps.ready(init);

    function init () {
        var myMap = new ymaps.Map("map", {
                center: [43.902580351584, 42.723535988083],
                zoom: 17
            }),

            // Создаем метку с помощью вспомогательного класса.
            myPlacemark1 = new ymaps.Placemark([43.902580351584, 42.723535988083], {
                // Свойства.
                // Содержимое иконки, балуна и хинта.
                iconContent: '1',
                balloonContent: 'Балун',
                hintContent: 'Стандартный значок метки'
            }, {
                // Опции.
                // Стандартная фиолетовая иконка.
                preset: 'twirl#violetIcon'
            });
        // Добавляем все метки на карту.
        myMap.geoObjects
            .add(myPlacemark1);
    }

</script>

<div id="map" style="width:100%; height:300px"></div>

<?
$APPLICATION->IncludeComponent('tim:empty', 'reviews.list', array(
	'ID' => $product['ID'],
));

/*
$APPLICATION->AddChainItem('Санатории', '/sanatorium/');
$APPLICATION->AddChainItem($product['CITY']['NAME'], '/sanatorium/' . $product['CITY']['CODE'] . '/');
$APPLICATION->AddChainItem($product['NAME']);*/

$APPLICATION->SetTitle($product['NAME']);
if ($product['TITLE'])
	$APPLICATION->SetPageProperty('title', 'Санаторий ' . $product['TITLE'] . $tabH1);
if ($product['DESCRIPTION'])
	$APPLICATION->SetPageProperty('description', $product['DESCRIPTION']);
