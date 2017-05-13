<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$city = \Local\Catalog\City::getAll(true);

?>
<div class="el-lech engBox-body">
	<div class="title">
		О лечении в городах КМВ
	</div>
	<div id="about-slider" class="owl-carousel"><?
		foreach ($city['ITEMS'] as $item)
		{
			?>
			<div>
				<a href="/sanatorium/<?= $item['CODE'] ?>/" class="item">
					<div class="img">
						<img src="<?= $item['PICTURE'] ?>" />
					</div>
					<div class="inf">
						<b><?= $item['NAME'] ?></b>
<!--						<span>КМВ, --><?//= $item['NAME'] ?><!--</span>-->
						<p>
							<?= $item['DESCRIPTION'] ?>
						</p>
					</div>
				</a>
			</div><?
		}
		?>
	</div>
	<div id="about-slider-nav" class="owl-carousel slides el-lech-page"><?
		foreach ($city['ITEMS'] as $item)
		{
			?>
			<div>
				<div class="line"></div>
				<?= $item['NAME'] ?>
			</div><?
		}
		?>
	</div>
</div><?


