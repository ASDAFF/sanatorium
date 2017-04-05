<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<div id="cron_full" class="head_block">
    <div id="cron" class="engBox-body">
		
		<div class="nav-sections">
			
		</div>
       
        <div id="cron-crox">
            <span>Главная</span> -
            <span>Пятигорск</span> -
            <a href="">О сервисе</a>
        </div>
        <div id="cron-title"><h1>Финансовые гарантии </h1></div>
    </div>
</div>


<div class="engBox-body clearfix">
    <div class="engBox-center">
        <div id="content">

		<div class="page-inner">
		
			<nav class="page-inner-menu">
				<ul>
					<li class="parent"><a href="/about/">О сервисе</a>
						<ul class="p-submenu">
							<li><a href="/about/vigody/">Выгоды покупки</a></li>
							<li><a href="/about/oplata/">Способы оплаты</a></li>
							<li class="active"><a href="/about/garantii/">Финансовые гарантии</a></li>
							<li><a href="/about/reviews/">Отзывы о сервисе</a></li>
							<li><a href="/about/documenty/">Договора</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			
			<div class="page-inner-content">
			<h2>Финансовые гарантии приобретения путевки в санаторий</h2>
			<ul>
				<li>Для приобретения путевки в санаторий мы заключаем договор, имеющий юридическую силу</li>
				<li>Если Вы не сможете приехать на отдых/лечение по какой-либо веской причине (заболевание вас или вашего близкого родственника, травма, обстоятельства форсмажора и т.д.) Вы должны предоставить документ, подтверждающий это, и мы вернем Вам деньги.</li>
				<li>Вы можете отменить бронь за 30 суток до заезда без потери денежных средств</li>
				<li>Если Вы решите отменить бронирование санатория за 15 дней до заезда, санаторий имеет право оставить за собой 20% от стоимости путевки </li>
				<li>Пункт 5</li>
			</ul>
			текст текст текст</p>
			</div>
			
			
		</div>	
	
			
        </div>
    </div>
	<div class="engBox-right"><?
		$APPLICATION->IncludeComponent('tim:empty', 'banners');
		?>
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