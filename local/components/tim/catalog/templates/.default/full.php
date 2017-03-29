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
    <div class="el-full-bg" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        <div class="el-search engBox-body" style="height: 60px;">
            <div class="title title-bg" style="padding: 7px 20px 0;">Выберите санаторий по своему вкусу</div>
        </div>
    </div>

    <div class="el-search-select engBox-body" id="el-search-select">
        <div id="filters-panel">
            <input type="hidden" name="q" value="<?= $component->searchQuery ?>">
            <input type="hidden" name="catalog_path" value="<?= $filter['CATALOG_PATH'] ?>">
            <input type="hidden" name="separator" value="<?= $filter['SEPARATOR'] ?>"><?

	        $closed = array(0, 1, 1, 1, 1, 1, 0);
	        if (isset($_COOKIE['filter_groups']))
		        $closed = explode(',', $_COOKIE['filter_groups']);

            $i = 0;
            foreach ($filter['GROUPS'] as $group)
            {
	            $style = $closed[$i] ? '' : ' style="display:block;"';
	            $class = $closed[$i] ? ' closed' : '';
                ?>
                <div class="filter-group<?= $class ?>">
	                <div class="title"><?= $group['NAME'] ?><s></s></div>
	                <fieldset class="profiles"<?= $style ?>><?

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
				                ?><?
			                }
		                }

	                    ?>
	                </fieldset>
	            </div><?

                $i++;
            }
            ?>
        </div><?

        ?>


    </div>
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
