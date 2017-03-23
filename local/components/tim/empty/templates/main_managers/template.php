<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$manager = \Local\Common\Manager::getAll();

?>
<div class="engBox-body">
    <div id="people">
        <div class="title">Остались вопросы? Задайте их менеджеру!</div><?

	    foreach ($manager as $item)
	    {
		    ?>
	        <div class="item">
	            <div class="img"><img src="<?= $item['PREVIEW_PICTURE'] ?>"></div>
	            <div class="name"><?= $item['NAME'] ?></div>
	            <div class="phone icon-phone"><?= $item['MANAGER_PHONE'] ?></div>
	            <div class="btn"><a href="">Заказать звонок</a></div>
	        </div><?
	    }
	    ?>
    </div>
</div>


