<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var Local\Catalog\TimCatalog $component */

$product = $component->product;

$alt = 'Санаторий ' . $product['NAME'] . ' ' . $product['CITY']['NAME'];
$file = new \CFile();
$pics = array();
$arWaterMark = array(
	array(
		'name' => 'watermark',
		'position' => 'center',
		'size' => 'real',
		'file' => $_SERVER['DOCUMENT_ROOT'] . '/images/watermarks/big.png',
	),
);
foreach ($product['PICTURES'] as $value)
{
	$img = $file->ResizeImageGet(
		$value,
		array(
			'width' => 10000,
			'height' => 196
		),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true,
		$arWaterMark
	);
	$pics[] = $img;
}

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
                <div class="price">Цена от <b><?= $product['PRODUCT']['PRICE'] ?></b> руб</div><span>за человека в сутки</span>
            </div>
        </div>
        <div id="cron-crox">
            <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" class="js-bc-detail" href="<?= $product['DETAIL_PAGE_URL'] ?>"<?= $style ?>><span itemprop="title">Санаторий <?= $product['NAME'] ?></span></a></span>
            <span class="js-bc-sep"<?= $style ?>> - </span><span class="js-bc-last">Фотографии</span>
        </div>
        <div id="cron-title"><h1>Санаторий <?= $product['NAME'] ?><span class="js-tab-name"><?= $tabH1 ?>: Фотографии</span></h1></div>
    </div>
</div>
<div class="engBox-body page-card" itemscope itemtype="http://schema.org/Hotel">
    <div class="center">
        <div class="images"><?

			foreach ($product['PICTURES'] as $value)
			{
				$img = $file->ResizeImageGet(
					$value,
					array(
						'width' => 10000,
						'height' => 196
					),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					true,
					$arWaterMark
				);
				$orig = $file->GetPath($value);

				?>
                <div class="img">
                    <a href="<?= $orig ?>" class="border various">
                        <img src="<?= $img['src'] ?>" alt="<?= $alt ?>" title="<?= $alt ?>" />
                    </a>
                </div><?
			}

            ?>
        </div>
    </div>
</div><?

$title = 'Фото санатория ' . $product['NAME'] . ' в ' . $product['CITY']['UF_PREDL'];
$desc = 'Фотогалерея санатория ' . $product['NAME'] . ' в городе ' . $product['CITY']['UF_PREDL'] . '. Смотрите фото номеров, интерьеров внешнего вида, лечения процедур в санатории.';

$APPLICATION->SetTitle($title);
$APPLICATION->SetPageProperty('title', $title);
$APPLICATION->SetPageProperty('description', $desc);

$APPLICATION->SetPageProperty('og_title', $title);
$APPLICATION->SetPageProperty('og_description', $desc);
$APPLICATION->SetPageProperty('og_url', $APPLICATION->GetCurDir());
if ($pics[0]['src'])
	$APPLICATION->SetPageProperty('og_image', P_HREF . $pics[0]['src']);
$APPLICATION->SetPageProperty('og_type', 'website');