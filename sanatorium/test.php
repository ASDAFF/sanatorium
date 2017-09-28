te<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>
<script>
    $(function () {
        $.datepicker.regional['ru'] = {
            closeText: 'Закрыть',
            prevText: '&#x3c;Пред',
            nextText: 'След&#x3e;',
            currentText: 'Сегодня',
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
                'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
            dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
            dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
            dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            dateFormat: 'dd.mm.yy',
            firstDay: 1,
            isRTL: false
        };
        $.datepicker.setDefaults($.datepicker.regional['ru']);

        $("#datepicker").datepicker();
        $("#datepicker2").datepicker();
        $("#numb-phone").mask("+7(999) 999-9999");
    });
</script>
<style>
    .calculator div {
        font-size: 12px;
    }

    .error {
        border: 1.5px solid !important;
        border-color: red !important;
    }

    .new-form {
        margin-top: 22px;
    }

    .form-title {
        padding-left: 22px;
        padding-right: 22px;
        height: 66px;
    }

    .form-title {
        text-transform: uppercase;
        color: white;
        background-color: #ff8a00;

    }

    .form-title span {
        font-family: Candara, serif;
        font-weight: bold;
    }

    .form-title-first {
        font-size: 24px;
    }

    .form-title-second {
        font-size: 13px;
        white-space: nowrap;
    }

    .form-body {
        background-color: #2c9ed7;
        color: white;
        padding-right: 30px;
        padding-left: 30px;
    }

    .form-body input {
        vertical-align: middle;
    }

    .form-body-right {
        float: right;
    }

    .form-body input[type="checkbox"] {
        -webkit-appearance: checkbox;
    }

    .who-you-are .form-body-right span {
        color: black;
    }

    .calendar {
        display: inline-block;
        width: 100%;
    }

    .calendar .left-block,
    .calendar .right-block {
        width: 40%;
    }

    .calendar .middle-block {
        width: 20%;
    }

    .calendar div {
        text-align: center;
        float: left;
        display: block;
    }

    .data-form-input {
        border: none;
        background-color: #f3f3f3;
        color: gray;
        border-radius: 5px;
        text-align: center;
        width: 85px;
        box-shadow: 0px 3px 3px 0px rgba(0, 0, 0, 0.3);
    }

    .middle-block {
        padding-top: 20px;
    }

    .calendar {
        font-size: 10px;
    }

    .list-input.calc-form select {
        width: 135px;
        border-radius: 5px;
        box-shadow: 0px 3px 3px 0px rgba(0, 0, 0, 0.3);
    }

    .list-input.calc-form select {
        line-height: 1.5;
        text-indent: 10px;
        border: transparent;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .input-check {
        padding-left: 13px;
        display: inline-block;
        *display: inline; /* inline-block ie7 fix */
        *zoom: 1;
        vertical-align: text-top;
        position: relative;
        cursor: pointer;
    }

    .input-check input {
        width: 19px;
        height: 19px;
        position: absolute;
        left: 0;
        top: 50%;
        cursor: pointer;
        z-index: 10;
        opacity: 0;
    }

    .input-check label:before {
        display: block;
        position: absolute;
        left: 0;
        top: 50%;
        width: 19px;
        height: 19px;
        background: rgba(0, 0, 0, 0) url(/images/calc/check_box_uncheck.png) no-repeat;
        z-index: 5;
        content: '';
    }

    .list-input.calc-form select {
        background: url(/images/calc/arrow_up_deact.png) no-repeat right #ffffff
    }

    .list-input.calc-form select:focus {
        background: url(/images/calc/arrow_up.png) no-repeat right #ffffff
    }

    .input-check input:checked + label:before {
        background: url(/images/calc/check_box.png) no-repeat;
    }

    .list-input.calc-form .form-body-right {
        font-size: 10px;
        margin-top: 3px;
        color: gray;
    }

    .float-block {
        margin-top: 10px;
        padding: 10px 10px 25px;
        border: 2px solid #fe8a01;
    }

    .float-body {
        padding-left: 15px;
        padding-right: 15px;
    }

    .calculator {
        background-color: #2c9ed7;
    }

    .people-delete {
        float: right;
        color: black;
    }

    .people-delete img {
        padding-left: 10px;
        vertical-align: middle;
    }

    .number-type {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .number-type img {
        vertical-align: middle;
    }

    .selector {
        text-align: center;
        width: 57px;
        border-radius: 6px;
    }

    .float-body {
        padding-bottom: 15px;
    }

    .form-submit {
        cursor: pointer;
    }

    .form-submit {
        border: solid;
        width: 100%;
        background: url(/images/calc/2arrow.png) #5fb3dd no-repeat;
        background-position-x: 8px;
        background-size: 30px;
        border-color: #ff8a00;
        border-width: 2px;
        background-position-y: 11px;
    }

    .form-footer {
        padding-right: 30px;
        padding-left: 30px;
    }

    .form-submit-text {
        color: white;
        padding-left: 50px;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-right: 5px;
    }

    .form-submit-text {
        line-height: 15px;
    }

    .form-footer-body .selector {
        margin-bottom: 10px;
        width: 100%;
    }

    .form-footer {
        padding-bottom: 25px;
    }

    .form-body.float-body {
        display: none;
    }

    .form-footer-title {
        padding-left: 20%;
        padding-right: 20%;
        color: white;
    }

    .first-number-type {
        padding-bottom: 5px;
    }

    .new-float-block {
        padding-bottom: 3px;
    }

    .list-input-new {
        margin-top: 4px;
    }

    .unchecked {
        pointer-events: none;
        cursor: none;
    }

    .confidentiality {
        font-size: 12px;
    }

    .confidentiality input {
        -webkit-appearance: checkbox;
    }

    .confidentiality a {
        font-size: 12px;
        color: #0e67e1;
    }
</style>
<div class="engBox-right card-form new-form">
    <form class="calculator" id="price-form">
        <div class="form-title">
            <span class="form-title-first">Заполните форму</span><br>
            <span class="form-title-second">Чтобы узнать стоймость путевки</span>
        </div>
        <div class="form-body">
            <div class="calendar">
                <div class="left-block">
                    Дата заезда<br>
                    <input type="text" class="data-form-input" placeholder="дд.мм.гг" id="datepicker">
                </div>
                <div class="middle-block">
                    <img src="/images/calc/strelka.png">
                </div>
                <div class="right-block">
                    Дата выезда<br>
                    <input type="text" class="data-form-input" placeholder="дд.мм.гг" id="datepicker2">
                </div>
            </div>
        </div>
        <div class="form-body float-body" style="display: block;">
            <div class="float-block new-float-block">
                <div class="who-you-are">
                    Кто Вы
                    <div class="list-input calc-form form-body-right">
                        <select class="form-body-right">
                            <option>Взрослый</option>
                            <option>Ребенок</option>
                        </select>
                    </div>
                    <div class="number-type">Тип номера
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>Пункт 1</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="number-type">
                        Размещение
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>На основном месте</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="number-type first-number-type">
                        Программа
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>Программа 3</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="number-type">
                <img src="/images/calc/people.png">
                <input class="selector" type="number" id="count-people" min="0" max="5">
                <!--<div class="list-input calc-form form-body-right list-input-new">
                    <select class="form-body-right">
                        <option>Пункт 1</option>
                        <option>Пункт 2</option>
                    </select>
                </div>-->
            </div>
        </div>
        <div id="sub_form0" class="form-body float-body">
            <div class="float-block">
                <div class="who-you-are">
                    Кто Вы
                    <div class="list-input calc-form form-body-right">
                        <select class="form-body-right">
                            <option>Взрослый</option>
                            <option>Ребенок</option>
                        </select>
                    </div>
                    <div class="number-type">Тип номера
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>Пункт 1</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="number-type">
                        Размещение
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>На основном месте</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="number-type">
                        Программа
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>Программа 3</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="delete-user">
                        <a class="people-delete" href="#">Удалить<img src="/images/calc/people.png"><img
                                    src="/images/calc/minus.png"></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="sub_form1" class="form-body float-body">
            <div class="float-block">
                <div class="who-you-are">
                    Кто Вы
                    <div class="list-input calc-form form-body-right">
                        <select class="form-body-right">
                            <option>Взрослый</option>
                            <option>Ребенок</option>
                        </select>
                    </div>
                    <div class="number-type">Тип номера
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>Пункт 1</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="number-type">
                        Размещение
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>На основном месте</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="number-type">
                        Программа
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>Программа 3</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="delete-user">
                        <a class="people-delete" href="#">Удалить<img src="/images/calc/people.png"><img
                                    src="/images/calc/minus.png"></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="sub_form2" class="form-body float-body">
            <div class="float-block">
                <div class="who-you-are">
                    Кто Вы
                    <div class="list-input calc-form form-body-right">
                        <select class="form-body-right">
                            <option>Взрослый</option>
                            <option>Ребенок</option>
                        </select>
                    </div>
                    <div class="number-type">Тип номера
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>Пункт 1</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="number-type">
                        Размещение
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>На основном месте</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="number-type">
                        Программа
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>Программа 3</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="delete-user">
                        <a class="people-delete" href="#">Удалить<img src="/images/calc/people.png"><img
                                    src="/images/calc/minus.png"></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="sub_form3" class="form-body float-body">
            <div class="float-block">
                <div class="who-you-are">
                    Кто Вы
                    <div class="list-input calc-form form-body-right">
                        <select class="form-body-right">
                            <option>Взрослый</option>
                            <option>Ребенок</option>
                        </select>
                    </div>
                    <div class="number-type">Тип номера
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>Пункт 1</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="number-type">
                        Размещение
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>На основном месте</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="number-type">
                        Программа
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>Программа 3</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="delete-user">
                        <a class="people-delete" href="#">Удалить<img src="/images/calc/people.png"><img
                                    src="/images/calc/minus.png"></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="sub_form4" class="form-body float-body">
            <div class="float-block">
                <div class="who-you-are">
                    Кто Вы
                    <div class="list-input calc-form form-body-right">
                        <select class="form-body-right">
                            <option>Взрослый</option>
                            <option>Ребенок</option>
                        </select>
                    </div>
                    <div class="number-type">Тип номера
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>Пункт 1</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="number-type">
                        Размещение
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>На основном месте</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="number-type">
                        Программа
                        <div class="list-input calc-form form-body-right">
                            <select class="form-body-right">
                                <option>Программа 3</option>
                                <option>Пункт 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="delete-user">
                        <a class="people-delete" href="#">Удалить<img src="/images/calc/people.png"><img
                                    src="/images/calc/minus.png"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-footer">
            <div class="form-footer-title">
                <small><span id="count-men">2</span> взрослых, <span id="count-baby">1</span> ребенок</small>
                <br>
                <span>сумма <span id="count_mooney">10000</span> руб.</span>
            </div>
            <div class="form-footer-body">
                <input class="selector" placeholder="Введите имя">
                <br>
                <input id="numb-phone" class="selector" placeholder="Введите телефон">
            </div>
            <div class="confidentiality"><label>
                    <input type="checkbox" onclick="$('#sub_form').toggleClass('unchecked')">
                </label>Настоящим
                подтверждаю, что я ознакомлен и согласен с условиями
                <a href="/uploads/conf.doc">политики конфиденциальности</a></div>
            <div class="form-submit form-submit-text">
                <p>
                    Забронировать отдых<br>
                    и получить скидку
                </p>
            </div>

        </div>
    </form>
</div>
<script>
    /*   $('.selector').change(function (e) {
           var val = $('.selector').val();
           for (var i = 0; i < val ; i++ ){
               console.log(i);
           }
       });*/
    document.getElementById('count-people').oninput = function () {
        if (this.value.length > 7) this.value = this.value.substr(0, 1);
        var val = $('#count-people').val();
        for (var i = 0; i < 5; i++) {
            $('#sub_form' + i).hide();
        }
        for (var j = 0; j < val; j++) {
            $('#sub_form' + j).show();
        }
    };
    $('.people-delete').on('click', function () {
        var val = $('#count-people').val();
        if (!(+val === 0 && +val === 6)) {
            val = val - 1;
            $('#count-people').val(val);
            for (var i = 0; i < 5; i++) {
                $('#sub_form' + i).hide();
            }
            for (var j = 0; j < val; j++) {
                $('#sub_form' + j).show();
            }
        }
    });


</script>
                    <!-- НАЧАЛО ВЁРСТКИ ДЕТАЛЬНОЙ СТРАНИЦЫ САНАТОРИЯ -->
                    <div class="tab-pane active" id="rooms">
                        <div id="room496" class="detail-sanatorium" style="">
                            <div class="title">1 местный 1 комнатный 1 категория</div>
                            <div class="el-nomer-popap">
                                <div class="left">
                                    <a class="icon2" href="/sanatorium/essentuki/tselebnyy-klyuch/rooms/">&#8592; Все номера санатория</a>
                                    <div class="images">
                                    <div class="img">
                                        <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                                            <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                                        </a>
                                    </div>
                                        <div class="img">
                                            <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg"  class="border various">
                                                <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                                            </a>
                                        </div>
                                        <div class="img">
                                            <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg"  class="border various">
                                                <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                                            </a>
                                        </div>
                                        <div class="img">
                                            <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg"  class="border various">
                                                <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                                            </a>
                                        </div>
                                        <div class="img">
                                            <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg"  class="border various">
                                                <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                                            </a>
                                        </div>
                                    </div>
                                    <div style="text-align: center">
                                        <input id="popup-bron-btn" type="button" data-id="496"
                                               class="btn-detail-sanatorium ui-widget ui-controlgroup-item ui-button ui-corner-right"
                                               value="ЗАБРОНИРОВАТЬ" role="button">
                                    </div>
                                    <div class="info-bottom">
                                        <div class="right">
                                            <div class="text">
                                                <b>Площадь:</b> 14 м2 <br> <b>Кроватей: </b>Односпальных: 1 <br><br> <b>В
                                                    стоимость включено:</b><br>проживание, питание, лечение.<br><br> <b>Вместимость
                                                    номера:</b><br>
                                                <ul>
                                                    <li><span class="first">основных мест - 1 шт</span></li>
                                                </ul>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="inf">
                                            <div class="price-start"><span
                                                        class="txt">Цена за номер в сутки от</span><span class="num">3150р</span>
                                            </div>
                                            <i class="price-start-details">(в стоимость проживания входит
                                                лечение по общетерапевтической путевке)</i>
                                            <div class="tit">Стоимость основных мест:</div>
                                            <ul>
                                                <li>
                                                    <span class="first">основное взрослое (с подселением)</span>
                                                    <span class="second">3150р</span>
                                                </li>
                                                <li>
                                                    <span class="first">детское</span></li>
                                                <li>
                                                    <span class="first">размещение одним (выкуп номера)</span> <span
                                                            class="second">3150р</span></li>
                                            </ul>
                                            <div class="tit">Стоимость дополнительных мест:</div>
                                            <ul>
                                                <li>
                                                    <span class="first">взрослое</span></li>
                                                <li>
                                                    <span class="first">детское</span></li>

                                            </ul>
                                        </div>
                                        <div class="icon">
                                            <b>Удобства:</b>
                                            <div class="infra-box infra-box-san">
                                                <ul class="infra-list">
                                                    <li><i class="in-icon icon-apteka"></i><span>Аптека</span></li>
                                                    <li>
                                                        <i class="in-icon icon-magazin"></i><span>Магазин пром. товаров</span>
                                                    </li>
                                                    <li><i class="in-icon icon-solyarij"></i><span>Солярий</span></li>
                                                </ul>
                                                <ul class="infra-list">
                                                    <li><i class="in-icon icon-biblioteka"></i><span>Библиотека</span>
                                                    </li>
                                                    <li><i class="in-icon icon-nastol-tennis"></i><span>Настольный теннис</span>
                                                    </li>
                                                    <li>
                                                        <i class="in-icon icon-trenazhory"></i><span>Тренажерный зал</span>
                                                    </li>
                                                </ul>
                                                <ul class="infra-list">
                                                    <li>
                                                        <i class="in-icon icon-detskaya"></i><span>Детская площадка</span>
                                                    </li>
                                                    <li><i class="in-icon icon-sauna"></i><span>Сауна</span></li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- КОНЕЦ ВЁРСТКИ ДЕТАЛЬНОЙ СТРАНИЦЫ САНАТОРИЯ -->

<!--НАЧАЛО ВЁРСТКИ КНОПКИ СЛАЙДЕРА ДЛЯ ПЕРЕХОДА КО ВСЕМ ФОТОГРАФИЯМ САНАТОРИЯ-->
<div class="engBox-body page-card" itemscope="" itemtype="http://schema.org/Hotel">
    <div class="engBox-center">
        <div id="content">
            <span itemprop="name" style="display:none;">Машук Аква-Терм</span>
            <span itemprop="priceRange" style="display:none;">5580</span>
            <span itemprop="starRating" style="display:none;">5</span>
            <span itemprop="telephone" style="display:none;">88007752604</span>
            <div itemprop="geo" itemscope="" itemtype="http://schema.org/GeoCoordinates">
                <meta itemprop="latitude" content="44.081275051071">
                <meta itemprop="longitude" content="43.091748380951">
            </div>        <a href="#map" id="content-top">Адрес: <span itemprop="address">г. Железноводск, п. Иноземцево, ул. Родниковая, 22</span></a>        <span itemprop="image" style="display:none;">https://putevochka.com/upload/resize_cache/iblock/e5a/830_525_13caaba1070cbf9e466b07e0411acd2b4/e5ad79d51ddb2cadfe6b65e2e42ed531.jpg</span>
            <div id="sync1" class="owl-carousel owl-theme" itemprop="photos" style="opacity: 1; display: block;">                <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 45920px; left: 0px; display: block;"><div class="owl-item" style="width: 820px;"><div class="item" ><img src="/upload/resize_cache/iblock/e5a/830_525_13caaba1070cbf9e466b07e0411acd2b4/e5ad79d51ddb2cadfe6b65e2e42ed531.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div><div class="it-text"><span>смотреть все фотографии</span></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/a1a/830_525_13caaba1070cbf9e466b07e0411acd2b4/a1aa1af35791b5887255662fc6987dba.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/1b5/830_525_13caaba1070cbf9e466b07e0411acd2b4/1b54ff040bf8e36d3b866b014669dc55.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/7f5/760_424_13caaba1070cbf9e466b07e0411acd2b4/7f59dfc1b29d3403982dde1f568e5401.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/920/830_525_13caaba1070cbf9e466b07e0411acd2b4/92041b99ce0455aed058d59020dc4543.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/06a/830_525_13caaba1070cbf9e466b07e0411acd2b4/06afc633197b5c27fcbdb791547daadc.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/4db/830_525_13caaba1070cbf9e466b07e0411acd2b4/4dbd67c79d6aaec368c9086c3dd87907.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/965/830_525_13caaba1070cbf9e466b07e0411acd2b4/9659c6f08c2fa6ea7accb9ce904f72c5.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/332/830_525_13caaba1070cbf9e466b07e0411acd2b4/33289447c12893e1be3a64a49ec6e788.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/8d1/830_525_13caaba1070cbf9e466b07e0411acd2b4/8d14d874062e14f5c418a0b8eb339ac8.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/6af/830_525_13caaba1070cbf9e466b07e0411acd2b4/6af22050ce02933cb9f6b0eb09415d52.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/9b1/830_525_13caaba1070cbf9e466b07e0411acd2b4/9b141cac08c11696a7158234347c8159.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/9c8/830_525_13caaba1070cbf9e466b07e0411acd2b4/9c86e25759ad118fd6d8a9476535a19b.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/c71/830_525_13caaba1070cbf9e466b07e0411acd2b4/c71f99fe5f390366047a916ff3470c1c.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/0ca/830_525_13caaba1070cbf9e466b07e0411acd2b4/0ca66f284ba4f7a23e3ac65a70387a25.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/7d6/830_525_13caaba1070cbf9e466b07e0411acd2b4/7d678d7bdeb03810b3cdd7ed33933e31.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/9f7/830_525_13caaba1070cbf9e466b07e0411acd2b4/9f71272161bdb017b5e7c07f5dc9d9ba.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/507/830_525_13caaba1070cbf9e466b07e0411acd2b4/507750dce9a0f30f4ee81c96b4003230.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/64f/830_525_13caaba1070cbf9e466b07e0411acd2b4/64fac3b1b2029c448d64a4faeb0342c6.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/26b/830_525_13caaba1070cbf9e466b07e0411acd2b4/26b80012ae3eaea99d1279d1a0fc5138.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/0a3/830_525_13caaba1070cbf9e466b07e0411acd2b4/0a344cd25c747061be26299953d2c94e.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/56d/830_525_13caaba1070cbf9e466b07e0411acd2b4/56da243a4642ca9bfca279cdc480f849.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/617/830_525_13caaba1070cbf9e466b07e0411acd2b4/61707e1cc09078680f833a1d4f93ba6b.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/1b2/830_525_13caaba1070cbf9e466b07e0411acd2b4/1b2d6f398cc24cfdf37ef812474e7727.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/72b/830_525_13caaba1070cbf9e466b07e0411acd2b4/72b58ed825411e96c5210c8f9348d34d.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/442/830_525_13caaba1070cbf9e466b07e0411acd2b4/4428880357cfc15f032b590ef454fb9a.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/66a/830_525_13caaba1070cbf9e466b07e0411acd2b4/66a5d27de5293cfc2f8638d3e7a9178b.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 820px;"><div class="item"><img src="/upload/resize_cache/iblock/9e5/830_525_13caaba1070cbf9e466b07e0411acd2b4/9e52263debaf7f2f7577a39307552859.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div></div></div>                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="owl-controls clickable"><div class="owl-buttons"><div class="owl-prev"></div><div class="owl-next"></div></div></div></div>
            <div id="sync2" class="owl-carousel owl-theme" style="opacity: 1; display: block;">                <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 4648px; left: 0px; display: block;"><div class="owl-item synced" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/e5a/830_525_13caaba1070cbf9e466b07e0411acd2b4/e5ad79d51ddb2cadfe6b65e2e42ed531.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/a1a/830_525_13caaba1070cbf9e466b07e0411acd2b4/a1aa1af35791b5887255662fc6987dba.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/1b5/830_525_13caaba1070cbf9e466b07e0411acd2b4/1b54ff040bf8e36d3b866b014669dc55.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/7f5/760_424_13caaba1070cbf9e466b07e0411acd2b4/7f59dfc1b29d3403982dde1f568e5401.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/920/830_525_13caaba1070cbf9e466b07e0411acd2b4/92041b99ce0455aed058d59020dc4543.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/06a/830_525_13caaba1070cbf9e466b07e0411acd2b4/06afc633197b5c27fcbdb791547daadc.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/4db/830_525_13caaba1070cbf9e466b07e0411acd2b4/4dbd67c79d6aaec368c9086c3dd87907.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/965/830_525_13caaba1070cbf9e466b07e0411acd2b4/9659c6f08c2fa6ea7accb9ce904f72c5.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/332/830_525_13caaba1070cbf9e466b07e0411acd2b4/33289447c12893e1be3a64a49ec6e788.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/8d1/830_525_13caaba1070cbf9e466b07e0411acd2b4/8d14d874062e14f5c418a0b8eb339ac8.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/6af/830_525_13caaba1070cbf9e466b07e0411acd2b4/6af22050ce02933cb9f6b0eb09415d52.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/9b1/830_525_13caaba1070cbf9e466b07e0411acd2b4/9b141cac08c11696a7158234347c8159.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/9c8/830_525_13caaba1070cbf9e466b07e0411acd2b4/9c86e25759ad118fd6d8a9476535a19b.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/c71/830_525_13caaba1070cbf9e466b07e0411acd2b4/c71f99fe5f390366047a916ff3470c1c.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/0ca/830_525_13caaba1070cbf9e466b07e0411acd2b4/0ca66f284ba4f7a23e3ac65a70387a25.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/7d6/830_525_13caaba1070cbf9e466b07e0411acd2b4/7d678d7bdeb03810b3cdd7ed33933e31.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/9f7/830_525_13caaba1070cbf9e466b07e0411acd2b4/9f71272161bdb017b5e7c07f5dc9d9ba.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/507/830_525_13caaba1070cbf9e466b07e0411acd2b4/507750dce9a0f30f4ee81c96b4003230.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/64f/830_525_13caaba1070cbf9e466b07e0411acd2b4/64fac3b1b2029c448d64a4faeb0342c6.jpg" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/26b/830_525_13caaba1070cbf9e466b07e0411acd2b4/26b80012ae3eaea99d1279d1a0fc5138.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/0a3/830_525_13caaba1070cbf9e466b07e0411acd2b4/0a344cd25c747061be26299953d2c94e.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/56d/830_525_13caaba1070cbf9e466b07e0411acd2b4/56da243a4642ca9bfca279cdc480f849.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/617/830_525_13caaba1070cbf9e466b07e0411acd2b4/61707e1cc09078680f833a1d4f93ba6b.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/1b2/830_525_13caaba1070cbf9e466b07e0411acd2b4/1b2d6f398cc24cfdf37ef812474e7727.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/72b/830_525_13caaba1070cbf9e466b07e0411acd2b4/72b58ed825411e96c5210c8f9348d34d.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/442/830_525_13caaba1070cbf9e466b07e0411acd2b4/4428880357cfc15f032b590ef454fb9a.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/66a/830_525_13caaba1070cbf9e466b07e0411acd2b4/66a5d27de5293cfc2f8638d3e7a9178b.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div><div class="owl-item" style="width: 83px;"><div class="item"><img src="/upload/resize_cache/iblock/9e5/830_525_13caaba1070cbf9e466b07e0411acd2b4/9e52263debaf7f2f7577a39307552859.JPG" alt="Санаторий Машук Аква-Терм Железноводск" title="Санаторий Машук Аква-Терм Железноводск"></div></div></div></div>                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>

        </div>
    </div>

</div>
<!--КОНЕЦ ВЁРСТКИ КНОПКИ СЛАЙДЕРА ДЛЯ ПЕРЕХОДА КО ВСЕМ ФОТОГРАФИЯМ САНАТОРИЯ-->

<!--НАЧАЛО ВЁРСТКИ ВСЕХ ФОТОГРАФИЙ САНАТОРИЯ (ПЛИТКА)-->
<div id="cron_full">
    <div id="cron" class="engBox-body">
        <div id="cron-right">
            <div class="rating-title">Рейтинг</div>
            <div class="rating" title="3.6">			        <div class="star"><span class="on"></span></div>			        <div class="star"><span class="on"></span></div>			        <div class="star"><span class="on"></span></div>			        <div class="star"><span class="on" style="width:60%"></span></div>			        <div class="star"><span class="of"></span></div>	        </div>
            <div>
                Цена от <b>1720</b> руб<br><span>за человека в сутки</span>
            </div>
        </div>
        <div id="cron-crox">
            <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" itemref="breadcrumb-1"><a itemprop="url" href="/"><span itemprop="title">Главная</span></a></span> -
            <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" itemref="breadcrumb-2" id="breadcrumb-1"><a itemprop="url" href="/sanatorium/"><span itemprop="title">Санатории</span></a></span> -
            <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" itemref="breadcrumb-3" id="breadcrumb-2"><a itemprop="url" href="/sanatorium/essentuki/"><span itemprop="title">Ессентуки</span></a></span> -
            <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" id="breadcrumb-3"><a itemprop="url" class="js-bc-detail" href="/sanatorium/essentuki/tselebnyy-klyuch/" style="display:none;"><span itemprop="title">Целебный ключ</span></a></span>
            <span class="js-bc-sep" style="display:none;"> - </span><span class="js-bc-last">Целебный ключ</span>
        </div>
        <div id="cron-title"><h1>Санаторий Целебный ключ<span class="js-tab-name"></span></h1></div>
    </div>
</div>
<div class="engBox-body page-card" itemscope="" itemtype="http://schema.org/Hotel">
    <div class="engBox-body clearfix">
        <div class="center">
            <div class="images">
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="https://media-cdn.tripadvisor.com/media/photo-w/0a/1f/91/0b/caption.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="https://media-cdn.tripadvisor.com/media/photo-w/0a/1f/91/0b/caption.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg"  class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg"  class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg"  class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
                <div class="img">
                    <a href="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg"  class="border various">
                        <img src="/upload/resize_cache/iblock/0f2/375_1000_1a0e135b89fe9395d0e82863650ebcf5b/0f216567e1b5d96a0960547e859c1197.jpg" alt="1 местный 1 комнатный 1 категория Целебный ключ" title="1 местный 1 комнатный 1 категория Целебный ключ">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--КОНЕЦ ВЁРСТКИ ВСЕХ ФОТОГРАФИЙ САНАТОРИЯ (ПЛИТКА)-->
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>