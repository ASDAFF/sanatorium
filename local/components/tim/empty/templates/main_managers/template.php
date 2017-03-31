<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$manager = \Local\Common\Manager::getAll();

$file = new \CFile();
?>
<div class="engBox-body">
    <div id="people">
        <div class="title">Остались вопросы? Задайте их менеджеру!</div><?

	    foreach ($manager as $i => $item)
	    {
		    if ($i >= 4)
			    break;

		    $img = $file->ResizeImageGet(
			    $item['PICTURE'],
			    array(
				    'width' => 160,
				    'height' => 160
			    ),
			    BX_RESIZE_IMAGE_PROPORTIONAL,
			    true
		    );

		    ?>
	        <div class="item">
	            <div class="img"><img src="<?= $img['src'] ?>"></div>
	            <div class="name"><?= $item['NAME'] ?></div>
	            <div class="phone icon-phone"><?= $item['PHONE'] ?></div>
	            <div class="btn"><a href="">Заказать звонок</a></div>
	        </div><?
	    }
	    ?>
    </div>
</div>


