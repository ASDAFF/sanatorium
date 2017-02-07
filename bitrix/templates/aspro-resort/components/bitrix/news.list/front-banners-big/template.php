<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?if($arResult['ITEMS']):?>
	<?
	global $arTheme;
	$slideshowSpeed = abs(intval($arTheme['BIGBANNER_SLIDESSHOWSPEED']['VALUE']));
	$animationSpeed = abs(intval($arTheme['BIGBANNER_ANIMATIONSPEED']['VALUE']));
	$bAnimation = ($slideshowSpeed && strlen($arTheme['BIGBANNER_ANIMATIONTYPE']['VALUE']));
	if($arTheme['BIGBANNER_ANIMATIONTYPE']['VALUE'] === 'FADE'){
		$animationType = 'fade';
	}
	else{
		$animationType = 'slide';
		$animationDirection = 'horizontal';
		if($arTheme['BIGBANNER_ANIMATIONTYPE']['VALUE'] === 'SLIDE_VERTICAL'){
			$animationDirection = 'vertical';
		}
	}
	?>
	<div class="banners-big front">
		<div class="maxwidth-banner">
			<div class="flexslider unstyled <?=($animationDirection == 'vertical' ? 'vertical' : '')?>" data-plugin-options='{"directionNav": true, "controlNav": true, <?=($bAnimation ? '"slideshow": true,' : '"slideshow": false,')?> <?=($animationType ? '"animation": "'.$animationType.'",' : '')?> <?=($animationDirection ? '"direction": "'.$animationDirection.'",' : '')?> <?=($slideshowSpeed >= 0 ? '"slideshowSpeed": '.$slideshowSpeed.',' : '')?> <?=($animationSpeed >= 0 ? '"animationSpeed": '.$animationSpeed.',' : '')?> "animationLoop": true}'>
				<ul class="slides items">
					<?foreach($arResult['ITEMS'] as $i => $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						$imageBgSrc = is_array($arItem['DETAIL_PICTURE']) ? $arItem['DETAIL_PICTURE']['SRC'] : $this->GetFolder().'/images/background.jpg';
						$type = $arItem['PROPERTIES']['BANNERTYPE']['VALUE_XML_ID'];
						$bOnlyImage = $type == 'T1' || !$type;
						$bLinkOnName = strlen($arItem['PROPERTIES']['LINKIMG']['VALUE']);
						?>
						<li class="item" id="<?=$this->GetEditAreaId($arItem['ID'])?>" style="background:url('<?=$imageBgSrc?>') center center no-repeat !important;">
							<div class="maxwidth-theme<?=($bOnlyImage && $bLinkOnName ? ' fulla' : '')?>">
								<div class="row <?=$arItem['PROPERTIES']['TEXTCOLOR']['VALUE_XML_ID']?> <?=($type != 'T2' ? 'righttext' : '')?>">
									<?ob_start();?>
									<?if(!$bOnlyImage):?>
										<?if($bLinkOnName):?>
											<a href="<?=$arItem['PROPERTIES']['LINKIMG']['VALUE']?>" class="title-link">
												<div class="title"><?=$arItem['NAME']?></div>
											</a>
										<?else:?>
											<div class="title"><?=$arItem['NAME']?></div>
										<?endif;?>
										<div class="text-block">
											<?=$arItem['PREVIEW_TEXT']?>
										</div>
										<div class="wr_button_slider">
											<?if(strlen($arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']) && strlen($arItem['PROPERTIES']['BUTTON1LINK']['VALUE'])):?>
												<span class="button_slider">
													<a href="<?=$arItem['PROPERTIES']['BUTTON1LINK']['VALUE']?>" class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON1CLASS']['VALUE']) ? $arItem['PROPERTIES']['BUTTON1CLASS']['VALUE'] : 'btn-default white')?>">
														<?=$arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']?>
													</a>
												</span>
											<?endif;?>
											<?if(strlen($arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']) && strlen($arItem['PROPERTIES']['BUTTON2LINK']['VALUE'])):?>
												<span class="button_slider">
													<a href="<?=$arItem['PROPERTIES']['BUTTON2LINK']['VALUE']?>" class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON2CLASS']['VALUE'] ) ? $arItem['PROPERTIES']['BUTTON2CLASS']['VALUE'] : 'btn-default')?>">
														<?=$arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']?>
													</a>
												</span>
											<?endif;?>
										</div>
									<?endif;?>
									<?$text = ob_get_clean();?>
									
									<?ob_start();?>
									<?if(is_array($arItem['PREVIEW_PICTURE'])):?>
										<?if($bLinkOnName):?>
											<a href="<?=$arItem['PROPERTIES']['LINKIMG']['VALUE']?>" class="image">
												<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" />
											</a>
										<?else:?>
											<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" />
										<?endif;?>
									<?endif;?>
									<?$img = ob_get_clean();?>
									
									<?if(!$bOnlyImage || (is_array($arItem['PREVIEW_PICTURE']) && !$bOnlyImage)):?>
										<div class="col-md-6 <?=$type == 'T2' ? 'text' : 'img'?>">
											<div class="inner">
												<?=$type == 'T2' ? $text : $img?>
											</div>
										</div>
										<div class="col-md-6 <?=$type == 'T2' ? 'img' : 'text'?>">
											<div class="inner">
												<?=$type == 'T2' ? $img : $text?>
											</div>
										</div>
									<?elseif($bOnlyImage && $bLinkOnName):?>
										<a href="<?=$arItem['PROPERTIES']['LINKIMG']['VALUE']?>"></a>
									<?endif;?>
								</div>
							</div>
						</li>
					<?endforeach;?>
				</ul>
			</div>
		</div>
	</div>
<?endif;?>