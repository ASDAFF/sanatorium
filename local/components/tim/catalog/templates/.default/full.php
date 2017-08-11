<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var Local\Catalog\TimCatalog $component */

$filter = $component->filter;
$products = $component->products['ITEMS'];

?>
    <div id="catalog-head"><?

		//=========================================================
		include('head.php');
		//=========================================================

		?>
    </div>

    <section class="elCatalog -filter el-search-select engBox-body" id="el-search-select">
            <div class="container" id="filters-panel">

                <input type="hidden" name="q" value="<?= $component->searchQuery ?>">
                <input type="hidden" name="catalog_path" value="<?= $filter['CATALOG_PATH'] ?>">
                <input type="hidden" name="separator" value="<?= $filter['SEPARATOR'] ?>"><?

                $cookie_name = $component->searchQuery ? 'filter_groups_search' : 'filter_groups';

                $closed = array(0, 1, 1, 1, 1, 0);
                if (isset($_COOKIE[$cookie_name]))
                    $closed = explode(',', $_COOKIE[$cookie_name]);
                ?>

                <div class="_tabs">
                    <div class="icon-left">
                        <svg class="_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26">
                            <path d="M 14.585938 3.5859375 L 5.171875 13 L 14.585938 22.414062 L 17.414062 19.585938 L 10.828125 13 L 17.414062 6.4140625 L 14.585938 3.5859375 z"></path>
                        </svg>
                    </div>
                    <ul class="_tabs-nav">
                        <?
                        $i = 0;
                        foreach ($filter['GROUPS'] as $group) {
                        ?>
                        <li><a href="#elCatalog-filter-<?=$i?>"><span><?= $group['NAME'] ?></span></a></li>
                        <?
                            $i++; }
                        ?>
                    </ul>
                    <div class="icon-right">
                        <svg class="_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26">
                            <path d="M 11.414062 3.5859375 L 8.5859375 6.4140625 L 15.171875 13 L 8.5859375 19.585938 L 11.414062 22.414062 L 20.828125 13 L 11.414062 3.5859375 z"></path>
                        </svg>
                    </div>
                    <div class="_tabs-content css-padding">
                        <?
                        $i = 0;
                        foreach ($filter['GROUPS'] as $group)
                        {
                            $style = $closed[$i] ? '' : ' style="display:block;"';
                            $class = $closed[$i] ? ' closed' : '';
                        ?>
                        <div class="_tab _animated -bounceIn fadeInDown" id="elCatalog-filter-<?=$i?>">
                            <div class="filter-group<?= $class ?>">
                                <fieldset class="profiles">
                                    <?
                                    if ($group['TYPE'] == 'price')
                                    {
                                        $priceMax = ceil($group['MAX'] / 100) * 100;
                                        $from = $group['FROM'] ? $group['FROM'] : 0;
                                        $to = $group['TO'] ? $group['TO'] : $priceMax;
                                        ?>
                                        <div class="price-range">
                                        <span class="price-range-value" id="ext-from"><?= $from ?></span>
                                        <div id="slider-range-ext" data-max="<?= $priceMax ?>"></div>
                                        <span class="price-range-value" id="ext-to"><?= $to ?></span>
                                        </div><?
                                    }
                                    else
                                    {
                                        foreach ($group['ITEMS'] as $code => $item)
                                        {
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
                                            <b></b><label>
                                            <input class="el-search-dop-input" type="checkbox"
                                                   name="<?= $code ?>"<?= $checked ?><?= $disabled ?> />
                                            <?= $item['NAME'] ?> (<i><?= $item['CNT'] ?></i>)
                                        </label>
                                            <?
                                        }
                                    }

                                    ?>
                                </fieldset>
                            </div>
                        </div>
                        <?
                            $i++;
                        }
                        ?>
                    </div>
                </div>
        </section>



    <div id="catalog-list"><?

        //=========================================================
        include('products.php');
        //=========================================================

        ?>
    </div>
    <br/>
    <hr/>
    <br/>
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
if ($component->seo['NOINDEX'])
	$APPLICATION->AddHeadString('<meta name="robots" content="none"/>');
