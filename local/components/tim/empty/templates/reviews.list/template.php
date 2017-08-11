<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$sanatoriumId = $arParams['ID'];
if ($sanatoriumId)
	$reviews = \Local\Catalog\Reviews::getBySanatorium($sanatoriumId);
else
	$reviews = \Local\Catalog\Reviews::getList(0, 0, 1, 10);

if (!$reviews['ITEMS'])
	return;

?>
<div id="comments">
    <div class="engBox-body">
        <div class="title">
            Отзывы
        </div>
        <div class="elComments-list" itemprop="review" itemscope itemtype="http://schema.org/Review"><?

	    foreach ($reviews['ITEMS'] as $item)
	    {
		    ?>
            <div class="item mobile icon-comment-full"><?

                if ($item['DATE'])
                {
                    $ts = MakeTimeStamp($item['DATE']);
                    $date = \CIBlockFormatProperties::DateFormat('j F Y года', $ts);
                    $dateF = ' itemprop="datePublished" content="' . \CIBlockFormatProperties::DateFormat('Y-m-d', $ts) . '"';
					?>
                    <div class="date icon-comment"<?= $dateF ?>><?= $date ?></div><?
                }
                ?>
                <div class="title" itemprop="author"><?= $item['NAME'] ?></div>
                <div class="city"><?= $item['CITY'] ?></div>
                <div class="text" itemprop="reviewBody"><?= $item['TEXT'] ?></div>
                <div class="btn"><a onclick="
                $(this).parents('.item').find('.text').addClass('full');$(this).parent().remove();">Читать далее</a></div>
            </div><?
	    }

	    ?>

        </div><br><br>
    </div>
</div><?
