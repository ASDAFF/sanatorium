<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Сервис онлайн бронирования санаториев на КМВ — «Путевочка». Заказать оздоровительные путевки в санатории Пятигорска, Ессентуков, Кисловодска, Железноводска можно по телефону 8 800 775 2604.");
$APPLICATION->SetTitle("Карты");
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
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            ));?>
        <div id="cron-title"><h1>Карты</h1></div>
    </div>
</div>


<div class="elMaps">
    <div class="engBox-body">
        <div class="it-title">Санатории Кавказских Минеральных Вод</div>
        <div class="it-text">
            <p>
                «Путёвочка» – это бесплатный сервис бронирования санаториев на КМВ. На нашем сайте вы можете ознакомиться с полным списком санаториев и выбрать самые оптимальные для вас варианты отдыха на Кавказских Минеральных Водах и забронировать путёвку. Профессиональные менеджеры проконсультируют вас по любым вопросам, связанным с лечением в санаториях - помогут определиться с необходимым профилем для лечения различных заболеваний, расскажут об актуальных акциях и скидках в санаториях.
            </p>
            <p>
                На нашем сайте вы покупаете путевки по официальным ценам. Каждый клиент получает бесплатный трансфер до санатория, скидки на любые экскурсии по Северному Кавказу, а также возможность бронирования номеров из закрытого резервного фонда здравниц. Вместе с нами вы сделаете правильный выбор и останетесь довольны лечением и отдыхом!
            </p>
        </div>
    </div>
</div>
<div class="elMapsMenu">
    <div class="left"><span>Карта санаториев КМВ</span></div>
    <div class="right">
        <a href="">Пятигорск</a>
        <a href="">Ессентуки</a>
        <a href="">Железноводск</a>
        <a href="">Кисловодск</a>
    </div>
</div>


<div id="map"></div>
<script src="//api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
<script>
    ymaps.ready(YaMap);

    function YaMap(){

        var arPoints = {
            p1: {
                coords: [55.7649, 37.63836],
                img: '/upload/resize_cache/iblock/dc5/261_1000_1/dc5b5209274c28fd5127592ae3190bb3.jpg',
                name: 'Санаторий солнечный',
                map: 'КМВ, Кисловодск',
                price: '300 р.'
            },
            p2: {
                coords: [55.7680, 37.64080],
                img: '/upload/resize_cache/iblock/dc5/261_1000_1/dc5b5209274c28fd5127592ae3190bb3.jpg',
                name: 'Санаторий солнечный',
                map: 'КМВ, Кисловодск',
                price: '5000 р.'
            }
        };

        // Созадаем курту
        var YandexMaps = new ymaps.Map("map", {
            center: [55.7652, 37.63836],
            zoom: 15,
            controls: []
        });
        YandexMaps.behaviors.disable('scrollZoom');
        YandexMaps.controls.add("zoomControl", {
            position: {top: 15, left: 15}
        });

        var myPlacemark = {};
        //Перебераем сасив и добавляем параметры
        for (var i in arPoints) {
            var html = ('' +
                '<div class="info-map">' +
                '<div class="img"><img src="'+arPoints[i].img+'"></div>' +
                '<div class="name">'+arPoints[i].name+'</div>' +
                '<div class="map">'+arPoints[i].map+'</div>' +
                '<div class="footer">' +
                '<div class="left">' +
                '<div class="price">сутки <br><b>от '+arPoints[i].price+'</b></div>' +
                '</div>' +
                '<div class="right">' +
                '<a href="" class="btn">Подробнее</a>' +
                '</div>' +
                '</div>' +
                '</div>');

            myPlacemark[i] = new ymaps.Placemark([arPoints[i].coords[0], arPoints[i].coords[1]],
                {balloonContent: html},
                {
                    iconLayout: 'default#image',
                    iconImageHref: '/images/YandexMap-point.png',
                    iconImageSize: [27, 39],
                    iconImageOffset: [-20, -47],
                    balloonLayout: "default#imageWithContent",
                    balloonContentSize: [289, 151],
                    balloonImageHref: '/images/YandexMap-point.png',
                    balloonImageSize: [27, 39],
                    balloonImageOffset: [-20, -47],
                    balloonShadow: false
                });

            YandexMaps.geoObjects.add(myPlacemark[i]);
            console.log(myPlacemark[i]);
            console.log(i);
        }

    }
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>