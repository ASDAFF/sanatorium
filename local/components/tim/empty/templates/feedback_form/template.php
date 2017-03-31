<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

?>
<div class="prices-feedback">
	<div class="engBox-body">
		<form class="feedback-form">
			<div class="feedback-form-ttl">
				<b>Вам нужна помощь в выборе санатория?</b>
				<b>Не знаете, какой профиль лечения Вам необходим?</b>
				<i>Напишите нам и наши опытные менеджеры помогут Вам!</i>

			</div>
			<div class="feedback-form-left">
				<input type="text" class="feedback-form-name" name="name" placeholder="Ваше имя" required>
				<input type="text" class="feedback-form-city" name="phone" placeholder="Номер телефона">
				<input type="text" class="feedback-form-tel" name="email" placeholder="E-mail">
			</div>
			<div class="feedback-form-right">
				<textarea placeholder="Ваш комментарий" name="text" required></textarea>
			</div>
			<div class="feedback-form-line">
				<div class="feedback-form-checkbox">
					<input type="checkbox" id="tell-t" name="call"><label for="tell-t">Перезвоните мне</label>
				</div>
				<div class="feedback-form-checkbox">
					<input type="checkbox" id="mail-t" name="mail"><label for="mail-t">Ответьте мне по электронной
						почте</label>
				</div>
				<input class="feedback-form-btn" type="submit" value="Задать вопрос">
				<div class="js-submit-tnx" style="display:none;">Спасибо за ваш вопрос!</div>
			</div>
		</form>
	</div>
</div><?