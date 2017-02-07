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
        
        <?php
        $gallery = array();
        foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $fileId)
            $gallery[] = CFile::GetPath($fileId);
        ?>
        <div id="slider" class="flexslider">
            <ul class="slides">
                <? foreach ($gallery as $image): ?>
                    <li><img src="<?= $image; ?>" alt="<?= $arResult['NAME'] ?>"></li>
                <? endforeach; ?>
            </ul>
        </div>
        <div id="carousel" class="flexslider carousel">
            <ul class="slides">
                <? foreach ($gallery as $image): ?>
                    <li><img src="<?= $image; ?>" alt="<?= $arResult['NAME'] ?>"></li>
                <? endforeach; ?>
            </ul>
        </div>
        <div id="tabs" class="content-menu">
            <ul id="content-menu-show">
                <li><a href="#tabs-1">О санатории</a></li>
                <li><a href="#tabs-2">Номера</a></li>
                <li><a href="#tabs-3">Профили лечения</a></li>
                <li><a href="#tabs-4">Программы лечения</a></li>
                <li><a href="#tabs-5">Инфраструктура</a></li>
                <li><a href="#tabs-6">Питание</a></li>
                <li><a href="#tabs-7">Детям</a></li>
                <li><a href="#tabs-8">Видео</a></li>
                <li><a href="#tabs-9">Акции</a></li>
            </ul>
            <div id="content-menu-pun">развернуть</div>
            <div class="content-border"></div>
            <div id="tabs-1">
                <?=$arResult['DETAIL_TEXT'];?>
            </div>
            <div id="tabs-2">
                <? foreach ($arResult['DISPLAY_PROPERTIES']['PRICES']['PROPERTIES_VALUE'] as $k => $el): ?>
                <?php
                $props = $arResult['DISPLAY_PROPERTIES']['PRICES']['ALL_PROPERTIES_VALUE'][$k];
                $fields = $arResult['DISPLAY_PROPERTIES']['PRICES']['FIELDS_VALUE'][$k];
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
                                <b>Площадь:</b> <?=$props['ROOM_SIZE']['VALUE']?> <br><br>
                                <b>Кровати:</b> <?=$props['BED_TYPE']['VALUE']?><br><br>
                                <b>Включено:</b> прожив<br><br>
                            </div>
                            <div class="inf">
                                <div class="money">
                                    от <b><?=$props['PRICE']['VALUE']?></b> руб
                                </div>
                                <span>за номер в сутки</span>
                                <a href="#bron<?=$fields['ID'];?>" class="btn various">забронировать</a>
                                <script type="text/javascript">
                                    $(function() {
                                        $('#slider-popap-<?=$fields['ID'];?>').flexslider({
                                            animation: "slide",
                                            controlNav: false,
                                            animationLoop: false,
                                            slideshow: false,
                                            sync: "#carousel-popap-<?=$fields['ID'];?>",
                                        });
                                        $('#carousel-popap-<?=$fields['ID'];?>').flexslider({
                                            animation: "slide",
                                            controlNav: false,
                                            animationLoop: false,
                                            slideshow: true,
                                            itemWidth: 100,
                                            itemHeight: 50,
                                            itemMargin: 5,
                                            asNavFor: '#slider-popap-<?=$fields['ID'];?>',
                                        });
                                    });
                                </script>
                            </div>
                            <div id="bron<?=$fields['ID'];?>" class="okno" style="display: none">
                                <div class="title"><?=$fields['NAME'];?></div>
                                <div class="el-nomer-popap">
                                    <div class="left">
                                        <div class="slider">
                                            <div id="slider-popap-<?=$fields['ID'];?>" class="flexslider">
                                                <ul class="slides">
                                                    <?php foreach($props['MORE_PHOTO']['VALUE'] as $imgId):?>
                                                        <li>
                                                            <img src="<?=CFile::GetPath($imgId);?>" alt="<?=$arResult['NAME']?>"/>
                                                        </li>
                                                    <?php endforeach;?>
                                                </ul>
                                            </div>
                                            <div id="carousel-popap-<?=$fields['ID'];?>" class="flexslider carousel" >
                                                <ul class="slides">
                                                    <?php foreach($props['MORE_PHOTO']['VALUE'] as $imgId):?>
                                                        <li>
                                                            <img src="<?=CFile::GetPath($imgId);?>" alt="<?=$arResult['NAME']?>"/>
                                                        </li>
                                                    <?php endforeach;?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="inf">
                                            <div class="tit">Стоимость основных мест:</div>
                                            <ul>
                                                <li>
                                                    <span class="first">одноместное (с подселением)</span>
                                                    <span class="second">650р</span>
                                                </li>
                                                <li>
                                                    <span class="first">одноместное (за номер)</span>
                                                    <span class="second">650р</span>
                                                </li>
                                                <li>
                                                    <span class="first">за номер (2-х местное размещение)</span>
                                                    <span class="second">650р</span>
                                                </li>
                                            </ul>
                                            <div class="tit">Стоимость дополнительных мест:</div>
                                            <ul>
                                                <li>
                                                    <span class="first">взрослое</span>
                                                    <span class="second">650р</span>
                                                </li>
                                                <li>
                                                    <span class="first">детское</span>
                                                    <span class="second">650р</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div style="text-align: center">
                                            <input type="button" class="btn-okno ui-widget ui-controlgroup-item ui-button ui-corner-right" href="" value="ЗАБРОНИРОВАТЬ" role="button">
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="text">
                                            <b>Площадь:</b> <?=$props['ROOM_SIZE']['VALUE']?> <br>
                                            <b>Кровати:</b> большая двуспальная<br>
                                            <b>Включено:</b> прожив<br>
                                            <b>Максимальная вместимость номера:</b><br>
                                            3 человека
                                            <ul>
                                                <li><span class="first">основных мест - 2 шт</span></li>
                                                <li><span class="first">дополнительных - 1 шт</span></li>
                                            </ul>
                                        </div>
                                        <div class="icon">
                                            <b>Удобства:</b>
                                            <li>
                                                <img src="<?=SITE_TEMPLATE_PATH?>/images/icon/диван.png" alt="<?=$arResult['NAME']?>">
                                                <span>Отдых с детьми от 4 лет</span>
                                            </li>
                                            <li>
                                                <img src="<?=SITE_TEMPLATE_PATH?>/images/icon/диван.png" alt="<?=$arResult['NAME']?>">
                                                <span>Отдых с детьми от 4 лет</span>
                                            </li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
            <div id="tabs-3">
                <? foreach ($arResult['DISPLAY_PROPERTIES']['PROFILES']['DISPLAY_VALUE'] as $el): ?>
                    <div><?= $el; ?></div>
                <? endforeach; ?>
            </div>
            <div id="tabs-4">
                <div class="posts">
                    <? foreach ($arResult['DISPLAY_PROPERTIES']['PROGRAMMS']['PROPERTIES_VALUE'] as $el): ?>
                        <div class="item">
                            <div class="title"><?=$el['NAME']?></div>
                            <div class="text">
                                <?=$el['PREVIEW_TEXT']?>
                                <a href="<?=$el['DETAIL_PAGE_URL']?>">Подробнее</a>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
            <div id="tabs-5">
                <div class="posts">
                    <? foreach ($arResult['DISPLAY_PROPERTIES']['PRICES']['PROPERTIES_VALUE'] as $k => $el): ?>
                            <div class="item">
                                <div class="title"><?=$arResult['DISPLAY_PROPERTIES']['PRICES']['DISPLAY_VALUE'][$k]?></div>
                                <div class="text">
                                    <?if(!empty($arResult['DISPLAY_PROPERTIES']['PRICES']['PROPERTIES_VALUE_STR'][$k])):?>
                                        <p>В номере: <?=join(', ', $arResult['DISPLAY_PROPERTIES']['PRICES']['PROPERTIES_VALUE_STR'][$k]);?></p>
                                    <?endif;?>
                                    <div class="icon">
                                        <?foreach($el as $prop):?>
                                            <?if(is_scalar($prop['VALUE']) && !empty($prop['ICON'])):?>
                                                <img src="<?=$prop['ICON']?>" alt="<?=$prop['NAME']?>">
                                            <?endif;?>
                                        <?endforeach;?>
                                    </div>
                                    <p>
                                        <b>Показания: </b>заболевания органов пищеварения и нарушение обмена веществ (в т.ч. сахарный диабет и ожирение),
                                        заболевания опорно-двигательного аппарата, нервной системы, гинекологические и урологические заболевания
                                    </p>
                                </div>
                            </div>
                    <? endforeach; ?>
                </div>
            </div>
            <div id="tabs-6">2</div>
            <div id="tabs-7">2</div>
            <div id="tabs-8">2</div>
            <div id="tabs-9">2</div>
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
                <select id="car-type3" class="input-right icon-key">
                    <option>Выберите номер</option>
                    <? foreach ($arResult['DISPLAY_PROPERTIES']['PRICES']['LINK_ELEMENT_VALUE'] as $k => $el): ?>
                        <option value="<?= $k ?>"><?= $el['NAME']; ?></option>
                    <? endforeach; ?>
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
                    <div style="padding: 4px 8px;">Детей</div>
                </div>
                <input type="text" id="datepicker" placeholder="Дата заезда" class="icon-date">
                <input type="text" id="datepicker2" placeholder="Дата выезда" class="icon-date">
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