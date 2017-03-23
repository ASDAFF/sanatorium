<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="engBox-center">
    <div id="content">
        <div id="content-top"><?=empty($arResult['PROPERTIES']['ADDRESS']['VALUE']) ? '&nbsp;' : $arResult['PROPERTIES']['ADDRESS']['VALUE']?></div>

        <div id="slider" class="flexslider">
            <ul class="slides">
                <? foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE_PATH'] as $image): ?>
                    <li><img src="<?= $image; ?>" alt="<?= $arResult['NAME'] ?>"></li>
                <? endforeach; ?>
            </ul>
        </div>
        <div id="carousel" class="flexslider carousel">
            <ul class="slides">
                <? foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE_PATH'] as $image): ?>
                    <li><img src="<?= $image; ?>" alt="<?= $arResult['NAME'] ?>"></li>
                <? endforeach; ?>
            </ul>
        </div>
        <div id="tabs" class="content-menu">
            <ul id="content-menu-show">
                <li<?=activeTabClass('about', $arResult['ACTIVE_TAB'], true);?>>
                    <a href="<?=$arResult['TAB_URL']?>about/" data-id="about">О санатории</a>
                </li>
                <li<?=activeTabClass('rooms', $arResult['ACTIVE_TAB'], true);?>>
                    <a href="<?=$arResult['TAB_URL']?>rooms/" data-id="rooms">Номера</a></li>
                <li<?=activeTabClass('profiles', $arResult['ACTIVE_TAB'], true);?>>
                    <a href="<?=$arResult['TAB_URL']?>profiles/" data-id="profiles">Профили лечения</a>
                </li>
                <li<?=activeTabClass('programms', $arResult['ACTIVE_TAB'], true);?>>
                    <a href="<?=$arResult['TAB_URL']?>programms/" data-id="programms">Программы лечения</a>
                </li>
                <li<?=activeTabClass('infrastructure', $arResult['ACTIVE_TAB'], true);?>>
                    <a href="<?=$arResult['TAB_URL']?>infrastructure/" data-id="infrastructure">Инфраструктура</a>
                </li>
                <li<?=activeTabClass('food', $arResult['ACTIVE_TAB'], true);?>>
                    <a href="<?=$arResult['TAB_URL']?>food/" data-id="food">Питание</a>
                </li>
                <li<?=activeTabClass('child', $arResult['ACTIVE_TAB'], true);?>>
                    <a href="<?=$arResult['TAB_URL']?>child/" data-id="child">Детям</a>
                </li>
                <li<?=activeTabClass('video', $arResult['ACTIVE_TAB'], true);?>>
                    <a href="<?=$arResult['TAB_URL']?>video/" data-id="video">Видео</a>
                </li>
                <li<?=activeTabClass('actions', $arResult['ACTIVE_TAB'], true);?>>
                    <a href="<?=$arResult['TAB_URL']?>actions/" data-id="actions">Акции</a>
                </li>
            </ul>
          
            <div class="content-border"></div>
            <?//if(isActiveTab('about', $arResult['ACTIVE_TAB'])):?>
                <div class="tab-content<?=activeTabClass('about', $arResult['ACTIVE_TAB']);?>" id="about">
                    <?=$arResult['DETAIL_TEXT'];?>
                </div>
            <?//endif;?>
            <?//if(isActiveTab('rooms', $arResult['ACTIVE_TAB'])):?>
                <div class="tab-content<?=activeTabClass('rooms', $arResult['ACTIVE_TAB']);?>" id="rooms">
                <? foreach ($arResult['DISPLAY_PROPERTIES']['PRICES']['PROPERTIES_VALUE'] as $k => $el): ?>
                    <?php
                    $props = $arResult['DISPLAY_PROPERTIES']['PRICES']['ALL_PROPERTIES_VALUE'][$k];
                    $fields = $arResult['DISPLAY_PROPERTIES']['PRICES']['FIELDS_VALUE'][$k];
                    $comfortProps = $arResult['DISPLAY_PROPERTIES']['PRICES']['ICONS'][$k];

                    $photos = $arResult['DISPLAY_PROPERTIES']['PRICES']['PROPERTIES_VALUE'][$k]['MORE_PHOTO']['VALUE_PATH'];

                    $totalPlaces = (int) ($props['DOUBLE_BED']['VALUE'] + $props['SINGLE_BED']['VALUE']);
                    $additionalPlaces = (int) count($props['EXTRA']['VALUE']);
                    ?>
                    <div class="el-nomer">
                        <div class="item">
                            <div class="img">
                                <a href="#bron<?=$fields['ID'];?>" class="border various">
                                    <img src="<?=CFile::GetPath($fields['PREVIEW_PICTURE']);?>" alt="<?=$arResult['NAME']?>">
                                </a>
                            </div>
                            <div class="text">
                                <a href="#bron<?=$fields['ID'];?>" class="title various"><?=$fields['NAME'];?></a><br>
                                <b>Площадь:</b> <?=$props['ROOM_SIZE']['VALUE']?> м<sup>2</sup><br><br>
                                <b>Кровати:</b> <?= $totalPlaces ?><br><br>
                                <b>Включено:</b> питание, проживание, лечение<br><br>
                            </div>
                            <div class="inf">
                                <div class="money">
                                    от <b><?=$props['PRICE']['VALUE']?></b> руб
                                </div>
                                <span>за номер в сутки</span>
                                <a href="#bron<?=$fields['ID'];?>" class="btn various">забронировать</a>
                            </div>
                            <div id="bron<?=$fields['ID'];?>" class="okno" style="display: none">
                                <div class="title"><?=$fields['NAME'];?></div>
                                <div class="el-nomer-popap">
                                    <div class="left">
                                        <div class="slider">
                                            <div id="slider-popap-<?=$fields['ID'];?>" class="flexslider popup">
                                                <ul class="slides">
                                                    <?php foreach($photos as $path):?>
                                                        <li>
                                                            <img src="<?=$path;?>" alt="<?=$arResult['NAME']?>"/>
                                                        </li>
                                                    <?php endforeach;?>
                                                </ul>
                                            </div>
                                            <div id="carousel-popap-<?=$fields['ID'];?>" class="flexslider carousel" >
                                                <ul class="slides">
                                                    <?php foreach($photos as $path):?>
                                                        <li>
                                                            <img src="<?=$path;?>" alt="<?=$arResult['NAME']?>"/>
                                                        </li>
                                                    <?php endforeach;?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="inf">
                                            <div class="inf">
                                                <div class="money">
                                                    Цена от <b><?=$props['PRICE']['VALUE']?></b> руб
                                                    <span>за номер в сутки</span>
                                                </div>
                                            </div>
                                            <br>
                                            <?=$fields['PREVIEW_TEXT'];?>
                                        </div>
                                        <div style="text-align: center">
                                            <input type="button" class="btn-okno ui-widget ui-controlgroup-item ui-button ui-corner-right" href="" value="ЗАБРОНИРОВАТЬ" role="button">
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="text">
                                            <b>Площадь:</b> <?=$props['ROOM_SIZE']['VALUE']?> м<sup>2</sup> <br>
                                            <b>Кровати:</b><br>
                                            <?if(!empty($props['DOUBLE_BED']['VALUE'])):?>
                                                <?= $props['DOUBLE_BED']['VALUE'];?>
                                                <?=pluralize($props['DOUBLE_BED']['VALUE'], array('двуспальная кровать', 'двуспальные кровати', 'двуспальных кроватей'));?>
                                                <br>
                                            <?endif;?>
                                            <?if(!empty($props['SINGLE_BED']['VALUE'])):?>
                                                <?= $props['SINGLE_BED']['VALUE'];?>
                                                <?=pluralize($props['SINGLE_BED']['VALUE'], array('односпальная кровать', 'односпальные кровати', 'односпальных кроватей'));?>
                                                <br>
                                            <?endif;?>

                                            <b>Включено:</b> питание, проживание, лечение<br>
                                            <b>Максимальная вместимость номера:</b><br>
                                            <?=$additionalPlaces + $totalPlaces;?> <?=pluralize($additionalPlaces + $totalPlaces, array('человек', 'человека', 'человек'));?>
                                            <ul>
                                                <li><span class="first">основных мест - <?=$totalPlaces?> шт</span></li>
                                                <li><span class="first">дополнительных - <?=$additionalPlaces?> шт</span></li>
                                            </ul>
                                        </div>
                                        <div class="icon">
                                            <b>Удобства:</b>
                                            <br>
                                            <ul>
                                                <?if(empty($comfortProps)):?>
                                                    <li>Не указано</li>
                                                <?else:?>
                                                    <?foreach($comfortProps as $name => $path):?>
                                                        <?php
                                                        if(empty($path))
                                                            continue;
                                                        ?>
                                                        <li>
                                                            <img src="<?=$path?>" alt="<?=$name?>">
                                                            <span><?=$name?></span>
                                                        </li>
                                                    <?endforeach;?>
                                                <?endif;?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
            <?//endif;?>
            <div class="tab-content<?=activeTabClass('profiles', $arResult['ACTIVE_TAB']);?>" id="profiles">
                <? foreach ($arResult['DISPLAY_PROPERTIES']['PROFILES']['DISPLAY_VALUE'] as $el): ?>
                    <div><?= $el; ?></div>
                <? endforeach; ?>
            </div>
            <?//endif;?>
            <?//if(isActiveTab('programms', $arResult['ACTIVE_TAB'])):?>
            <div class="tab-content<?=activeTabClass('programms', $arResult['ACTIVE_TAB']);?>" id="programms">
                <div class="posts">
                    <? foreach ($arResult['DISPLAY_PROPERTIES']['PROGRAMMS']['PROPERTIES_VALUE'] as $el): ?>
                        <div class="item">
                            <div class="title"><?=$el['NAME']?></div>
                            <div class="text preview-text">
                                <?=$el['PREVIEW_TEXT']?>
                                <a href="#">Подробнее</a>
                            </div>
                            <div class="text okno detail-text hidden">
                                <h3 class="title"><?=$el['NAME']?></h3>
                                <?=$el['DETAIL_TEXT'];?>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
            <?//endif;?>
            <?//if(isActiveTab('infrastructure', $arResult['ACTIVE_TAB'])):?>
            <div class="tab-content<?=activeTabClass('infrastructure', $arResult['ACTIVE_TAB']);?>" id="infrastructure">
                <div class="posts">
                    <div class="item">
                        <div class="title">Инфраструктура</div>
                        <div class="text">
                            <div class="icon">
                                <?foreach($arResult['DISPLAY_PROPERTIES']['INFRASTRUCTURE']['ICONS'] as $name => $path):?>
                                    <?if(!empty($path)):?>
                                        <img src="<?=$path?>" alt="<?=$name?>">
                                    <?endif;?>
                                <?endforeach;?>
                            </div>
                            <?if(!empty($arResult['DISPLAY_PROPERTIES']['INFRASTRUCTURE']['VALUE'])):?>
                                <p><?=join(', ', $arResult['DISPLAY_PROPERTIES']['INFRASTRUCTURE']['VALUE']);?></p>
                            <?endif;?>
                        </div>
                    </div>
                </div>
            </div>
            <?//endif;?>
            <?//if(isActiveTab('food', $arResult['ACTIVE_TAB'])):?>
            <div class="tab-content<?=activeTabClass('food', $arResult['ACTIVE_TAB']);?>" id="food">
                <?=\Bitrix\Main\Text\String::htmlDecode($arResult['DISPLAY_PROPERTIES']['FOOD']['VALUE']['TEXT']);?>
            </div>
            <?//endif;?>
            <?//if(isActiveTab('child', $arResult['ACTIVE_TAB'])):?>
            <div class="tab-content<?=activeTabClass('child', $arResult['ACTIVE_TAB']);?>" id="child">
                <?=\Bitrix\Main\Text\String::htmlDecode($arResult['DISPLAY_PROPERTIES']['FOR_CHILD']['VALUE']['TEXT']);?>
            </div>
            <?//endif;?>
            <?//if(isActiveTab('video', $arResult['ACTIVE_TAB'])):?>
            <div class="tab-content<?=activeTabClass('video', $arResult['ACTIVE_TAB']);?>" id="video">
                <?=\Bitrix\Main\Text\String::htmlDecode(join('<br>', $arResult['DISPLAY_PROPERTIES']['VIDEO']['VALUE']));?>
            </div>
            <?//endif;?>
            <?//if(isActiveTab('actions', $arResult['ACTIVE_TAB'])):?>
            <div class="tab-content<?=activeTabClass('actions', $arResult['ACTIVE_TAB']);?>" id="actions">

            </div>
            <?//endif;?>
        </div>

    </div>
</div>
<div class="engBox-right">
    <div id="right-form">
        <form method="post">
            <div class="controlgroup mobile" style="color: #505050;">
                <div class="title">Забронируйте номер<br><span>Прямо сейчас!</span></div>
                <input type="text" name="name" placeholder="Введите имя" autocomplete="off" class="icon-user">
                <input type="text" name="famil" placeholder="Введите номер телефона" autocomplete="off" class="icon-phone2">
                <select id="car-type3" name="room" class="input-right icon-key">
                    <option>Выберите номер</option>
                    <? foreach ($arResult['DISPLAY_PROPERTIES']['PRICES']['LINK_ELEMENT_VALUE'] as $k => $el): ?>
                        <option value="<?= $k ?>"><?= $el['NAME']; ?></option>
                    <? endforeach; ?>
                </select>
                <br><br>
                <div style="margin-top: 30px; ">
                    <div style="float: right;">
                        <select name="adults" id="car-type" class="input-right">
                            <?for($i = 1; $i < 11; ++$i):?>
                                <option value="<?=$i?>"><?=$i?></option>
                            <?endfor;?>
                        </select>
                    </div>
                    <div style=" padding: 4px 8px;">Взрослых</div>
                </div>
                <br>
                <div>
                    <div style="float: right">
                        <select name="childs" id="car-type2" class="input-right">
                            <?for($i = 1; $i < 11; ++$i):?>
                                <option value="<?=$i?>"><?=$i?></option>
                            <?endfor;?>
                        </select>
                    </div>
                    <div style="padding: 4px 8px;">Детей</div>
                </div>
                <input name="date_start" type="text" id="datepicker" placeholder="Дата заезда" class="icon-date">
                <input name="date_end" type="text" id="datepicker2" placeholder="Дата выезда" class="icon-date">
				<input name="transfer" type="checkbox" class="checkbox-trf" id="checkbox-tr" />
				<label for="checkbox-tr" class='checkbox-tr-btn'>Бесплатный трансфер</label>
                <input type="button" class="btn various" href="#bron" value="ЗАБРОНИРОВАТЬ">
            </div>
        </form>
        <div id="bron" class="okno" style="display: none">
            <div class="title">Оздоровительная санаторно-курортная путевка</div>
            <p>Санаторно-курортная путевка с классическим набором лечебно-диагностических процедур при различных заболевания.</p>
            <p> Показания: заболевания органов пищеварения и нарушение обмена веществ (в т.ч. сахарный диабет и ожирение), заболевания
                опорно-двигательного аппарата, нервной системы, гинекологические и урологические заболевания</p>
            <p> Ожидаемые результаты: снятие физического и эмоционального стресса; повышение работоспособности; улучшение обмена веществ; улучшение
                эмоционального состояния, прилив жизненных сил.</p>
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
                    <p>Санаторно-курортная путевка с классическим набором лечебно-диагностических процедур при различных заболевания.</p>
                    <p> Показания: заболевания органов пищеварения и нарушение обмена веществ (в т.ч. сахарный диабет и ожирение), заболевания
                        опорно-двигательного аппарата, нервной системы, гинекологические и урологические заболевания</p>
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
                <input type="button" class="btn-okno various ui-widget ui-controlgroup-item ui-button ui-corner-right" href="#bron"
                       value="ЗАБРОНИРОВАТЬ" role="button">
            </div>
        </div>
    </div>


    <div id="right-ban">
        <a href=""><img src="<?= SITE_TEMPLATE_PATH; ?>/images/ban1.jpg"></a>
        <a href=""><img src="<?= SITE_TEMPLATE_PATH; ?>/images/ban2.jpg"></a>
        <a href=""><img src="<?= SITE_TEMPLATE_PATH; ?>/images/ban3.jpg"></a>
        <a href=""><img src="<?= SITE_TEMPLATE_PATH; ?>/images/ban4.jpg"></a>
    </div>
</div>