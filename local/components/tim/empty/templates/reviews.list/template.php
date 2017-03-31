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
        <div class="elComments-list"><?

	    foreach ($reviews['ITEMS'] as $item)
	    {
		    $date = '';
		    if ($item['DATE'])
			    $date = \CIBlockFormatProperties::DateFormat('j F Y года', MakeTimeStamp($item['DATE']));
		    ?>
            <div class="item mobile icon-comment-full">
            <div class="date icon-comment"><?= $date ?></div>
            <div class="title"><?= $item['NAME'] ?></div>
            <div class="city"><?= $item['CITY'] ?></div>
            <div class="text"><?= $item['TEXT'] ?></div>
            <div class="btn"><a onclick="
                $(this).parents('.item').find('.text').addClass('full');$(this).parent().remove();">Читать далее</a></div>
            </div><?
	    }

	    ?>

        </div><br><br>
    </div>
</div><?
