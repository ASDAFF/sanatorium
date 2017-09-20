te<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?><script>
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
    .calculator div{
        font-size: 12px;
    }
    .error{
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
    .form-submit{
        cursor: pointer;
    }
    .form-submit button {
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
        padding-left: 35px;
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
    .first-number-type{
        padding-bottom: 5px;
    }
    .new-float-block{
        padding-bottom: 3px;
    }
    .list-input-new{
        margin-top: 4px;
    }
    .unchecked{
    pointer-events: none;
    cursor: none;
    }
    .confidentiality{
        font-size: 12px;
    }
.confidentiality input{
-webkit-appearance : checkbox;
    }
.confidentiality a{
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
                        <a class="people-delete" href="#">Удалить<img src="/images/calc/people.png"><img src="/images/calc/minus.png"></a>
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
                        <a class="people-delete" href="#">Удалить<img src="/images/calc/people.png"><img src="/images/calc/minus.png"></a>
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
                        <a class="people-delete" href="#">Удалить<img src="/images/calc/people.png"><img src="/images/calc/minus.png"></a>
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
                        <a class="people-delete" href="#">Удалить<img src="/images/calc/people.png"><img src="/images/calc/minus.png"></a>
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
                        <a class="people-delete" href="#">Удалить<img src="/images/calc/people.png"><img src="/images/calc/minus.png"></a>
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
            <div class="form-submit">
                <button type="submit" id="sub_form" class="unchecked">
                    <div class="form-submit-text">
                        Забронировать отдых<br>
                        и получить скидку
                    </div>
                </button>
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
</script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>