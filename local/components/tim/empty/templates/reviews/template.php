<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @global CMain $APPLICATION */
/** @var array $arParams */

$isService = $arParams['SERVICE'] == 'Y';
$cities = \Local\Catalog\City::getAll();
$cityId = 0;
$page = $_REQUEST['page'];

?>
<div id="cron_full" class="head_block">
	<div id="cron" class="engBox-body"><?

		if (!$isService)
		{
			?>
			<div class="nav-sections">
			<span class="nav-sections-title">Отзывы о санаториях:</span>
			<ul class="ul_city"><?
				foreach ($cities['ITEMS'] as $city)
				{
					$active = '';
					if ($_REQUEST['city'] == $city['CODE'])
					{
						$active = ' class="active"';
						$cityId = $city['ID'];
						$APPLICATION->AddChainItem($city['NAME'], '/reviews/' . $city['CODE'] . '/');
						$APPLICATION->SetTitle('Отзывы в ' . $city['UF_PREDL']);
						$APPLICATION->SetPageProperty('title', 'Отзывы о санаториях в ' . $city['UF_PREDL']);
					}
					?>
				<li<?= $active ?>><a href="/reviews/<?= $city['CODE'] ?>/"><?= $city['NAME'] ?></a></li><?
				}
				?>
			</ul>
			</div><?
		}

		$APPLICATION->IncludeComponent('bitrix:breadcrumb', '');

		?>
		<div id="cron-title"><h1><? $APPLICATION->ShowTitle(false); ?></h1></div>
	</div>
</div><?

?>
<div class="engBox-body">
    <div class="engText"><!--seo_text1--></div>
</div><?

$class = $isService ? ' service-reviews' : '';
$title = $isService ? '' : ' о санатории';
$reviews = \Local\Catalog\Reviews::getList($isService, $cityId, $page);

?>
<div class="engBox-body clearfix">
<div class="engBox-center">
<div id="content">
<form class="review-form<?= $class ?>" id="review-form">
	<input type="hidden" name="service" value="<?= $isService ? 1 : 0 ?>">
	<div class="feedback-form-ttl">Оставить отзыв<?= $title ?></div>
	<div class="feedback-form-left">
		<div class="feedback-form__input">
			<input type="text" class="feedback-form-name" name="name"
			       placeholder="Ваше имя" required />
			<i class="i-feedback-form-name"></i>
			<span class="required"></span>
		</div>
		<div class="feedback-form__input">
			<input type="text" class="feedback-form-city" name="city" placeholder="Ваш город" />
			<i class="i-feedback-form-city"></i>
		</div>
		<div class="feedback-form__input">
			<input type="text" class="feedback-form-tel" name="mail"
			       placeholder="E-mail" required />
			<i class="i-feedback-form-mail"></i>
			<span class="required"></span>
		</div><?

		if (!$isService)
		{
			?><div class="feedback-form__input">
			<input type="text" class="feedback-form-san" name="san"
			       placeholder="Укажите санаторий" required/>
			<i class="i-feedback-form-san"></i>
			<span class="required"></span>
		</div><?
		}

		?>
	</div>
	<div class="feedback-form-right">
		<div class="feedback-form__txt">
			<textarea placeholder="Ваш комментарий" name="txt" required></textarea>
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
		<input class="feedback-form-btn" type="submit" value="Оставить отзыв">
		<div class="js-feedback-tnx" style="display:none;">Спасибо, Ваш отзыв принят!</div>
	</div>
</form>


<script>
	var _engTabs = {
		_init: function () {
			this.Tabs = $('[engTabs]');
			this.arMenu = $('[engTabs_menu]');
			this.arBlock = $('[engTabs_block]');

			this.arItem = this.arMenu.find('a');
			this.arBlock = this.Tabs.find('.it-block');

			var _this = this;
			this.arItem.each(function(indx, element){
				$(element).on('click', _this.click);
			});

		},
		click: function () {
			var tempBlock = $($(this).attr("href"));

			_engTabs.blocks($(this).attr("href"));
		},
		blocks: function (id) {
			_engTabs.arBlock.each(function(indx, element){
				if(id == '#'+$(element).attr("id")) {
					$(element).css('display','block');
				}else{
					$(element).css('display','none');
				};
			});
		}
	};
	$(document).ready(function() {
		_engTabs._init();
	});
</script>
<style type="text/css">
	/* Базовый контейнер табов */
	.tabs {padding: 0; margin: 0 auto;
	}
	/* Стили секций с содержанием */
	.tabs>section {
		display: none;
		padding: 15px 0;
		background: #fff;
		border-top: 1px solid #ddd;
	}
	.tabs>section>p {
		margin: 0 0 5px;
		line-height: 1.5;
		color: #383838;
		/* прикрутим анимацию */
		-webkit-animation-duration: 1s;
		animation-duration: 1s;
		-webkit-animation-fill-mode: both;
		animation-fill-mode: both;
		-webkit-animation-name: fadeIn;
		animation-name: fadeIn;
	}
	/* Описываем анимацию свойства opacity */

	@-webkit-keyframes fadeIn {
		from {
			opacity: 0;
		}
		to {
			opacity: 1;
		}
	}
	@keyframes fadeIn {
		from {
			opacity: 0;
		}
		to {
			opacity: 1;
		}
	}
	/* Прячем чекбоксы */
	.tabs>input {
		display: none;
		position: absolute;
	}
	/* Стили переключателей вкладок (табов) */
	.tabs>label {
		display: inline-block;
		margin: 0 0 -1px;
		padding: 15px 25px;
		font-weight: 600;
		text-align: center;
		color: #aaa;
		border: 0px solid #ddd;
		border-width: 1px 1px 1px 1px;
		background: #f1f1f1;
		border-radius: 3px 3px 0 0;
	}

	/* Изменения стиля переключателей вкладок при наведении */

	.tabs>label:hover {
		color: #888;
		cursor: pointer;
	}
	/* Стили для активной вкладки */
	.tabs>input:checked+label {
		color: #555;
		border-top: 1px solid #ff8a00;
		border-bottom: 1px solid #fff;
		background: #fff;
	}
	/* Активация секций с помощью псевдокласса :checked */
	#tab1:checked~#content-tab1, #tab2:checked~#content-tab2, #tab3:checked~#content-tab3, #tab4:checked~#content-tab4 {
		display: block;
	}
	/* Убираем текст с переключателей
	* и оставляем иконки на малых экранах
	*/

	@media screen and (max-width: 680px) {
		.tabs>label {
			font-size: 14px;
		}
		.tabs>label:before {
			margin: 0;
			font-size: 18px;
		}
	}
	/* Изменяем внутренние отступы
	*  переключателей для малых экранов
	*/
	@media screen and (max-width: 400px) {
		.tabs>label {
			padding: 15px;
		}
	}
</style>

<div class="tabs">
	<input id="tab1" type="radio" name="tabs" checked>
	<label for="tab1" title="Отзывы">Отзывы</label>

	<input id="tab2" type="radio" name="tabs">
	<label for="tab2" title="Видео отзывы">Видео отзывы</label>

	<section id="content-tab1">
		<div id="for_city"><?
			foreach ($reviews['ITEMS'] as $item)
			{
				$date = '';
				if ($item['DATE'])
					$date = \CIBlockFormatProperties::DateFormat('j F Y года', MakeTimeStamp($item['DATE']));
				$sanName = '';
				if ($item['SANATORIUM'])
				{
					$sanatorium = \Local\Catalog\Sanatorium::getSimpleById($item['SANATORIUM']);
					$sanName = $sanatorium['NAME'];
				}

				?>
				<div class="rev-item">
				<div class="rev-item-date"><?= $date ?></div>
				<div class="rev-item-about"><?= $sanName ?></div><?

				if ($item['STARS'])
				{
					?>
					<div class="rev-item-rate">
					<div class="mark"><?
						for ($i = 5; $i >= 1; $i--)
						{
							$checked = $i == $item['STARS'] ? ' checked' : '';
							?>
							<input type="radio" name="mark-<?= $item['ID'] ?>"<?= $checked ?>
							       value="<?= $i ?>" /><label title="<?= $i ?>"><?= $i ?></label><?
						}
						?>
					</div>
					</div><?
				}
				?>
				<div class="rev-item-txt">
					<?= $item['TEXT'] ?>
				</div>
				<div class="rev-item-autor">
					<span class="rev-item-autor-name"><?= $item['NAME'] ?></span>
					<span class="rev-item-autor-city"><?= $item['CITY'] ?></span>
				</div>

				</div><?
			}
			?>
		</div>
	</section>
	<section id="content-tab2">
        <div class="elReviewsVideo">
            <div class="elReviewsVideo-list">
                    <a href="#elAboutBox1-video" class="it-video elAboutBox_fancy">
                        <div class="it-video-popap" id="elAboutBox1-video" style="display: none;">
                            <iframe src="https://www.youtube.com/embed/QS8tYQbUrNk" frameborder="0"  allowfullscreen=""></iframe>
                        </div>
                        <div class="it-video-body" style="background-image: url('/images/elIndexVideo-1.jpg">
                            <div class="it-video-body-stab">
                                <div class="it-text">О сервисе бронирования</div>
                                <div class="it-play elIndexVideo_play"></div>
                            </div>
                        </div>
                    </a>
                    <a href="#elAboutBox2-video" class="it-video elAboutBox_fancy">
                        <div class="it-video-popap" id="elAboutBox2-video" style="display: none;">
                            <iframe src="https://www.youtube.com/embed/8tQOxiI08mI" frameborder="0" allowfullscreen=""></iframe>
                        </div>
                        <div class="it-video-body" style="background-image: url('/images/elIndexVideo-2.jpg');">
                            <div class="it-video-body-stab">
                                <div class="it-text">Ваши выгоды покупки</div>
                                <div class="it-play elIndexVideo_play"></div>
                            </div>
                        </div>
                    </a>
                    <a href="#elAboutBox3-video" class="it-video elAboutBox_fancy">
                        <div class="it-video-popap" id="elAboutBox3-video" style="display: none;">
                            <iframe src="https://www.youtube.com/embed/e6NP0C7wEDc" frameborder="0"></iframe>
                        </div>
                        <div class="it-video-body" style="background-image: url('/images/elIndexVideo-3.jpg');">
                            <div class="it-video-body-stab">
                                <div class="it-text">Отзыв о сервисе</div>
                                <div class="it-play elIndexVideo_play"></div>
                            </div>
                        </div>
                    </a>
                    <a href="#elAboutBox4-video" class="it-video elAboutBox_fancy">
                        <div class="it-video-popap" id="elAboutBox4-video" style="display: none;">
                            <iframe src="https://www.youtube.com/embed/lN4UeTJ4Xpg" frameborder="0"></iframe>
                        </div>
                        <div class="it-video-body" style="background-image: url('https://i.ytimg.com/vi/lN4UeTJ4Xpg/sddefault.jpg');">
                            <div class="it-video-body-stab">
                                <div class="it-text">Отзыв о сервисе</div>
                                <div class="it-play elIndexVideo_play"></div>
                            </div>
                        </div>
                    </a>
                    <a href="#elAboutBox5-video" class="it-video elAboutBox_fancy">
                        <div class="it-video-popap" id="elAboutBox5-video" style="display: none;">
                            <iframe src="https://www.youtube.com/embed/V7xmtzHz0hM" frameborder="0"></iframe>
                        </div>
                        <div class="it-video-body" style="background-image: url('https://i.ytimg.com/vi_webp/V7xmtzHz0hM/sddefault.webp');">
                            <div class="it-video-body-stab">
                                <div class="it-text">Отзыв о санатории Лесная поляна г. Пятигорск</div>
                                <div class="it-play elIndexVideo_play"></div>
                            </div>
                        </div>
                    </a>
                </div>
        </div>
	</section>
</div>

</div>
</div>
<div class="engBox-right"><?
	$APPLICATION->IncludeComponent('tim:empty', 'banners');
	?>
</div>
</div>

<div class="el-full-bg-grey"><?= $reviews['PAGINATION'] ?></div>
