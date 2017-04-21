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
        <div id="cron-title"><h1>Способы оплаты</h1></div>
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
<h2>Как оплатить?</h2>
<p>Оплата путевки может быть осуществлена после заключения договора любым удобным для Вас способом:</p>
                <ul>
                    <li>перечислением денежных средств на карту СберБанк</li>
                    <li>перечислением денежных средств на расчетный счет, указанный в договоре</li>
                </ul>
                <p><b>Внимание! Вы можете оплатить 50% стоимости путевки, а оставшуюся сумму внести в день заезда в санаторий*!</b></p>
                <p>* - данная услуга предоставляется не на все санатории, подробности уточняйте у наших менеджеров.</p>
<br>
			<h2>Реквизиты компании</h2>
			
			<p>
ООО Туристская компания «Ладья». <br>
357500, Ставропольский край, г. Пятигорск, проспект Кирова, 90<br>
Телефон: 8 800 775 2604 (звонок по России бесплатный), 8 (8793) 39-17-17<br>

				</p>

<table class="tb" style="width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 50%;">Полное наименование фирмы в соответствии с учредительными документами</td>
<td style="width: 50%;"><strong>ООО Туристская компания «Ладья»</strong></td>
</tr>
<tr>
<td style="width: 50%;">Юридический адрес в соответствии с учредительными документами</td>
<td style="width: 50%;">357500, Ставропольский край, г. Пятигорск, ул. Крайнего 43</td>
</tr>
<tr>
<td style="width: 50%;">Фактический адрес</td>
<td style="width: 50%;">357500, Ставропольский край, г. Пятигорск, проспект Кирова 90 </td>
</tr>
<tr>
<td style="width: 50%;">Телефон по фактическому адресу</td>
<td style="width: 50%;">(8793) 39-17-17, 8 800 775 2604</td>
</tr>
<tr>
<td style="width: 50%;">Факс</td>
<td style="width: 50%;">(8793) 39-44-03</td>
</tr>
<tr>
<td style="width: 50%;">e-mail компании</td>
<td style="width: 50%;"><a href="mailto:info@putevochka.com">sale@putevochka.com</a></td>
</tr>
<tr>
<td style="width: 50%;">ОГРН</td>
<td style="width: 50%;">1052603609475</td>
</tr>
<tr>
<td style="width: 50%;">ИНН</td>
<td>2632078083</td>
</tr>
<tr>
<td style="width: 50%;">КПП</td>
<td nowrap="nowrap" style="width: 50%;">263201001</td>
</tr>
<tr>
<td style="width: 50%;">Код отрасли по ОКПО</td>
<td style="width: 50%;">78773387</td>
</tr>
<tr>
<td style="width: 50%;">Код отрасли по ОКВЭД</td>
<td style="width: 50%;">79.11</td>
</tr>
<tr>
<td style="width: 50%;">Номер в федеральном реестре туроператоров</td>
<td style="width: 50%;"><strong>МВТ № 008567</strong></td>
</tr>
<tr><th colspan="2">Платежные реквизиты</th></tr>
<tr>
<td style="width: 50%;">Расчетный счет</td>
<td style="width: 50%;">40702810808000000658</td>
</tr>
<tr>
<td style="width: 50%;">Корреспондентский счет</td>
<td style="width: 50%;">30101810500000000773</td>
</tr>
<tr>
<td style="width: 50%;">БИК</td>
<td style="width: 50%;"><span>040702773</span></td>
</tr>
<tr>
<td style="width: 50%;">Полное наименование банка</td>
<td style="width: 50%;">Ставропольский ф-л ПАО "ПРОМСВЯЗЬБАНК" (филиал ОАО «Промсвязьбанк»)</td>
</tr>
<tr><th colspan="2">Руководство</th></tr>
<tr>
<td style="width: 50%;">Директор</td>
<td style="width: 50%;">Тимошенко Владислав Николаевич</td>
</tr>
</tbody>
</table>
			</div>
			
			
		</div>	
	
			
        </div>
    </div>
	
</div>
<br>
<br>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>