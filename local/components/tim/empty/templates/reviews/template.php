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
		<div id="cron-title"><h1><? $APPLICATION->ShowTitle(); ?></h1></div>
	</div>
</div><?

$class = $isService ? ' service-reviews' : '';
$title = $isService ? '' : ' о санатории';
$reviews = \Local\Catalog\Reviews::getList($isService, $cityId, $page);

?>
<div class="engBox-body clearfix">
	<div class="engBox-center">
		<div id="content">
			<form class="feedback-form<?= $class ?>" id="review-form">
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
						<i class="i-feedback-form-txt"></i>
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
				</div>
			</form>
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
		</div>
	</div>
	<div class="engBox-right"><?
		$APPLICATION->IncludeComponent('tim:empty', 'banners');
		?>
	</div>
</div>

<div class="el-full-bg-grey"><?= $reviews['PAGINATION'] ?></div>
