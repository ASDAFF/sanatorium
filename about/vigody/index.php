<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>

<div id="cron_full" class="head_block">
        <div id="cron" class="engBox-body">

            <?$APPLICATION->IncludeComponent(
                'bitrix:menu',
                'topAbout',
                array(
                    "ROOT_MENU_TYPE" => "top",
                    'ALLOW_MULTI_SELECT' => 'N',
                    'CHILD_MENU_TYPE' => 'bottom',
                    'DELAY' => 'N',
                    'MAX_LEVEL' => '1',
                    'MENU_CACHE_GET_VARS' => array(
                    ),
                    'MENU_CACHE_TIME' => '3600',
                    'MENU_CACHE_TYPE' => 'Y',
                    'ROOT_MENU_TYPE' => 'bottom',
                    'USE_EXT' => 'Y',
                    'COMPONENT_TEMPLATE' => 'topAbout'
                ),
                false
            );?>

            <?
            $APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => "s1"
                )
            );
            ?>
            <div id="cron-title"><h1>Выгоды покупки</h1></div>
        </div>
    </div>


<div class="elAboutBox4">
    <div class="engBox-body">
        <div class="it-body">
            <div class="it-title">Приобрести путевку на нашем сайте - выгодно для Вас!</div>
            <div class="it-text">
                <ul> 
                    <li><b>Вы можете оплатить путевку по приезду в санаторий</b>. Данная услуга предоставляется не на все санатории, подробности уточняйте у наших менеджеров.</li>
                    <li>Мы гарантируем <b>оформление путевок по официальной цене санатория</b>. Стоимость путевки будет одинаковой у нас и у санатория. Если Вы нашли дешевле, позвоните или напишите нам, мы предложим Вам скидку!</li>
                    <li>Мы предоставим Вам бесплатный трансфер от жд вокзала до санатория. У Вас не будет необходимости обращаться к услугам посторонних людей в незнакомом городе. Наши водители встретят Вас у вагона поезда, доставят в санаторий, помогут донести багаж. <b>Внимание!</b> Бесплатный трансфер из аэропорта в любой из городов КМВ осуществляется при стимости путевки от 40 000 руб. на одного человека.</li>
					<li>Нашим клиентам дарим скидки на различные экскурсии по Северному Кавказу.</li>
<li>Вы можете <b>бесплатно отменить бронирование</b> номера в санатории.
    Список санаториев, на которые распространяется эта услуга, Вы можете посмотреть <a target="_blank" href="/about/vigody/file.docx">ЗДЕСЬ</a></li>
                    <li>Дарим бесплатную экскурсию по городу, выбранного Вами санатория при стоимости путевки от 30 000 руб. на одного человека.</li>

                    <li>Мы обладаем полной и своевременной информацией о профильном лечении, условиях проживания, качестве питания и обслуживания, наличии свободных мест.</li>
                    <li>В высокий сезон поможем получить номера из резервного фонда.</li>
                    <li>На поиск подходящего варианта может уйти много времени. Обратившись к нам, Вы получите наиболее подходящее решение в течение дня.</li>
                    <li>Закрепленный персональный менеджер поможет решить все вопросы по подбору и приобретению путевки, окажет помощь в планировании поездки, покупке билетов. А также совместно с Вами составит программу экскурсий по Северному Кавказу.</li>
                    <li><b>Ваш менеджер всегда на связи с Вами</b> на протяжении всего отдыха. Ваш личный помощник поможет организовать досуг, подскажет самый лучший магазинчик с кавказскими винами, подберет и закажет экскурсии, вызовет такси, проконсультирует по любым вопросам, связанными с пребыванием у нас в гостях.</li>
                    
                    <li>Нашим клиентам <b>дарим скидки на различные экскурсии</b> по Северному Кавказу.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="elSanRecreation">
    <div class="engBox-body">
        <div class="it-title">Выберите санаторий для отдыха и лечения</div>
        <div class="elSanRecreation-list">
        <a href="/sanatorium/essentuki/" class="it-item">
            <div class="it-img"><img src="/images/elSanRecreation-ese.jpg"></div>
            <div class="it-text eng-animations">
                <b>Санатории Ессентуков</b>
                <span>КМВ, Ессентуки</span>
                <i class="eng-animations">Посмотреть</i>
            </div>
            <div class="it-money"><b>от 1310 р.</b><span>СУТКИ</span></div>
        </a>
        <a href="/sanatorium/zheleznovodsk/" class="it-item">
            <div class="it-img"><img src="/images/elSanRecreation-jel.jpg"></div>
            <div class="it-text eng-animations">
                <b>Санатории Железноводска</b>
                <span>КМВ, Железноводск</span>
                <i class="eng-animations">Посмотреть</i>
            </div>
            <div class="it-money"><b>от 1410 р.</b><span>СУТКИ</span></div>
        </a>
        <a href="/sanatorium/kislovodsk/" class="it-item">
            <div class="it-img"><img src="/images/elSanRecreation-kis.jpg"></div>
            <div class="it-text eng-animations">
                <b>Санатории Кисловодска</b>
                <span>КМВ, Кисловодск</span>
                <i class="eng-animations">Посмотреть</i>
            </div>
            <div class="it-money"><b>от 1490 р.</b><span>СУТКИ</span></div>
        </a>
        <a href="/sanatorium/pyatigorsk/" class="it-item">
            <div class="it-img"><img src="/images/elSanRecreation-pyat.jpg"></div>
            <div class="it-text eng-animations">
                <b>Санатории Пятигорска</b>
                <span>КМВ, Пятигорск</span>
                <i class="eng-animations">Посмотреть</i>
            </div>
            <div class="it-money"><b>от 1800 р.</b><span>СУТКИ</span></div>
        </a>
    </div>
    </div>
</div>






<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>