<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var Local\Catalog\TimCatalog $component */

$product = $component->product;
$tabCode = $component->tabCode;

$pr = \Local\Catalog\Profiles::getList($product["PRODUCT"]['PROFILES']);
$info = \Local\Catalog\Sanatorium::getInfo($product["PRODUCT"]['INFRASTRUCTURES']);
$program = \Local\Catalog\Sanatorium::getParam($product["PRODUCT"]['PROGRAMMS']);
$shares = \Local\Catalog\Sanatorium::getShares($product["PRODUCT"]['SHARES']);
$ro = \Local\Catalog\Sanatorium::getRo($product["PRODUCT"]['PRICES']);
$rooms = \Local\Catalog\Sanatorium::getMinPriceRooms($product["PRODUCT"]['PRICES']);
//debugmessage($pr);
?>

    <div id="cron_full">
        <div id="cron" class="engBox-body">
            <div id="cron-right">
                <div id="reviewStars-input">
                    <input id="star-4" type="radio" name="reviewStars1"/>
                    <label title="gorgeous" for="star-4"></label>

                    <input id="star-3" type="radio" name="reviewStars1"/>
                    <label title="good" for="star-3"></label>

                    <input id="star-2" type="radio" name="reviewStars1"/>
                    <label title="regular" for="star-2"></label>

                    <input id="star-1" type="radio" name="reviewStars1"/>
                    <label title="poor" for="star-1"></label>

                    <input id="star-0" type="radio" name="reviewStars1"/>
                    <label title="bad" for="star-0"></label>
                </div>
                <div>
                    Цена от <b><?=$rooms[0]['PRICE']?></b> руб<br><span>за номер в сутки</span>
                </div>
            </div>
            <div id="cron-crox">
                <span>Главная</span> -
                <span><?= $product["CITY"]["NAME"] ?></span> -
                <a href="<?= $product['DETAIL_PAGE_URL'] ?>"><?= $product["NAME"] ?></a>
            </div>
            <div id="cron-title"><h1><?= $product["NAME"] ?></h1></div>
        </div>
    </div>
    <div class="engBox-body page-card">
        <div class="engBox-center">
            <div id="content">
                <div id="content-top"><?=$product["PRODUCT"]['ADDRESS']?></div>

                <!-- Place somewhere in the <body> of your page -->
                <div id="slider" class="flexslider">
                    <ul class="slides">

                        <? foreach ($product["PICTURES"] as $value): ?>
                            <li>
                                <img src="<?= $value ?>"/>
                            </li>
                        <? endforeach ?>

                    </ul>
                </div>
                <div id="carousel" class="flexslider carousel">
                    <ul class="slides">

                        <? foreach ($product["PICTURES"] as $value): ?>
                            <li>
                                <img src="<?= $value ?>"/>
                            </li>
                        <? endforeach ?>

                    </ul>
                </div>
                <div id="tabs" class="content-menu content-menu-buttons-box">
                    <ul id="content-menu-show" class="content-menu-buttons">
                        <li><a href="#tabs-1">О санатории</a></li>
                        <li><a href="#tabs-2">Номера</a></li>
                        <li><a href="#tabs-3">Профили лечения</a></li>
                        <li><a href="#tabs-4">Программы лечения</a></li>
                        <li><a href="#tabs-5">Инфраструктура</a></li>
                        <li><a href="#tabs-6">Питание</a></li>
                        <li><a href="#tabs-7">Детям</a></li>
                        <li><a href="#tabs-8">Видео</a></li>
                        <li><a href="#tabs-9">Акции</a></li>
                        <li><a href="#tabs-10">Документы для заезда</a></li>
                    </ul>

                    <div class="content-border"></div>
                    <div id="tabs-1">
                        <?= $product["DETAIL_TEXT"] ?></div>
                    <div id="tabs-2">
                        <? foreach ($ro as $item) { ?>
                            <div class="el-nomer">
                                <div class="item">
                                    <div class="img">
                                        <a href="#bron<?=$item['ID']?>" class="border various">
                                            <img src="<?=$item['PREVIEW_PICTURE']?>">
                                        </a>
                                    </div>
                                    <div class="text">
                                        <a href="#bron<?=$item['ID']?>" class="title various"><?=$item['NAME']?></a><br>
                                        <b>Площадь:</b> <?=$item['ROOM_SIZE']?> м2 <br><br>
                                        <b>Кровати:</b><?if($item['DOUBLE_BED'] != 0){?>
                                            Двуспальных кроватей <?=$item['DOUBLE_BED']?>,
                                        <?}?>
                                        <?if($item['SINGLE_BED'] != 0){?>
                                            Односпальных кроватей <?=$item['SINGLE_BED']?>
                                        <?}?><br><br>
                                        <b>Включено:</b> прожив<br><br>
                                    </div>
                                    <div class="inf">
                                        <div class="money">
                                            от <b><?=$item['PRICE']?></b> руб
                                        </div>
                                        <span>за номер в сутки</span>
                                        <a href="#bron<?=$item['ID']?>" class="btn various">Подробнее</a>
                                        <script type="text/javascript">
                                            $(function () {
                                                $('#slider-popap-1').flexslider({
                                                    animation: "slide",
                                                    controlNav: false,
                                                    animationLoop: false,
                                                    slideshow: false,
                                                    sync: "#carousel-popap-1",
                                                });
                                                // The slider being synced must be initialized first
                                                $('#carousel-popap-1').flexslider({
                                                    animation: "slide",
                                                    controlNav: false,
                                                    animationLoop: false,
                                                    slideshow: true,
                                                    itemWidth: 100,
                                                    itemHeight: 50,
                                                    itemMargin: 5,
                                                    asNavFor: '#slider-popap-1',
                                                });


                                            });

                                        </script>

                                    </div>

                                    <div id="bron<?=$item['ID']?>" class="okno" style="display: none">
                                        <div class="title"><?=$item['NAME']?></div>
                                        <div class="el-nomer-popap">
                                            <div class="left">
                                                <div class="slider">
                                                    <div id="slider-popap-1" class="flexslider">
                                                        <ul class="slides">
                                                            <? foreach ($item["MORE_PHOTO"] as $value): ?>
                                                                <li>
                                                                    <img src="<?= \CFile::GetPath($value) ?>"/>
                                                                </li>
                                                            <? endforeach ?>
                                                            <!-- items mirrored twice, total of 12 -->
                                                        </ul>
                                                    </div>
                                                    <div id="carousel-popap-1" class="flexslider carousel">
                                                        <ul class="slides">
                                                            <? foreach ($item["MORE_PHOTO"] as $value): ?>
                                                                <li>
                                                                    <img src="<?= \CFile::GetPath($value) ?>"/>
                                                                </li>
                                                            <? endforeach ?>
                                                            <!-- items mirrored twice, total of 12 -->
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="info-bottom">
                                                    <div class="right">

                                                        <div class="text">
                                                            <b>Площадь:</b> <?=$item['ROOM_SIZE']?> м2 <br>
                                                            <b>Кровати:</b><?if($item['DOUBLE_BED'] != 0){?>
                                                                Двуспальных кроватей <?=$item['DOUBLE_BED']?>,
                                                            <?}?>
                                                            <?if($item['SINGLE_BED'] != 0){?>
                                                                Односпальных кроватей <?=$item['SINGLE_BED']?>
                                                            <?}?><br><br>
                                                            <b>Включено:</b> прожив<br>
                                                            <b>Максимальная вместимость номера:</b><br>
                                                            <?=$item['MAIN_PLACES']+$item['ADD_PLACES']?> человек
                                                            <ul>
                                                                <li><span class="first">основных мест - <?=$item['MAIN_PLACES']?> шт</span></li>
                                                                <li><span class="first">дополнительных - <?=$item['ADD_PLACES']?> шт</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="icon">
                                                            <b>Удобства:</b>
                                                            <ul>
                                                                <li>
                                                                    <img src="images/icon/диван.png">
                                                                    <span>Отдых с детьми от 4 лет</span>
                                                                </li>
                                                                <li>
                                                                    <img src="images/icon/диван.png">
                                                                    <span>Отдых с детьми от 4 лет</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="inf">
                                                        <div class="price-start"><span class="txt">Цена за номер в сутки от</span><span
                                                                class="num"><?=$item['PRICE']?>р</span></div>
                                                        <i class="price-start-details">(в стоимость проживания входит
                                                            лечение по общетерапевтической путевке)</i>
                                                        <div class="tit">Стоимость основных мест:</div>
                                                        <ul>
                                                            <li>
                                                                <span class="first">одноместное (с подселением)</span>
                                                                <span class="second"><?=$item['PRICE']?>р</span>
                                                            </li>
                                                            <li>
                                                                <span class="first">одноместное (за номер)</span>
                                                                <span class="second"><?=$item['PRICE_FULL']?>р</span>
                                                            </li>
                                                        </ul>
                                                        <div class="tit">Стоимость дополнительных мест:</div>
                                                        <ul>
                                                            <li>
                                                                <span class="first">взрослое</span>
                                                                <span class="second"><?=$item['PROPERTY_PLACES_PRICE']?>р</span>
                                                            </li>
                                                            <li>
                                                                <span class="first">детское</span>
                                                                <span class="second"><?=$item['CHILD_PLACES_PRICE']?>р</span>
                                                            </li>

                                                        </ul>
                                                    </div>


                                                </div>
                                                <div style="text-align: center">
                                                    <input id="popup-bron-btn" type="button"
                                                           class="btn-okno ui-widget ui-controlgroup-item ui-button ui-corner-right"
                                                           href="" value="ЗАБРОНИРОВАТЬ" role="button">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>

                    <div id="tabs-3">
                        <div class="programs">
                            <? foreach ($pr as $value): ?>
                                <div class="programs-item">
                                    <div class="programs-title"><span
                                            class="icon" style="background: url(<?=$value['DETAIL_PICTURE']?>) no-repeat 50% 50%;"></span><span><?= $value["NAME"] ?></span></div>
                                    <ul class="programs-list">
                                        <?= $value["PREVIEW_TEXT"] ?>
                                    </ul>
                                </div>
                            <? endforeach ?>

                        </div>

                    </div>
                    <div id="tabs-4">
                        <div class="posts">

                            <? foreach ($program as $value): ?>
                                <div class="item">
                                    <div class="title"><?= $value["NAME"] ?></div>
                                    <div class="text preview-text">
                                        <div class="preview-text-inner">
                                            <?= $value["PREVIEW_TEXT"] ?>
                                        </div>
                                        <a href="#">Подробнее</a>
                                    </div>
                                    <div class="text okno detail-text hidden" style="display: none;">
                                        <h3 class="title"><?= $value["NAME"] ?></h3>
                                        <?= $value["DETAIL_TEXT"] ?>
                                    </div>
                                </div>
                            <? endforeach ?>

                        </div>


                    </div>
                    <div id="tabs-5">
                        <h2>Инфраструктура</h2>
                        <div class="infra-box">
                            <ul class="infra-list">
                                <? foreach ($info as $value): ?>
                                    <li><i class="in-icon"><img
                                                src="<?= $value['PREVIEW_PICTURE'] ?>"></i><span><?= $value['NAME'] ?></span>
                                    </li>
                                <? endforeach ?>
                            </ul>

                        </div>
                    </div>
                    <div id="tabs-6">
                        <?= $product["PRODUCT"]["FOOD1"]["TEXT"] ?>
                    </div>
                    <div id="tabs-7">
                        <?= $product["PRODUCT"]["FOR_CHILD"]["TEXT"] ?>
                    </div>
                    <div id="tabs-8">

                        <? foreach ($product["PRODUCT"]["VIDEO"] as $value): ?>
                            <div class="card-video">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $value ?>"
                                        frameborder="0" allowfullscreen></iframe>
                            </div>
                        <? endforeach ?>
                    </div>
                    <div id="tabs-9">
                        <div class="tab-actions">

                            <? foreach ($shares as $value): ?>
                                <div class="tab-actions-item">
                                    <div class="tab-actions-title"><?= $value["NAME"] ?></div>
                                    <div class="tab-actions-time"><b>Период
                                            действия:</b> <?= $value["PROPERTY_PERIOD_VALUE"] ?></div>
                                    <?= $value["DETAIL_TEXT"] ?>
                                </div>
                            <? endforeach ?>

                        </div>
                    </div>
                    <div id="tabs-10">
                        <h2>Документы, необходимые для заезда в санаторий. </h2>
                        <h3>Взрослому</h3>
                        <ul>
                            <li>путевка на санаторно-курортное лечение;</li>
                            <li>паспорт;</li>
                            <li>полис обязательного медицинского страхования;</li>
                            <li>санаторно-курортная карта (учетная форма 072/у, утвержденная Приказом №834н);</li>
                            <li>страховое свидетельство обязательного пенсионного страхования (при наличии);</li>
                            <li> договор (полис) добровольного медицинского страхования (при наличии).</li>
                        </ul>
                        <h3>Ребенку</h3>
                        <ul>
                            <li>путевка на санаторно-курортное лечение;</li>
                            <li>свидетельство о рождении (для детей в возрасте до 14 лет);</li>
                            <li>полис обязательного медицинского страхования;</li>
                            <li>справка врача-педиатра или врача-эпидемиолога об отсутствии контакта с больными
                                инфекционными заболеваниями
                            </li>
                            <li>сертификат прививок;</li>
                            <li>санаторно-курортная карта ребенка (учетная форма 076/у, утвержденная Приказом №834н).
                            </li>
                        </ul>
                        <p>До заезда в санаторий, необходимо заранее проконсультироваться с врачом и оформить
                            санаторно-курортную карту, это сэкономит Ваше время и обеспечит возможность начать курс
                            лечения в соответствии со сроком пребывания по путевке.</p>
                        <p>При отсутствии санаторно-курортной карты при заезде в санаторий, у гостей есть возможность
                            оформить ее за дополнительную плату. Срок оформления санаторно-курортной карты в этом случае
                            может занимать от 1 до 3 рабочих дней. Дни по путевке, в течение которых оформляется
                            санаторно-курортная карта в санатории, не продлеваются и не компенсируются. </p>
                        <a class="docs-link" href="/voucher.docx" download>Ваучер (обменная путевка)</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="engBox-right card-form">
            <div id="right-form">
                <form>
                    <div class="controlgroup mobile" style="color: #505050;">
                        <div class="title">Забронируйте номер<br><span>Прямо сейчас!</span></div>
                        <input type="text" name="name" placeholder="Введите имя" autocomplete="off" class="icon-user">
                        <input type="text" name="famil" placeholder="Введите номер телефона" autocomplete="off"
                               class="icon-phone2">
                        <select id="car-type3" class="input-right icon-key">
                            <option>Выберите номер</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                        <br><br>
                        <div style="margin-top: 30px; ">
                            <div style="float: right;">
                                <select id="car-type" class="input-right">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                            <div style=" padding: 4px 8px;">Взрослых</div>
                        </div>
                        <br>
                        <div>
                            <div style="float: right">
                                <select id="car-type2" class="input-right">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                            <div style="padding: 4px 8px;">Взрослых</div>
                        </div>
                        <input type="text" id="datepicker" placeholder="Дата заезда" class="icon-date">
                        <input type="text" id="datepicker2" placeholder="Дата выезда" class="icon-date">
                        <input name="transfer" type="checkbox" class="checkbox-trf" id="checkbox-tr"/>
                        <label for="checkbox-tr" class='checkbox-tr-btn'>Бесплатный трансфер</label>
                        <input type="button" class="btn various" href="#bron" value="ЗАБРОНИРОВАТЬ">
                    </div>
                </form>
                <div id="bron" class="okno" style="display: none">
                    <div class="title">Оздоровительная санаторно-курортная путевка</div>
                    <p>Санаторно-курортная путевка с классическим набором лечебно-диагностических процедур при различных
                        заболевания.</p>
                    <p> Показания: заболевания органов пищеварения и нарушение обмена веществ (в т.ч. сахарный диабет и
                        ожирение), заболевания опорно-двигательного аппарата, нервной системы, гинекологические и
                        урологические заболевания</p>
                    <p> Ожидаемые результаты: снятие физического и эмоционального стресса; повышение работоспособности;
                        улучшение обмена веществ; улучшение эмоционального состояния, прилив жизненных сил.</p>
                    <p> Продолжительность программы - от 10 дней.</p>
                    <div class="title">В стоимоимость путевки входит</div>
                    <div id="tabs2" class="content-menu" style="background: none!important;">
                        <ul id="okno-menu-show">
                            <li><a href="#tabs2-1">Лечебные процедуры</a></li>
                            <li><a href="#tabs2-2">Консультация врачей</a></li>
                            <li><a href="#tabs2-3">Питание</a></li>
                            <li><a href="#tabs2-4">Проживание</a></li>
                        </ul>
                        <div id="tabs2-1">
                            <p>Санаторно-курортная путевка с классическим набором лечебно-диагностических процедур при
                                различных заболевания.</p>
                            <p> Показания: заболевания органов пищеварения и нарушение обмена веществ (в т.ч. сахарный
                                диабет и ожирение), заболевания опорно-двигательного аппарата, нервной системы,
                                гинекологические и урологические заболевания</p>
                        </div>
                        <div id="tabs2-2">
                            текст2
                        </div>
                        <div id="tabs2-3">
                            текст3
                        </div>
                        <div id="tabs2-4">
                            текст4
                        </div>
                        <input type="button"
                               class="btn-okno various ui-widget ui-controlgroup-item ui-button ui-corner-right"
                               href="#bron" value="ЗАБРОНИРОВАТЬ" role="button">
                    </div>
                </div>
            </div>
        </div>
        <div class="engBox-right">
            <div id="right-ban">
                <a href=""><img src="images/ban1.jpg"></a>
                <a href=""><img src="images/ban2.jpg"></a>
                <a href=""><img src="images/ban3.jpg"></a>
                <a href=""><img src="images/ban4.jpg"></a>
            </div>
        </div>
    </div>
    <div id="map" class="clear">
        <iframe src="<?=$product['PRODUCT']['LINK_MAPS']?>" width="100%" height="400" frameborder="0"></iframe>
    </div>
<?
$APPLICATION->IncludeComponent('tim:empty', 'main_comments', array());
?>

<? /*$tabs = array(
	'main' => 'Главная',
	't2' => 'Еще вкладка',
	't3' => 'Третья',
	't4' => 'Четвертая',
);

//
// Заголовки табов
//
?>
<ul id="tabs" data-id="<?= $product['ID'] ?>"><?

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
</ul><?

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
</div><?


debugmessage($product);


$APPLICATION->AddChainItem('Санатории', '/sanatorium/');
$APPLICATION->AddChainItem($product['CITY']['NAME'], '/sanatorium/' . $product['CITY']['CODE'] . '/');
$APPLICATION->AddChainItem($product['NAME']);

$APPLICATION->SetTitle($product['NAME']);
if ($product['TITLE'])
	$APPLICATION->SetPageProperty('title', $product['TITLE']);
if ($product['DESCRIPTION'])
	$APPLICATION->SetPageProperty('description', $product['DESCRIPTION']);
*/