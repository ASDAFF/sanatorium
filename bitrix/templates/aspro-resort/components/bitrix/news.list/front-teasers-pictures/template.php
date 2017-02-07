<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?
$this->setFrameMode(true);
?>
<?if($arResult['ITEMS']):?>
	<?
	$qntyItems = count($arResult['ITEMS']);
	$colmd = ($qntyItems > 2 ? 4 : ($qntyItems > 1 ? 6 : 12));
	$colmd = ($qntyItems > 3 ? 3 : 4);
	$colsm = ($qntyItems > 1 ? 6 : 12);
	$colxs = ($qntyItems > 1 ? 6 : 12);
	$bShowImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']);
	?>
	<div class="item-views sections teasers front">
		<div class="items row">
			<?foreach($arResult['ITEMS'] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// preview image
				if($bShowImage){
					$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
					$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 146, 'height' => 146), BX_RESIZE_IMAGE_EXACT, true) : array());
					$imageSrc = ($bImage ? $arImage['src'] : SITE_TEMPLATE_PATH.'/images/noimage.png');
				}
				// link
				$bLink = (strlen($arItem['DETAIL_PAGE_URL']) && $arParams["SHOW_DETAIL_LINK"]=="Y");
				?>
				<div class="col-md-<?=$colmd?> col-sm-<?=$colsm?> col-xs-<?=$colxs?>">
					<div class="item noborder<?=($bShowImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
						<?// icon or preview picture?>
						<?if($bShowImage):?>
							<div class="image">
								<?if($bLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="blink"><?endif;?>
									<img src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-responsive" />
								<?if($bLink):?></a><?endif;?>
							</div>
						<?endif;?>
						
						<div class="info">
							<?// element name?>
							<?if(strlen($arItem['FIELDS']['NAME'])):?>
								<div class="title">
									<?if($bLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
										<?=$arItem['NAME']?>
									<?if($bLink):?></a><?endif;?>
								</div>
							<?endif;?>

							<?// element preview text?>
							<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
								<div class="text">
									<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
								</div>
							<?endif;?>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
		<script type="text/javascript">
		$(document).ready(function(){
			// $('.teasers.front .item .info').sliceHeight();
			$('.teasers.front .item').sliceHeight();

		});
		/*BX.addCustomEvent('onWindowResize', function(eventdata) {
			try{
				ignoreResize.push(true);
				var ih = $('.teasers.front .item').height();
				$('.teasers.front .info').each(function() {
					var h = $(this).height();
					var p = 26;
					//if(h > 45){
						if((p = Math.floor((ih - h) / 2)) < 0){
							p = 0;
						}
					//}
					$(this).css('padding-top', p + 'px');
				});
			}
			catch(e){}
			finally{
				ignoreResize.pop();
			}
		});*/
		</script>
	</div>
<?endif;?>