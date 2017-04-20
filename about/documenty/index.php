<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<div id="cron_full" class="head_block">
    <div id="cron" class="engBox-body">
		
		<div class="nav-sections">
			
		</div>
       
        <?
$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
        "START_FROM" => "0", 
        "PATH" => "", 
        "SITE_ID" => "s1" 
    )
);
?>
        <div id="cron-title"><h1>Документы</h1></div>
    </div>
</div>


<div class="engBox-body clearfix">
    <div class="engBox-center">
        <div id="content">

		<div class="page-inner">
		
			<nav class="page-inner-menu">
				<?$APPLICATION->IncludeComponent(
				'bitrix:menu', 
				'leftAbout', 
				array(
					'ALLOW_MULTI_SELECT' => 'N',
					'CHILD_MENU_TYPE' => 'left',
					'DELAY' => 'N',
					'MAX_LEVEL' => '1',
					'MENU_CACHE_GET_VARS' => array(
					),
					'MENU_CACHE_TIME' => '3600',
					'MENU_CACHE_TYPE' => 'Y',
					'ROOT_MENU_TYPE' => 'bottom',
					'USE_EXT' => 'Y',
				),
				false
			);?>
			</nav>
			
			<div class="page-inner-content">
			<h2><h2>Документы, необходимые для заезда в санаторий.</h2></h2>
<p>Взрослому</p>
			<ul>
				<li>путевка на санаторно-курортное лечение;</li>
				<li>паспорт;</li>
				<li>полис обязательного медицинского страхования;</li>
				<li>санаторно-курортная карта (учетная форма 072/у, утвержденная Приказом №834н);</li>
				<li>страховое свидетельство обязательного пенсионного страхования (при наличии);</li>
                <li>договор (полис) добровольного медицинского страхования (при наличии).</li>
                </ul>
                <p>Ребенку</p>
                <ul>
                    <li>путевка на санаторно-курортное лечение;</li>
				<li>свидетельство о рождении (для детей в возрасте до 14 лет);</li>
				<li>полис обязательного медицинского страхования;</li>
				<li>санаторно-курортная карта (учетная форма 072/у, утвержденная Приказом №834н);</li>
				<li>справка врача-педиатра или врача-эпидемиолога об отсутствии контакта с больными инфекционными заболеваниями;</li>
                <li>сертификат прививок;</li>
                <li>санаторно-курортная карта ребенка (учетная форма 076/у, утвержденная Приказом №834н).</li>
			</ul>
			<p>До заезда в санаторий, необходимо заранее проконсультироваться с врачом и оформить санаторно-курортную карту, это сэкономит Ваше время и обеспечит возможность начать курс лечения в соответствии со сроком пребывания по путевке.</p>

            <p>При отсутствии санаторно-курортной карты при заезде в санаторий, у гостей есть возможность оформить ее за дополнительную плату. Срок оформления санаторно-курортной карты в этом случае может занимать от 1 до 3 рабочих дней. Дни по путевке, в течение которых оформляется санаторно-курортная карта в санатории, не продлеваются и не компенсируются.</p>
                <a class="docs-link" href="/upload/voucher.docx" download="">Ваучер (обменная путевка)</a>
                <a class="docs-link" href="/upload/contract.doc" download="">Договор с туристом</a>
            </div>
			
			
		</div>	
	
			
        </div>
    </div>
	
</div>
<br>
<br>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>