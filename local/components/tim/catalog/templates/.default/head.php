<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @var array $products */
/** @global CMain $APPLICATION */
/** @var Local\Catalog\TimCatalog $component */

//
// Шапка санаториев
//
?>
<div class="el-full-bg2">
    <div id="products-summary" class="el-search-result engBox-body">
        <div id="cron-crox">
            <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemref="breadcrumb-1"><a href="<?= P_HREF ?>/" itemprop="url"><span itemprop="title">Главная</span></a></span><?
			$last = count($component->filter['BC']) - 1;
			foreach ($component->filter['BC'] as $i => $bc)
			{
				if ($i == $last)
				{
					?> - <span><?= $bc['NAME'] ?></span><?
				}
				else
				{
				    $ref = ($i < $last - 1) ? ' itemref="breadcrumb-' . ($i+2) . '"' : '';
					?> - <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child"
                               id="breadcrumb-<?= ($i+1) ?>"><a itemprop="url" href="<?= P_HREF ?><?= $bc['HREF'] ?>"><span itemprop="title"><?= $bc['NAME'] ?></span></a></span><?
				}
			}
			?>
        </div>
        <h1 class="title"><?= $component->seo['H1'] ?></h1>
        <div class="city"><?//= $component->countTitle ?></div>
        <div class="sort">
            <b>Сортировать по:</b><?

			$url = $component->filter['URL'];
			if (strpos($url, '?') !== false)
				$urlPage = $url . '&sort=';
			else
				$urlPage = $url . '?sort=';
			foreach ($component->sortParams as $key => $sort)
			{
				if ($sort['CURRENT'])
				{
					?>
                    <span><?= $sort['NAME'] ?></span><?
				}
				else
				{
					?>
                    <a href="<?= P_HREF ?><?= $urlPage ?><?= $key ?>"><?= $sort['NAME'] ?></a><?
				}
			}
			?>
        </div>
        <div class="number"><b>Показывать по:</b><?

			$url = $component->filter['URL'];
			if (strpos($url, '?') !== false)
				$urlPage = $url . '&size=';
			else
				$urlPage = $url . '?size=';
			foreach ($component->pageSizes as $size)
			{
				if ($size == $component->navParams['nPageSize'])
				{
					?>
                    <span><?= $size ?></span><?
				}
				else
				{
					?>
                    <a href="<?= P_HREF ?><?= $urlPage ?><?= $size ?>"><?= $size ?></a><?
				}
			}
			?>
            санаториев на странице
        </div><?

		if ($filter['CUR_FILTERS'])
		{
			?>
            <div class="filtr">
            <a href="<?= P_HREF ?>/sanatorium/"><span class="filtr-ttl"><b style="color:#000;">Удалить параметры фильтра:</b></a>
			<?= $component->countTitle ?>:<?
			foreach ($filter['CUR_FILTERS'] as $item)
			{
				?>
                <div class="filtr-current">
                <span class="filtr-ttl"><?= $item['NAME'] ?></span><a href="<?= P_HREF ?><?= $item['HREF'] ?>"
                                                                      class="filtr-close"></a>
                </div><?
			}
			?>
            </div><?
		}

        ?>
    </div>
</div><?