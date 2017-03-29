<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$banners = \Local\Common\Banners::getAll();

?>
<div id="right-ban"><?
	foreach ($banners as $item)
	{
		?>
		<img src="<?= $item['PICTURE'] ?>"><?
	}
	?>
</div><?