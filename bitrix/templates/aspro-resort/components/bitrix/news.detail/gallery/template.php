<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$index = 1;?>
<?if (isset($arResult['GALLERY'])):?>
	<div class="front_gallery inner">
		<div class="wrap clearfix">
			<?foreach ($arResult['GALLERY']['NORMAL'] as $key => $arImage):?>
				<div class="item">
					<div class="wrap">
						<div class="img_block scale_block_animate"><a title="<?=(strlen($arResult['GALLERY']['DESCRIPTION'][$key]) ? $arResult['GALLERY']['DESCRIPTION'][$key] : $arResult['NAME'])?>" rel="gallery" class="fancybox" href="<?=$arResult['GALLERY']['BIG'][$key]['src']?>"><img src="<?=$arImage['src']?>" alt="<?=(strlen($arResult['GALLERY']['DESCRIPTION'][$key]) ? $arResult['GALLERY']['DESCRIPTION'][$key] : $arResult['NAME'])?>" title="<?=(strlen($arResult['GALLERY']['DESCRIPTION'][$key]) ? $arResult['GALLERY']['DESCRIPTION'][$key] : $arResult['NAME'])?>" /></a></div>
						<?if (strlen($arResult['GALLERY']['DESCRIPTION'][$key])):?>
							<div class="text"><?=$arResult['GALLERY']['DESCRIPTION'][$key]?></div>
						<?else:?>
							<div class="text"><?=$arResult['NAME']?></div>
						<?endif;?>
						<span title="<?=(strlen($arResult['GALLERY']['DESCRIPTION'][$key]) ? $arResult['GALLERY']['DESCRIPTION'][$key] : $arResult['NAME'])?>" class="dark_block_animate"></span>
					</div>					
				</div>
				<?if (strlen($arParams['SHOW_COUNT_PHOTOS']) && $index && $arParams['SHOW_COUNT_PHOTOS'] != 0 && $arParams['SHOW_COUNT_PHOTOS'] == $index):?>
					<?break;?>
				<?endif;?>
				<?++$index;?>
			<?endforeach;?>
		</div>
	</div>
	<script>
		$(document).ready(function () {
			$('.front_gallery .item .img_block').sliceHeight({'lineheight': -3});
			$('.front_gallery .item .dark_block_animate').on('click', function () {
				$(this).closest('.item').find('a').click();
			});
		});
	</script>
<?endif;?>
