<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?><?$APPLICATION->SetTitle("Главная");?> <!-- Каталог !-->

<?
$APPLICATION->IncludeComponent('tim:filter', '', array());
?>

<?
$APPLICATION->IncludeComponent('tim:empty', 'main_san', array());
?>
<?/*	<div class="el-full-bg-ser">
		<div class="el-sanat-list engBox-body">
			<div class="title">
				Санаторий - ТОП 12
				<span>Кавказские Минеральные Воды</span>
			</div>
			<a href="" class="item">
				<div class="img"><img src="<?=SITE_TEMPLATE_PATH;?>/images/img2.jpg"></div>
				<div class="text eng-animations">
					<b>Санаторий машук</b>
					<span>КМВ, Пятигорск</span>
					<i href="">Подробнее</i>
				</div>
				<div class="money"><b>от 3000 р.</b><span>СУТКИ</span></div>
			</a>
			<a href="" class="item">
				<div class="img"><img src="<?=SITE_TEMPLATE_PATH;?>/images/img2.jpg"></div>
				<div class="text eng-animations">
					<b>Санаторий машук</b>
					<span>КМВ, Пятигорск</span>
					<i href="">Подробнее</i>
				</div>
				<div class="money"><b>от 3000 р.</b><span>СУТКИ</span></div>
			</a>
			<a href="" class="item">
				<div class="img"><img src="<?=SITE_TEMPLATE_PATH;?>/images/img2.jpg"></div>
				<div class="text eng-animations">
					<b>Санаторий машук</b>
					<span>КМВ, Пятигорск</span>
					<i href="">Подробнее</i>
				</div>
				<div class="money"><b>от 3000 р.</b><span>СУТКИ</span></div>
			</a>
			<a href="" class="item">
				<div class="img"><img src="<?=SITE_TEMPLATE_PATH;?>/images/img2.jpg"></div>
				<div class="text eng-animations">
					<b>Санаторий машук</b>
					<span>КМВ, Пятигорск</span>
					<i href="">Подробнее</i>
				</div>
				<div class="money"><b>от 3000 р.</b><span>СУТКИ</span></div>
			</a>
			<a href="" class="item">
				<div class="img"><img src="<?=SITE_TEMPLATE_PATH;?>/images/img2.jpg"></div>
				<div class="text eng-animations">
					<b>Санаторий машук</b>
					<span>КМВ, Пятигорск</span>
					<i href="">Подробнее</i>
				</div>
				<div class="money"><b>от 3000 р.</b><span>СУТКИ</span></div>
			</a>
			<a href="" class="item">
				<div class="img"><img src="<?=SITE_TEMPLATE_PATH;?>/images/img2.jpg"></div>
				<div class="text eng-animations">
					<b>Санаторий машук</b>
					<span>КМВ, Пятигорск</span>
					<i href="">Подробнее</i>
				</div>
				<div class="money"><b>от 3000 р.</b><span>СУТКИ</span></div>
			</a>
			<a href="" class="item">
				<div class="img"><img src="<?=SITE_TEMPLATE_PATH;?>/images/img2.jpg"></div>
				<div class="text eng-animations">
					<b>Санаторий машук</b>
					<span>КМВ, Пятигорск</span>
					<i href="">Подробнее</i>
				</div>
				<div class="money"><b>от 3000 р.</b><span>СУТКИ</span></div>
			</a>
			<a href="" class="item">
				<div class="img"><img src="<?=SITE_TEMPLATE_PATH;?>/images/img2.jpg"></div>
				<div class="text eng-animations">
					<b>Санаторий машук</b>
					<span>КМВ, Пятигорск</span>
					<i href="">Подробнее</i>
				</div>
				<div class="money"><b>от 3000 р.</b><span>СУТКИ</span></div>
			</a>
			<div class="top-s-searchbox">
				<div class="btn btn-all">
					<a href="">смотреть все санатории</a>
				</div>
				<form class="s-searchbox">
					<input type="search" placeholder="Введите название санатория......" name="search" class="s-searchbox-input">
					<input type="submit" class="s-searchbox-submit" value="Найти">
				</form>
			</div>
		</div>
	</div>*/?>
<?
$APPLICATION->IncludeComponent('tim:empty', 'main_slide_city', array());
?>
<? /*<div class="el-lech engBox-body">
	<div class="title">
		 О лечении в городах КМВ
	</div>
	<div id="slider" class="flexslider">
		<ul class="slides">
			<li> <a href="" class="item">
			<div class="img">
 <img src="/local/templates/san/images/img3.jpg">
			</div>
			<div class="inf">
 <b>Пятигорск</b>
				КМВ, Пятигорск
				<p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
				</p>
			</div>
 </a> </li>
			<li> <a href="" class="item">
			<div class="img">
 <img src="/local/templates/san/images/img3.jpg">
			</div>
			<div class="inf">
 <b>Пятигорск</b>
				КМВ, Пятигорск
				<p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
				</p>
			</div>
 </a> </li>
			<li> <a href="" class="item">
			<div class="img">
 <img src="/local/templates/san/images/img3.jpg">
			</div>
			<div class="inf">
 <b>Пятигорск</b>
				КМВ, Пятигорск
				<p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
				</p>
			</div>
 </a> </li>
			<li> <a href="" class="item">
			<div class="img">
 <img src="/local/templates/san/images/img3.jpg">
			</div>
			<div class="inf">
 <b>Пятигорск</b>
				КМВ, Пятигорск
				<p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
				</p>
			</div>
 </a> </li>
		</ul>
	</div>
	<div id="carousel" class="flexslider">
		<ul class="slides el-lech-page">
			<li>
			<div class="line">
			</div>
			 Железноводск </li>
			<li>
			<div class="line">
			</div>
			 Железноводск </li>
			<li>
			<div class="line">
			</div>
			 Железноводск </li>
			<li>
			<div class="line">
			</div>
			 Железноводск </li>
		</ul>
	</div>
</div>*/?>


<?
$APPLICATION->IncludeComponent('tim:empty', 'main_comments', array());
?>

<?/*<div id="comments">
	<div class="engBox-body">
		<div class="title">
			 Отзывы
		</div>
		<div class="item mobile icon-comment-full">
			<div class="date icon-comment">
				 26 октября 2016
			</div>
			<div class="title">
				 Имя Фамилия
			</div>
			<div class="city">
				 г. Санкт-Петербург
			</div>
			<div class="text">
				 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
			</div>
			<div class="btn">
 <a href="#">Читать далее</a>
			</div>
		</div>
		<div class="item mobile icon-comment-full">
			<div class="date icon-comment">
				 26 октября 2016
			</div>
			<div class="title">
				 Имя Фамилия
			</div>
			<div class="city">
				 г. Санкт-Петербург
			</div>
			<div class="text">
				 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
			</div>
			<div class="btn">
 <a href="#">Читать далее</a>
			</div>
		</div>
		<div class="btn">
 <a href=""> Все отзывы</a>
		</div>
	</div>
</div>
*/?>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>