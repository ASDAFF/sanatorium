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
    <div class="engBox-body clearfix">
        <div class="engBox-center">
            <div id="content">
                <form class="review-form service-reviews" id="review-form">
                    <input type="hidden" name="service" value="0">
                    <div class="feedback-form-ttl">Оставить отзыв о санатории</div>
                    <div class="feedback-form-left">
                        <div class="feedback-form__input">
                            <input type="text" class="feedback-form-name" name="name" placeholder="Ваше имя" required="">
                            <i class="i-feedback-form-name"></i>
                            <span class="required"></span>
                        </div>
                        <div class="feedback-form__input">
                            <input type="text" class="feedback-form-city" name="city" placeholder="Ваш город">
                            <i class="i-feedback-form-city"></i>
                        </div>
                        <div class="feedback-form__input">
                            <input type="text" class="feedback-form-tel" name="mail" placeholder="E-mail" required="">
                            <i class="i-feedback-form-mail"></i>
                            <span class="required"></span>
                        </div>
                    </div>
                    <div class="feedback-form-right">
                        <div class="feedback-form-right-sanatorium">
                            <textarea placeholder="Ваш комментарий" name="txt" required=""></textarea>
                            <span class="required"></span>
                        </div>
                    </div>
                    <div class="feedback-form-line">
                        <div class="feedback-form-star">
                            <span>Плохо</span>
                            <div class="mark">
                                <input type="radio" id="star5" name="mark" value="5"><label for="star5" title="5">5</label>
                                <input type="radio" id="star4" name="mark" value="4"><label for="star4" title="4">4</label>
                                <input type="radio" id="star3" name="mark" value="3"><label for="star3" title="3">3</label>
                                <input type="radio" id="star2" name="mark" value="2"><label for="star2" title="2">2</label>
                                <input type="radio" id="star1" name="mark" value="1"><label for="star1" title="1">1</label>
                            </div>
                            <span>Хорошо</span>
                        </div>
                        <button class="feedback-form-btn" type="submit">Оставить отзыв</button>
                        <div class="js-feedback-tnx" style="display:none;">Спасибо, Ваш отзыв принят!</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="engBox-body">
        <div class="title">
            Отзывы
        </div>
        <div class="elComments-list" itemscope itemtype="http://schema.org/Review"><?

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
