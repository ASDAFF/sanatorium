<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('aspro.resort');

$inst=new CInstargram(SITE_ID);
$arInstagramPosts=$inst->getInstagramPosts();
$arInstagramUser=$inst->getInstagramUser();
IncludeTemplateLangFile(SITE_TEMPLATE_PATH.'/header.php');
// $arInstagramTag=$inst->getInstagramTag('aspro');?>
<div class="instagram clearfix">
	<div class="container">
		<?$index = 0;?>
		<div class="items row">
			<div class="item user">
				<div class="body2">
					<div class="title"><h4><?=GetMessage('INSTAGRAM_TITLE');?></h4></div>
					<div class="description"><?=GetMessage('INSTAGRAM_DESCRIPTION');?></div>
					<div class="link"><a href="https://www.instagram.com/<?=$arInstagramUser['data']['username']?>/" target="_blank"><?=$arInstagramUser['data']['username']?></a></div>
				</div>
			</div>
			<?foreach ($arInstagramPosts['data'] as $arItem):?>
				<div class="item">
					<div class="image"><a href="<?=$arItem['link']?>" target="_blank"><img src="<?=$arItem['images']['low_resolution']['url']?>" alt="<?=$arItem['caption']['text']?>" title="<?=$arItem['caption']['text']?>" /></a></div>
				</div>
				<?if ($index == 3) break;?>
				<?++$index;?>
			<?endforeach;?>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('.instagram .item').sliceHeight();
		setTimeout (function () {
			$(window).resize();
		}, 100);
	});
</script>
<style>
	#instagram{padding:0 15px;}
	#instagram .instagram{display:block;padding:60px 0;border-top:1px solid #f5f5f5;}
	#instagram .instagram .item{float:left;width:20%;padding:0;position:relative;text-align:center;overflow: hidden;}
	#instagram .instagram .item.user{background:#f2f2f2;text-align:left;}
	#instagram .instagram .item.user .body2{padding:27px 30px;font-size:13px;line-height:18px;color:#333333;}
	#instagram .instagram .item.user .image{margin:0 auto 12px;width:36px;height:36px;background:url(<?=SITE_TEMPLATE_PATH?>/images/instagram.png) 0 0 no-repeat;}
	#instagram .instagram .item.user .name{margin:0 0 17px;font-size:20px;color:#FFF;}
	#instagram .instagram .item.user .button a{border-color:#557fa2;}
	#instagram .instagram .item.user .link{margin:8px 0 0;font-size:16px;font-weight:bold;line-height:1.1;}
	#instagram .instagram .item .image img{max-width:100%;max-height:100%;}
	
	@media (max-width: 1150px) {
		#instagram .instagram .item{width:25%;}
	}
	@media (max-width: 991px) {
		#instagram .instagram .item{width:33.33333%;}
	}
	@media (max-width: 767px) {
		#instagram .instagram .item{width:50%;}
	}
	@media (max-width: 530px) {
		#instagram .instagram .item{width:100%;}
	}
</style>