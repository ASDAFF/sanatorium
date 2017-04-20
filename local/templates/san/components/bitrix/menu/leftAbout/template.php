<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul>
	<li class="parent">
		<a href="/about/">О сервисе</a>
		<ul class="p-submenu">
			<? foreach($arResult as $item): ?>
				<li <?if ($item["SELECTED"]):?> class="active"<?endif?>><a href="<?=$item['LINK']?>"><?=$item['TEXT']?></a></li>
			<? endforeach; ?>
		</ul>
	</li>
</ul>
<? endif; ?>