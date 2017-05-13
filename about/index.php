<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Сервис онлайн бронирования санаториев на КМВ — «Путевочка». Заказать оздоровительные путевки в санатории Пятигорска, Ессентуков, Кисловодска, Железноводска можно по телефону 8 800 775 2604.");
$APPLICATION->SetTitle("О сервисе");
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
        <div id="cron-title"><h1>О сервисе</h1></div>
    </div>
</div>


    <div class="elAboutBox1">
        <div class="engBox-body">
            <div class="it-center">
                <div class="it-item">Сервис подбора санаториев</div>
                <div class="it-img"><img src="/images/elAboutBox2-logo.png"></div>
            </div>
            <div class="it-left">
                <div class="it-logo"><img src="/images/elAboutBox1-logo2.png"></div>
                <div class="it-text">В Пятигорске была создана в 2005 году<br>
                    И стала одной из ведущих фирм по организации приема
                </div>
                <div class="it-utp">
                    <div class="it-utp-item">
                        <div class="it-utp-img">
                            <img src="/images/elAboutBox1-utp-1.png">
                        </div>
                        <div class="it-utp-title">транспортного </div>
                    </div>
                    <div class="it-utp-item">
                        <div class="it-utp-title">и</div>
                    </div>
                    <div class="it-utp-item">
                        <div class="it-utp-img">
                            <img src="/images/elAboutBox1-utp-2.png">
                        </div>
                        <div class="it-utp-title">экскурсионного</div>
                    </div>
                </div>
                <div class="it-text">обслуживания в регионе Кавказских Минеральных Вод</div>
            </div>
            <div class="it-right">
                <a href="#elAboutBox1-video" class="it-video elAboutBox_fancy">
                   
                    <div class="it-video-popap"  id="elAboutBox1-video">
                        <iframe src="https://www.youtube.com/embed/truq6-RvM88?ecver=2" width="640px" height="340" frameborder="0" style="position:absolute;width:100%;height:100%;left:0" allowfullscreen></iframe>
                    </div>
                </a>
                <div class="it-text">Мы рады вам представить видео
                    о нашем новом сервисе подбора санаториев
                    “Путевочка”</div>
            </div>
        </div>
    </div>

    <div class="elAboutBox2">
        <div class="engBox-body">
            <div class="it-body">
                <div class="it-title">Мы создали сервис подбора санаториев</div>
                <div class="it-logo"><img src="/images/elAboutBox2-logo.png"></div>
                <div class="it-text">
                    <p>Мы создали этот сервис для того, чтобы процедура подбора санатория не превращалась во многочасовой труд. Для Вас достаточно оставить номер телефона, а всю дальнейшую работу по поиску и подбору будут производить уже специалисты нашей компании.</p>
                    <p>Мы с удовольствием поможем вам организовать отдых на КавМинВодах: предоставить трансфер (услуги встреча/проводы), арендовать автомобиль, предоставить услуги экскурсовода, приобрести путевку в санатории Кисловодска, Пятигорска, Железноводска или Ессентуков...</p>
                    <p>Поэтому, если вы собрались на отдых на КавМинВоды, то позвоните нам! И Ваша поездка будет интересной и запомнится на всю жизнь.</p>
                    <p>Мы отчетливо представляем себе положение людей которые занимаются поиском санатория для отдыха и лечения. Нужно просмотреть несколько сотен сайтов, упорядочить полученную информацию, отсортировать их по профилю лечения, цене, условиям проживания, требованиям к питанию и местоположению.</p>
                    <p>Это довольно долгий и кропотливый труд. Еще больше вариантов добавляют сезонные акции санаториев, вопросы по наличию свободных мест.</p>
                </div>
                <div class="it-btn">
                    <a href=""><img src="/images/elAboutBox2-logo.png"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="elAboutBox3">
        <div class="engBox-body" style="overflow: hidden;">
            <div class="it-title">Наши награды</div>
            <div class="it-text">
                <p>За 11 лет работы туристическая компания «Ладья» стала одним из ведущих туроператоров по приему в регионе КМВ. Официально наш статус оператора закреплен в Едином федеральном реестре туроператоров под номером ВНТ № 008567.</p>
                <p>Компания является победителем в конкурсе "Туристическое Ставрополье 2012" в номинации "Лучший туроператор по внутреннему туризму в Ставропольском крае".</p>
                <p>В 2010 году ООО ТК "Ладья" стала лауреатом некоммерческой государственной премии "Компания года - 2010" в Северо-Кавказском Федеральном округе.</p>
            </div>




            <div class="it-list" id="elAboutBox3-slider">
                <a href="#elAboutBox3-item-1" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item10_1.jpg">
                    <div id="elAboutBox3-item-1" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item10_1.jpg">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#elAboutBox3-item-2" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item1134.jpg">
                    <div id="elAboutBox3-item-2" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item1134.jpg">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#elAboutBox3-item-3" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item115.jpg">
                    <div id="elAboutBox3-item-3" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item115.jpg">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#elAboutBox3-item-4" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item11_1.jpg">
                    <div id="elAboutBox3-item-4" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item11_1.jpg">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#elAboutBox3-item-5" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item12_1.jpg">
                    <div id="elAboutBox3-item-5" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item12_1.jpg">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#elAboutBox3-item-6" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item13_1.JPG">
                    <div id="elAboutBox3-item-6" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item13_1.JPG">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>


                <a href="#elAboutBox3-item-7" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item1_1.jpg">
                    <div id="elAboutBox3-item-7" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item1_1.jpg">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#elAboutBox3-item-8" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item3_1.jpg">
                    <div id="elAboutBox3-item-8" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item3_1.jpg">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#elAboutBox3-item-9" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item4_1.JPG">
                    <div id="elAboutBox3-item-9" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item4_1.JPG">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#elAboutBox3-item-10" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item5_1.jpg">
                    <div id="elAboutBox3-item-10" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item5_1.jpg">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#elAboutBox3-item-11" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item6_1.png">
                    <div id="elAboutBox3-item-11" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item6_1.png">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#elAboutBox3-item-12" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item7_1.png">
                    <div id="elAboutBox3-item-12" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item7_1.png">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#elAboutBox3-item-13" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item8_1.JPG">
                    <div id="elAboutBox3-item-13" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item8_1.JPG">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#elAboutBox3-item-14" class="it-item  elAboutBox_fancy">
                    <img src="/images/elAboutBox3-list-item9_1.jpg">
                    <div id="elAboutBox3-item-14" class="it-detail">
                        <div class="elAboutBox3-slider-detail-fancy">
                            <img src="/images/elAboutBox3-list-item9_1.jpg">
                            <div class="it-text">
                                <p>Международная выставка «Путешествия и туризм»/MITT 2009 18-21 марта (Москва)- Диплом «За профессионализм и активную роль в продвижении индустрии туризма в России»</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="elAboutBox4">
        <div class="engBox-body">
            <div class="it-body">
                <div class="it-title">Выгоды покупки</div>
                <div class="it-text">
                    <ul>
                        <li>Мы обладаем полной и своевременной информацией о профильном лечении, условиях проживания, качестве питания и обслуживания, наличии свободных мест.</li>
                        <li>В высокий сезон поможем получить номера из резервного фонда.</li>
                        <li>Мы гарантируем официальные цены. Стоимость путевки будет одинаковой у нас и у санатория.</li>
                        <li>Нашли дешевле? Мы предложим Вам скидку!</li>
                        <li>На поиск подходящего варианта может уйти много времени. Обратившись к нам, Вы получите наиболее подходящее решение в течение дня.</li>
                        <li>Закрепленный персональный менеджер поможет решить все вопросы по подбору и приобретению путевки, окажет помощь в планировании поездки, покупке билетов. А также совместно с Вами составит программу экскурсий по Северному Кавказу.</li>
                        <li>Ваш менеджер всегда на связи с Вами на протяжении всего отдыха. Ваш личный помощник поможет организовать досуг, подскажет самый лучший магазинчик с кавказскими винами, подберет и закажет экскурсии, вызовет такси, проконсультирует по любым вопросам, связанными с пребыванием у нас в гостях.</li>
                        <li>Мы предоставим Вам бесплатный трансфер до санатория. У Вас не будет необходимости обращаться к услугам посторонних людей в незнакомом городе. Наши водители встретят Вас у терминала прилета или у вагона поезда, доставят в санаторий, помогут донести багаж. Совершенно бесплатно.</li>
                        <li>Нашим клиентам дарим скидки на различные экскурсии по Северному Кавказу.</li>
                        <li>Дарим бесплатную экскурсию по городу, выбранного Вами санатория.</li>
                        <span>Выберите себе санаторий на Кавказских Минеральных Водах <a href="/sanatorium/">ЗДЕСЬ</a></span>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="elAboutBox6">
        <div class="engBox-body">
            <div class="it-title">Реквизиты компании</div>
            <div class="it-text">ООО Туристская компания «Ладья».<br>
                357500, Ставропольский край, г. Пятигорск, проспект Кирова, 90<br>
                Телефон: 8 800 775 2604 (звонок по России бесплатный), 8 (8793) 39-17-17</div>
            <div class="it-left">
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
                        <td style="width: 50%;">(8793) 39-17-17</td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">Факс</td>
                        <td style="width: 50%;">(8793) 39-44-03</td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">e-mail компании</td>
                        <td style="width: 50%;"><a href="mailto:info@ladya-kmv.ru">info@ladya-kmv.ru</a></td>
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
            <div class="it-right">
                <table>
                    <tr><th colspan="2">Руководство</th></tr>
                    <tr>
                        <td style="width: 50%;">Директор</td>
                        <td style="width: 50%;">Тимошенко Владислав Николаевич</td>
                    </tr>
                    </tbody>
                </table>
                <img src="/images/elAboutBox6-images.jpg">
            </div>
        </div>
    </div>





<!--<div class="engBox-body clearfix">-->
<!--    <div class="engBox-center">-->
<!--        <div id="content">-->
<!---->
<!--		<div class="page-inner">-->
<!--		-->
<!--			<nav class="page-inner-menu">-->
<!--				<ul>-->
<!--					<li class="parent"><a href="/about/">О сервисе</a>-->
<!--						<ul class="p-submenu">-->
<!--							<li><a href="/about/vigody/">Выгоды покупки</a></li>-->
<!--							<li><a href="/about/oplata/">Способы оплаты</a></li>-->
<!--							<li class="active"><a href="/about/garantii/">Финансовые гарантии</a></li>-->
<!--							<li><a href="/about/reviews/">Отзывы о сервисе</a></li>-->
<!--							<li><a href="/about/documenty/">Документы</a></li>-->
<!--						</ul>-->
<!--					</li>-->
<!--				</ul>-->
<!--			</nav>-->
<!--			-->
<!--			<div class="page-inner-content">-->
<!--<h2>О нас</h2>-->
<!---->
<!--<p><b>Туристическая компания "Ладья"</b> (Пятигорск) была создана в 2005 году, и за время своей деятельности стала одной из ведущих фирм по организации приема, транспортного и экскурсионного обслуживания в регионе Кавказских Минеральных Вод.</p>-->
<!--<p>Мы создали  <b>сервис подбора санаториев "Путёвочка"</b> для того, чтобы процедура подбора санатория не превращалась во многочасовой труд. Для Вас достаточно оставить номер телефона, а всю дальнейшую работу по поиску и подбору будут производить уже специалисты нашей компании.</p>-->
<!---->
<!--<p>Мы с удовольствием поможем вам организовать отдых на КавМинВодах: предоставить трансфер (услуги встреча/проводы), арендовать автомобиль, предоставить услуги экскурсовода, приобрести путевку в санатории Кисловодска, Пятигорска, Железноводска или Ессентуков...</p>-->
<!--<p>Поэтому, если вы собрались на отдых на КавМинВоды, то позвоните нам! И Ваша поездка будет интересной и запомнится на всю жизнь.</p>-->
<!--			<h2>Наши награды</h2>-->
<!--<p align="justify">Туристская компания "Ладья" является победителем в конкурсе "Туристическое Ставрополье 2012" в номиниции<strong> "Лучший туроператор по внутреннему туризму в Ставропольском крае"</strong></p>-->
<!--<p align="justify">В 2010 году &nbsp;ООО ТК "Ладья" стала лауреатом некомерческой государственной премии<strong> "Компания года - 2010" в Северо-Кавказском Федеральном округе</strong></p>-->
<!--<p align="justify"><strong><br /></strong></p>-->
<!--<p align="justify"><strong>Деятельность туристской компании "Ладья" (Пятигорск) также отмечена множеством других дипломов и наград:</strong></p>-->
<!--<p align="justify">- 15 юбилейная международная туристская выставка-ярмарка &laquo;<strong>Курорты и туризм-2009</strong>&raquo; 9 по 14 января 2009 (Сочи) - Диплом <strong>&laquo;За высокое качество предоставляемых услуг&raquo;</strong></p>-->
<!--<p align="justify">- Южно-Российский курортный форум &laquo;<strong>Кавказская здравница-2009</strong>&raquo; 26&ndash;28 февраля 2009 (Кисловодск) - Диплом <strong>&laquo;За большой вклад в развитие внутреннего туризма в регионе Кавказских Минеральных Вод&raquo;</strong></p>-->
<!--<p align="justify">- Международная Туристическая выставка &laquo;<strong>БайкалТур</strong>&raquo; 25-28 февраля 2009 (Иркутск)- Диплом <strong>&laquo;За активное продвижение курортов Кавказских Минеральных Вод&raquo;</strong></p>-->
<!--<p align="justify">- Международная выставка &laquo;Путешествия и туризм&raquo;/<strong>MITT 2009 </strong>18-21 марта (Москва)- Диплом <strong>&laquo;За профессионализм и активную роль в продвижении индустрии туризма в России&raquo;</strong></p>-->
<!--<p align="justify">- Международная туристская выставка &ldquo;<strong>Интурмаркет (ITM) - 2009&rdquo; </strong>21 по 24 марта 2009 (Москва)<strong> - </strong>Диплом <strong>&laquo;За активное участи и поддержку 4-й Международной туристской выставки Интурмаркет (ITM) - 2009&raquo;</strong></p>-->
<!--<p align="justify">- 16-я Международная туристическая выставка &laquo;<strong>СамараТурЭкспо. Путешествия и Туризм 2009</strong>&raquo; 8&ndash;10 апреля 2009 (Самара) - Диплом <strong>&laquo;За активную работу по продвижению туристических маршрутов Кавказских Минеральных Вод&raquo;</strong></p>-->
<!--<p align="justify">- 9-я Московская Международная Туристская Ярмарка &laquo;<strong>MITF-2009. Туризм и отдых</strong>&raquo; 11-14 мая 2009 (Москва)- Диплом <strong>&laquo;За участие в 9-й Московской международной туристской ярмарке &laquo;MITF-2009. Туризм и отдых&raquo;</strong></p>-->
<!--<p align="justify">- 12-й международный фестиваль туризма &laquo;<strong>Мир без границ</strong>&raquo; 16-17 апреля 2009 (Ростов) - Диплом <strong> &laquo;За активное продвижение и развитие регионального туристического рынка&raquo;</strong></p>-->
<!--<p align="justify">- Специализированные выставки &laquo;<strong>Туризм и Отдых. Спорт 2009</strong>&raquo; и &laquo;<strong>Охота и рыбалка на Нижней Волге</strong>&raquo; 23 апреля 2009 (Волгоград) - Диплом <strong>&laquo;За развитие внутреннего туризма на территории Ставропольского края&raquo;</strong></p>-->
<!--<p align="justify">- 15-я международная туристическая выставка &laquo;<strong>Отдых </strong><strong>Leisure</strong>&raquo; 22-24 сентября 2009 (Москва) - Диплом <strong>&laquo;За профессионализм и активную роль в продвижении индустрии туризма в России&raquo;</strong></p>-->
<!--<p align="justify">- 16-я международная туристская выставка <strong>&laquo;Курорты и туризм-2010&raquo;</strong> 10-14 января 2010 (Сочи) - Диплом <strong>&laquo;За высокае качество и высоки ассортимент предоставляемых услуг&raquo;</strong></p>-->
<!--<p align="justify"><strong>- </strong>17-я московская международная выставка <strong>&laquo;MITT-2010&raquo; </strong>17-20 марта 2010 (Москва) - <strong>Диплом Участника выставки</strong></p>-->
<!--<p align="justify">- 6-я межрегиональная специализированная выставка <strong>&laquo;Отдых. Туризм. Спорт.&raquo;</strong> 25-27 марта 2010 (Воронеж) - <strong>Диплом Участника выставки</strong></p>-->
<!--<p align="justify">- 12-я международная туристическая выставка <strong>&laquo;Енисей-2010&raquo;</strong> 8-10 апреля 2010 (Красноярск) - Диплом за <strong>&laquo;За высокий профессионализм и разнообразие предоставляемых маршрутов региона Кавказские Минеральные Воды&raquo;</strong></p>-->
<!--<p align="justify">- 13-я межрегиональная выставка путешествий <strong>&laquo;Туризм и Отдых 2010&raquo;</strong> 15-18 апреля 2010 (Пермь) - <strong>Диплом Участника выставки </strong></p>-->
<!--<p align="justify">- 20-я Международная выставка туристских и оздоровительных услуг, авиакомпаний <strong>&laquo;Турсиб - 2010&raquo;</strong> 15-17 апреля 2010 (Новосибирск) - Диплом за <strong>&laquo;Активное участие в выставке&raquo;</strong></p>-->
<!--<p align="justify">- 7-я осенняя рабочая встреча турфирм <strong>&laquo;Турфест - 2010&raquo;</strong> 28-29 сентября (Новосибирск) - Диплом за <strong>&laquo;Активное участие в выставке&raquo;</strong></p>-->
<!--<p align="justify">&nbsp;</p>-->
<!--<p class="fancy_images"><a href="http://www.ladya-kmv.ru/files/images/rewards/kubok12.png" target="_blank"><img src="http://www.ladya-kmv.ru/files/images/rewards/kubok12_s.png" alt="Кубок за 1-е место в номинации " width="170" height="227" />&nbsp;</a><img src="http://www.ladya-kmv.ru/files/images/rewards/kubok11_s.png" alt="" width="160" height="213" /><a href="http://www.ladya-kmv.ru/files/images/rewards/kubok11.png" target="_blank">&nbsp;</a><a href="http://www.ladya-kmv.ru/files/images/rewards/route.jpg"><img src="http://www.ladya-kmv.ru/files/images/rewards/route_s.jpg" alt="" width="160" height="213" /></a><a href="http://www.ladya-kmv.ru/files/images/rewards/diplom.jpg">-->
<!--<img style="width: 170px; height: 219px;" src="http://www.ladya-kmv.ru/files/images/rewards/diplom.jpg" alt="" width="425" height="573" border="0" /></a>&nbsp;<a href="http://www.ladya-kmv.ru/files/images/rewards/MITT.jpg" target="_blank">-->
<!--<img src="http://www.ladya-kmv.ru/files/images/rewards/MITT_s.jpg" alt="Диплом выставки " width="150" height="212" /></a><a href="http://www.ladya-kmv.ru/files/images/rewards/soud.jpg" target="_blank"><img src="http://www.ladya-kmv.ru/files/images/rewards/soud_s.jpg" alt="Диплом выставки " width="150" height="212" /></a><a href="http://www.ladya-kmv.ru/files/images/rewards/kavzdrav.jpg" target="_blank"><img src="http://www.ladya-kmv.ru/files/images/rewards/kavzdrav_s.jpg" alt="Диплом выставки " width="150" height="212" /></a><a href="http://www.ladya-kmv.ru/files/images/rewards/Multitur.jpg" target="_blank">-->
<!--<img src="http://www.ladya-kmv.ru/files/images/rewards/Multitur_s.jpg" alt="Сертификат оператора " width="150" height="212" /></a><a href="http://www.ladya-kmv.ru/files/images/rewards/adm.jpg" target="_blank">-->
<!--<img src="http://www.ladya-kmv.ru/files/images/rewards/adm_s.jpg" alt="Благодарственное письмо от Администрации Пятигорска ООО ТК " width="150" height="212" /></a>-->
<!--<a href="http://www.ladya-kmv.ru/files/images/rewards/volga.JPG" target="_blank"><img src="http://www.ladya-kmv.ru/files/images/rewards/volga_s.JPG" alt="Диплом туризм и отдых. Волгоград" width="154" height="218" /></a>-->
<!--<a href="http://www.ladya-kmv.ru/files/images/rewards/Baikal.JPG" target="_blank"><img src="http://www.ladya-kmv.ru/files/images/rewards/Baikal_s.JPG" alt="Диплом выставки Байкалтур" width="149" height="219" /></a><a href="http://www.ladya-kmv.ru/files/images/rewards/Inwetex_1.JPG" target="_blank">-->
<!--<img src="http://www.ladya-kmv.ru/files/images/rewards/Inwetex_1.JPG" alt="" width="150" height="212" /> </a>-->
<!--<a href="http://www.ladya-kmv.ru/files/images/rewards/ITM.JPG" target="_blank"><img src="http://www.ladya-kmv.ru/files/images/rewards/ITM_s.jpg" alt="Диплом выставки " width="150" height="212" /></a>-->
<!--<a href="http://www.ladya-kmv.ru/files/images/rewards/diplom 1-1.jpg" target="_blank"><img src="http://www.ladya-kmv.ru/files/images/rewards/diplom 1-1.jpg" alt="" width="150" height="212" /></a>-->
<!--<a href="http://www.ladya-kmv.ru/files/images/rewards/diplom 2.jpg" target="_blank"><img src="http://www.ladya-kmv.ru/files/images/rewards/diplom 2.jpg" alt="" width="150" height="212" /></a>-->
<!--<a href="http://www.ladya-kmv.ru/files/images/rewards/diplom 3.jpg" target="_blank"><img src="http://www.ladya-kmv.ru/files/images/rewards/diplom 3.jpg" alt="" width="150" height="212" /></a>-->
<!--<a href="http://www.ladya-kmv.ru/files/images/rewards/Inwetex_1.JPG" target="_blank"><img src="http://www.ladya-kmv.ru/files/images/rewards/mbz_s.JPG" alt="Мир без границ. Ростов - на - Дону" width="211" height="149" /> </a>-->
<!--</p>-->
<!---->
<!--<p>-->
<!--ООО Туристская компания «Ладья». <br>-->
<!--357500, Ставропольский край, г. Пятигорск, проспект Кирова, 90<br>-->
<!--Телефон: 8 800 775 2604 (звонок по России бесплатный), 8 (8793) 39-17-17<br>-->
<!---->
<!--				</p>-->
<!---->
<!--<table class="tb" style="width: 100%;" border="0">-->
<!--<tbody>-->
<!--<tr>-->
<!--<td style="width: 50%;">Полное наименование фирмы в соответствии с учредительными документами</td>-->
<!--<td style="width: 50%;"><strong>ООО Туристская компания «Ладья»</strong></td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">Юридический адрес в соответствии с учредительными документами</td>-->
<!--<td style="width: 50%;">357500, Ставропольский край, г. Пятигорск, ул. Крайнего 43</td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">Фактический адрес</td>-->
<!--<td style="width: 50%;">357500, Ставропольский край, г. Пятигорск, проспект Кирова 90 </td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">Телефон по фактическому адресу</td>-->
<!--<td style="width: 50%;">(8793) 39-17-17</td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">Факс</td>-->
<!--<td style="width: 50%;">(8793) 39-44-03</td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">e-mail компании</td>-->
<!--<td style="width: 50%;"><a href="mailto:info@ladya-kmv.ru">info@ladya-kmv.ru</a></td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">ОГРН</td>-->
<!--<td style="width: 50%;">1052603609475</td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">ИНН</td>-->
<!--<td>2632078083</td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">КПП</td>-->
<!--<td nowrap="nowrap" style="width: 50%;">263201001</td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">Код отрасли по ОКПО</td>-->
<!--<td style="width: 50%;">78773387</td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">Код отрасли по ОКВЭД</td>-->
<!--<td style="width: 50%;">79.11</td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">Номер в федеральном реестре туроператоров</td>-->
<!--<td style="width: 50%;"><strong>МВТ № 008567</strong></td>-->
<!--</tr>-->
<!--<tr><th colspan="2">Платежные реквизиты</th></tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">Расчетный счет</td>-->
<!--<td style="width: 50%;">40702810808000000658</td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">Корреспондентский счет</td>-->
<!--<td style="width: 50%;">30101810500000000773</td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">БИК</td>-->
<!--<td style="width: 50%;"><span>040702773</span></td>-->
<!--</tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">Полное наименование банка</td>-->
<!--<td style="width: 50%;">Ставропольский ф-л ПАО "ПРОМСВЯЗЬБАНК" (филиал ОАО «Промсвязьбанк»)</td>-->
<!--</tr>-->
<!--<tr><th colspan="2">Руководство</th></tr>-->
<!--<tr>-->
<!--<td style="width: 50%;">Директор</td>-->
<!--<td style="width: 50%;">Тимошенко Владислав Николаевич</td>-->
<!--</tr>-->
<!--</tbody>-->
<!--</table>-->
<!--                <img src="/upload/svi.jpg">-->
<!--			</div>-->
<!--			-->
<!--			-->
<!--		</div>	-->
<!--	-->
<!--			-->
<!--        </div>-->
<!--    </div>-->
<!--	<div class="engBox-right">--><?//
//		$APPLICATION->IncludeComponent('tim:empty', 'banners');
//		?>
<!--    </div>-->
<!--</div>-->
<!--<br>-->
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>