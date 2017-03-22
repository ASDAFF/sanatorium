<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<div id="cron_full" class="head_block">
    <div id="cron" class="engBox-body">
		
		<div class="nav-sections">
			<span class="nav-sections-title">Акции в санаториях:</span>
			<ul>
				<li class="active"><a href="#">Пятигорск</a></li>
				<li><a href="#">Ессентуки</a></li>
				<li><a href="#">Кисловодск</a></li>
				<li><a href="#">Железноводск</a></li>
			</ul>
		</div>
       
        <div id="cron-crox">
            <span>Главная</span> -
            <span>Пятигорск</span> -
            <a href="">О сервисе</a>
        </div>
        <div id="cron-title"><h1>Акции</h1></div>
    </div>
</div>


<div class="engBox-body clearfix">
    <div class="engBox-center">
        <div id="content">

		<div class="page-inner">
		
			<nav class="page-inner-menu">
				<ul>
					<li class="parent"><a href="#">О сервисе</a>
						<ul class="p-submenu">
							<li><a href="#">Выгоды покупки</a></li>
							<li><a href="#">Способы оплаты</a></li>
							<li class="active"><a href="#">Финансовые гарантии</a></li>
							<li><a href="#">Отзывы о сервисе</a></li>
							<li><a href="#">Договора</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			
			<div class="page-inner-content">
			<h2>Заголовок текстовой страницы</h2>
			<ul>
				<li>Пункт 1</li>
				<li>Пункт 2</li>
				<li>Пункт 3</li>
				<li>Пункт 4</li>
				<li>Пункт 5</li>
			</ul>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.</p>
			</div>
			
			
		</div>	
	
			
        </div>
    </div>
    <div class="engBox-right">
        <div id="right-ban">
			<a href=""><img src="/images/ban1.jpg"></a>
			<a href=""><img src="/images/ban2.jpg"></a>
			<a href=""><img src="/images/ban3.jpg"></a>
			<a href=""><img src="/images/ban4.jpg"></a>
        </div>
    </div>
</div>
<div class="el-full-bg-grey b-20">
    <div class="el-page engBox-body">
        <ul>
            <li><span>1</span></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            ...
            <li><a href="">10</a></li>
        </ul>
        <a href="">Следующая страница<div class="eng-icon-right"></div></a>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>