<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul class="nav-sections set-mini">
		<? foreach($arResult as $item): ?>
			<li <?if ($item["SELECTED"]):?> class="active"<?endif?>><a href="<?= P_HREF ?><?=$item['LINK']?>"><?=$item['TEXT']?></a></li>
		<? endforeach; ?>
	</ul>
<? endif; ?>