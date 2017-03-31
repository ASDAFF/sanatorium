<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$manager = \Local\Common\Manager::getAll();

$file = new \CFile();
?>
<div class="engBox-body">
    <div id="people">
        <div class="title">Остались вопросы? Задайте их менеджеру!</div><?

	    $cnt = 0;
	    foreach ($manager as $item)
	    {
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
	            <div class="btn" data-manager="<?= $item['ID'] ?>"><a href="#popup">Заказать звонок</a></div>
	        </div><?

		    $cnt++;
		    if ($cnt >= 4)
			    break;
	    }
	    ?>
    </div>
</div>

<div class="feedback-popup" id="popup">
	<div class="feedback-popup-content">
		Введите свои данные
		<span>Мы свяжемся с Вами в ближайшее время!</span>
	</div>
	<form class="popup" id="callback-form">
		<div class="feedback-form-left">
			<input type="hidden" name="manager" value="0" />
			<input type="text" name="name" class="feedback-form-name" placeholder="Ваше имя" required>
			<input type="text" name="phone" class="feedback-form-city" placeholder="Номер телефона" required>
			<input type="submit" class="popup-btn" value="Отправить">
			<div class="js-submit-tnx" style="display:none;">Спасибо, мы свяжемся с Вами в ближайшее время</div>
		</div>
	</form>
</div>


