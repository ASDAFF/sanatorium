<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var Local\Catalog\TimCatalog $component */

$filter = $component->filter;

?>
<div class="el-full-bg" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        <div class="el-search engBox-body">
            <div class="title title-bg">Путевочка - сервис подбора и бронирования<br> санаториев КМВ</div>
            <div class="title-sm ">Выберите путевку по официальной цене санатория</div>

            <div class="line">
                <div class="eng-icon-city"></div>
                <div class="city controlgroup">
                    <select id="city-vibor">
                        <? foreach ($filter['GROUPS'] as $group) {
                            if ($group['TYPE'] == 'city') {
                                foreach ($group['ITEMS'] as $code => $item) {?>
                                    <option name="<?= $code ?>"><?= $item['NAME'] ?> </option>
                                <?}
                            }
                        }?>
                    </select>
                </div>
                <div class="eng-icon-city-grey"></div>
                <div class="money">
                    Цена в сутки
                </div>
                <div class="money-vibor">
                    <? foreach ($filter['GROUPS'] as $group) {
                        if ($group['TYPE'] == 'price') {
                            $from = $group['FROM'] ? $group['FROM'] : $group['MIN'];
                            $to = $group['TO'] ? $group['TO'] : $group['MAX'];
                            ?>
                            <div style="display: none" class="price-group"<?= $style ?> data-min="<?= $group['MIN'] ?>"
                                 data-max="<?= $group['MAX'] ?>">
                                <div class="inputs">
                                    <div class="l">от <input type="text" class="from" value="<?= $group['MIN'] ?>"/></div>
                                    <div class="r">до <input type="text" class="to" value="<?= $group['MAX'] ?>"/></div>
                                </div>
                            </div>

                            <span id="slider-range-value1"><?= $group['MIN'] ?></span>
                            <div id="slider-range"></div>
                            <span id="slider-range-value2"><?= $group['MAX'] ?></span>
                        <? }
                    } ?>
                </div>
                <a class="btn filter_find" href="javascript:void(0)">Найти</a>
            </div>

            <div class="el-search-btn" id="el-search-btn">Расширенный поиск<i id="icon-down-top"></i></div>
            <div class="el-search-btn" style="margin-right: 10px;">Сброс</div>
        </div>

    </div>

    <div class="el-search-select engBox-body" id="el-search-select" style="display: none;">

        <div id="filters-panel">
            <input type="hidden" name="q" value="<?= $component->searchQuery ?>">
            <input type="hidden" name="catalog_path" value="<?= $filter['CATALOG_PATH'] ?>">
            <input type="hidden" name="separator" value="<?= $filter['SEPARATOR'] ?>"><?

            /*$closed = array(0, 1, 1, 1, 1, 1, 1);
            if (isset($_COOKIE['filter_groups']))
                $closed = explode(',', $_COOKIE['filter_groups']);*/
            $closed = array();

            $i = 0;
            foreach ($filter['GROUPS'] as $group) {
                $style = $closed[$i] ? ' style="display:none;"' : '';
                $class = $closed[$i] ? ' closed' : '';
                ?>
                <div class="filter-group<?= $class ?>">

                    <? if ($group['TYPE'] == 'price' || $group['TYPE'] == 'city') {
                    } else { ?>
                        <div class="title"><?= $group['NAME'] ?></div>
                        <fieldset class="profiles">
                            <? foreach ($group['ITEMS'] as $code => $item) {
                                $style = $item['ALL_CNT'] ? '' : ' style="display:none;"';
                                $class = '';
                                if (!$item['CNT'] && $item['CHECKED'])
                                    $class = ' class="checked disabled"';
                                elseif ($item['CHECKED'])
                                    $class = ' class="checked"';
                                elseif (!$item['CNT'])
                                    $class = ' class="disabled"';
                                $checked = $item['CHECKED'] ? ' checked' : '';
                                $disabled = $item['CNT'] ? '' : ' disabled';

                                ?>
                                <label>
                                    <input class="el-search-dop-input" type="checkbox"
                                           name="<?= $code ?>"<?= $checked ?><?= $disabled ?> />
                                    <?= $item['NAME'] ?> (<i><?= $item['CNT'] ?></i>)
                                </label>
                            <? } ?>
                        </fieldset>
                    <? } ?>
                </div>
                <?

                $i++;
            }
            ?>
        </div>
    </div>
<?

foreach ($filter['BC'] as $i => $item)
    $APPLICATION->AddChainItem($item['NAME'], $item['HREF']);

if ($component->navParams['iNumPage'] > 1)
    $component->seo['TITLE'] .= ' - страница ' . $component->navParams['iNumPage'];

if ($component->seo['H1'])
    $APPLICATION->SetTitle($component->seo['H1']);
if ($component->seo['TITLE'])
    $APPLICATION->SetPageProperty('title', $component->seo['TITLE']);
if ($component->seo['DESCRIPTION'])
    $APPLICATION->SetPageProperty('description', $component->seo['DESCRIPTION']);