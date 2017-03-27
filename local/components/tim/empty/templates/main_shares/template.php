<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$shares = \Local\Common\Shares::getAll(array(), array(), array());
?>
<div id="right-ban">
    <? foreach ($shares as $item) { ?>
        <a href=""><img src="<?= $item['PREVIEW_PICTURE'] ?>"></a>
    <? } ?>
</div>
