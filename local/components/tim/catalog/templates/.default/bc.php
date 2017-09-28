<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

?>
<a href="<?= P_HREF ?>/">Главная</a> <span class="divider">/</span><?

$last = count($filter['BC']) - 1;
foreach ($filter['BC'] as $i => $item)
{
	if ($i == $last)
	{
		?>
		<span><?= $item['NAME'] ?></span><?
	}
	else
	{
		?>
		<a href="<?= P_HREF ?><?= $item['HREF'] ?>"><?= $item['NAME'] ?></a> <span class="divider">/</span><?
	}
}