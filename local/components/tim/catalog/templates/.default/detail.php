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

?>
<div id="cron_full">
    <div id="cron" class="engBox-body">
        <div id="cron-right">
	        <div class="rating" title="<?= $product['PRODUCT']['RATING'] ?>"><?
		        for ($i = 0.5; $i < 5; $i++)
		        {
			        $cl = $product['PRODUCT']['RATING'] >= $i ? 'on' : 'of';
			        ?>
			        <div class="star"><span class="<?= $cl ?>"></span></div><?
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
            <span><?= $product['NAME'] ?></span>
        </div>
        <div id="cron-title"><h1><?= $product['NAME'] ?></h1></div>
    </div>
</div>
<div class="engBox-body page-card">
    <div class="engBox-center">
    <div id="content"><?

        //
        // Адрес
        //
        ?>
        <div id="content-top"><?= $product['ADDRESS'] ?></div><?

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
        <style>
	        #tabs-content .tab-pane {
		        display: none;
	        }
	        #tabs-content .tab-pane.active {
		        display: block;
	        }
        </style>
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
<div id="map" class="clear">
    <iframe src="<?=$product['PRODUCT']['LINK_MAPS']?>" width="100%" height="400" frameborder="0"></iframe>
</div>
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
	$APPLICATION->SetPageProperty('title', $product['TITLE']);
if ($product['DESCRIPTION'])
	$APPLICATION->SetPageProperty('description', $product['DESCRIPTION']);
