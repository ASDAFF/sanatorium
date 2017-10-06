<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var Local\Catalog\TimCatalog $component */

$product = $component->product;
$room = $component->room;
$ogPhoto = '';

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
                <div class="price">Цена от <b><?= $room['PRICE'] ?></b> руб</div><span>за человека в сутки</span>
            </div>
        </div>
        <div id="cron-crox">
            <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemref="breadcrumb-1"><a itemprop="url" href="<?= $product['DETAIL_PAGE_URL'] ?>"><span itemprop="title">Санаторий <?= $product['NAME'] ?></span></a></span> -
            <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" id="breadcrumb-1"><a itemprop="url" href="<?= $product['DETAIL_PAGE_URL'] ?>rooms/"><span itemprop="title">Номера и цены</span></a></span> -
            <span><?= $room['NAME'] ?></span>
        </div>
        <div id="cron-title"><h1>Санаторий <?= $product['NAME'] ?><span class="js-tab-name">: <?= $room['NAME'] ?></span></h1></div>
    </div>
</div>
<div class="engBox-body page-card">
<div class="engBox-center">
<div class="tab-pane active" id="rooms">
    <div id="room<?= $room['ID'] ?>" class="detail-sanatorium" style="">
        <div class="el-nomer-popap">
            <div class="left">
                <a class="icon2" href="<?= $product['DETAIL_PAGE_URL'] ?>rooms/">&#8592; Все номера санатория</a>
                <div class="images"><?

					$file = new \CFile();
					$arWaterMark = array(
						array(
							'name' => 'watermark',
							'position' => 'center',
							'size' => 'real',
							'file' => $_SERVER['DOCUMENT_ROOT'] . '/images/watermarks/little.png',
						),
					);
					$alt = $room['NAME'] . ' ' . $product['NAME'];

					$photos = $room['PHOTO'];
					if ($room['PREVIEW_PICTURE'])
						array_unshift($photos, $room['PREVIEW_PICTURE']);

					foreach ($photos as $id)
					{
						$img = $file->ResizeImageGet(
							$id,
							array(
								'width' => 10000,
								'height' => 140
							),
							BX_RESIZE_IMAGE_PROPORTIONAL,
							true,
							$arWaterMark
						);

						$imgOrig = $file->ResizeImageGet(
							$id,
							array(
								'width' => 10000,
								'height' => 1000
							),
							BX_RESIZE_IMAGE_PROPORTIONAL,
							true,
							$arWaterMark
						);
						if (!$ogPhoto)
							$ogPhoto = $imgOrig['src'];
						?>
                        <div class="img">
                            <a href="<?= $imgOrig['src'] ?>" class="border various">
                                <img src="<?= $img['src'] ?>" alt="<?= $alt ?>" title="<?= $alt ?>" />
                            </a>
                        </div><?
					}

                    ?>
                </div>
                <div class="info-bottom">

                    <div class="right">
                        <div class="text">
                            <b>Площадь:</b> <?= $room['SIZE'] ?> м2 <br><?

							if ($room['DOUBLE_BED'] || $room['SINGLE_BED'])
							{
								?>
                                <b>Кроватей: </b><?
								if ($room['DOUBLE_BED'])
								{
									?>Двуспальных: <?= $room['DOUBLE_BED'] ?><?
								}
								if ($room['SINGLE_BED'])
								{
									if ($room['DOUBLE_BED'])
										echo ', ';
									?>Односпальных: <?= $room['SINGLE_BED'] ?><?
								}
								?>
                                <br><br><?
							}
							?>
                            <b>В стоимость включено:</b><br>проживание, питание, лечение.<br><br><?

							?>
                            <b>Вместимость номера:</b><br>
                            <ul>
                                <li><span class="first">основных мест - <?= $room['MAIN_PLACES'] ?> шт</span></li><?
								if ($room['ADD_PLACES'])
								{
									?>
                                    <li><span class="first">дополнительных - <?= $room['ADD_PLACES'] ?> шт</span></li><?
								}
								?>
                            </ul><br>
                        </div>
                    </div>
                    <div class="inf">
                        <div class="price-start"><span class="txt">Цена за номер в сутки от</span><span
                                    class="num"><?= $room['PRICE'] ?>р</span></div>
                        <i class="price-start-details">(в стоимость проживания входит
                            лечение по общетерапевтической путевке)</i>
                        <div class="tit">Стоимость основных мест:</div>
                        <ul>
                            <li>
                                <span class="first">основное взрослое (с подселением)</span>
                                <span class="second"><?= $room['PRICE'] ?>р</span>
                            </li>
                            <li>
                                <span class="first">детское</span><?
								if ($room['PRICE_CHILD'])
								{
									?>
                                    <span class="second"><?= $room['PRICE_CHILD'] ?>р</span><?
								}
								?>
                            </li>
                            <li>
                                <span class="first">размещение одним (выкуп номера)</span><?
								if ($room['PRICE_FULL'])
								{
									?>
                                    <span class="second"><?= $room['PRICE_FULL'] ?>р</span><?
								}
								?>
                            </li>
                        </ul>
                        <div class="tit">Стоимость дополнительных мест:</div>
                        <ul>
                            <li>
                                <span class="first">взрослое</span><?
								if ($room['PRICE_ADD'])
								{
									?>
                                    <span class="second"><?= $room['PRICE_ADD'] ?>р</span><?
								}
								?>
                            </li>
                            <li>
                                <span class="first">детское</span><?
								if ($room['PRICE_ADD_CHILD'])
								{
									?>
                                    <span class="second"><?= $room['PRICE_ADD_CHILD'] ?>р</span><?
								}
								?>
                            </li>

                        </ul>
                    </div><?

                    if ($room['OPTIONS'])
                    {
                        ?>
                        <div class="icon">
                            <b>Удобства:</b>
                            <ul class="con-list"><?
                                foreach ($room['OPTIONS'] as $k => $v)
                                {
                                    ?>
                                    <li class="con-item"><span class="icon-boon icon-<?= $k ?>"></span><span><?= $v?></span></li><?
                                }
                                ?>
                            </ul>
                        </div><?
					}

					?>
                </div>
            </div>
        </div>
    </div>
</div>
</div><?

if (false)
    include ('calc.php');
else
{
    ?>
    <div class="engBox-right card-form">
    <div id="right-form">
        <form method="POST" id="formx" data-form="bron" action="javascript:void(null);">
            <div class="controlgroup mobile" style="color: #505050;">
                <span class="form-title-first">Заполните форму</span>
                <span class="form-title-second">чтобы узнать стоимость путевки или забронировать номер</span>

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
                    foreach ($product['ROOMS'] as $room1)
                    {
                        $selected = '';
                        if ($room['ID'] == $room1['ID'])
                            $selected = ' selected="selected"';
                        ?>
                        <option value="<?= $room['ID'] ?>"<?= $selected ?>><?= $room1['NAME'] ?></option><?
                    }
                    ?>
                </select>
                <br><br>

                <div class="engInputLog" data-input="name"></div>
                <input type="text" name="name" placeholder="Введите имя *"
                       autocomplete="off" class="icon-user" required />

                <div class="engInputLog" data-input="phone"></div>
                <input type="text" name="phone" placeholder="Введите номер телефона *"
                       autocomplete="off" class="icon-phone2" required />

                <input name="transfer" type="checkbox" class="checkbox-trf" id="checkbox-tr"/>
                <label for="checkbox-tr" class='checkbox-tr-btn'>Бесплатный трансфер</label>


                <div class="_form-check">
                    <input name="_check" type="checkbox" id="checkbox-lic" data-class="_form-check-btn"/>
                    <label for="checkbox-lic" class='checkbox-tr-btn'>
                        Я ознакомлен <a target="_blank" href="<?= P_HREF ?>/contacts/Dogovor.compressed.pdf">c положением об обработке и защите персональных данных.</a>
                    </label>
                </div>
                <div class="_form-check-btn">
                    <div class="btn"> Узнать стоимость со скидкой </div>
                </div>
            </div>
        </form>
        <div id="bronx" class="okno" style="display: none"></div>
    </div>
    </div><?
}

?>
<div class="engBox-right"><?
    $APPLICATION->IncludeComponent('tim:empty', 'banners');
    ?>
</div>
</div><?

$price = $room['PRICE'];
$title = $room['NAME'] . ' — санаторий ' . $product['NAME'] . ' в ' . $product['CITY']['UF_PREDL'];
$desc = 'Забронируйте ' . $room['NAME'] . ' по цене ' . $price . ' в санатории ' . $product['NAME'] . ' город ' . $product['CITY']['NAME'] . ' на официальном сайте Путевочка.';

$APPLICATION->SetTitle($room['NAME']);
$APPLICATION->SetPageProperty('title', $title);
$APPLICATION->SetPageProperty('description', $desc);

$APPLICATION->SetPageProperty('og_title', $title);
$APPLICATION->SetPageProperty('og_description', $desc);
$APPLICATION->SetPageProperty('og_url', $APPLICATION->GetCurDir());
if ($ogPhoto)
	$APPLICATION->SetPageProperty('og_image', P_HREF . $ogPhoto);
$APPLICATION->SetPageProperty('og_type', 'website');
