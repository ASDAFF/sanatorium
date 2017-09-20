<?
$ages = ['Взрослый'];
$roomsByAge = [];
$placeByAgeRoom = [];
$programmByAgeRoomPlace = [];
$data = '';
$dateTo = 0;
foreach ($product['ROOMS'] as $room)
	if ($room['PRICES'])
	{
		$data[$room['ID']] = $room['PRICES'];
        foreach ($room['PRICES'] as $prog => $dates)
        {
            foreach ($dates as $date => $ar)
            {
                $dparts = explode('-', $date);
                $to = $dparts[1];
                $tsTo = MakeTimeStamp($to);
                if ($tsTo > $dateTo)
					$dateTo = $tsTo;
                foreach ($ar as $code => $price)
                {
                    $place = substr($code, 0, 1);
                    $age = substr($code, 1);
                    if ($age)
                    {
                        $parts = explode('-', $age);
						$ages[$age] = 'Ребёнок от ' . $parts[0] . ' до ' . $parts[1] . ' лет';
                    }
                    else
                        $age = 0;
					$roomsByAge[$age][$room['ID']] = true;
					$placeByAgeRoom[$age.'|'.$room['ID']][$place] = true;
					$placeByAgeRoom[$age.'|0'][$place] = true;
					$programmByAgeRoomPlace[$age.'|'.$room['ID'].'|'.$place][$prog] = true;
					$programmByAgeRoomPlace[$age.'|0|'.$place][$prog] = true;
                }
            }
        }
	}

?>
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
        <div class="first-person">
            <div class="form-body float-body">
                <div class="float-block">
                    <div class="who-you-are">
                        <div class="number-type"><span>Возраст </span>
                            <div class="list-input calc-form form-body-right">
                                <select class="form-body-right js-age"><?
									foreach ($ages as $code => $age)
									{
										?>
                                        <option value="<?= $code ?>"><?= $age ?></option><?
									}
									?>
                                </select>
                            </div>
                        </div>
                        <div class="number-type"><span>Тип номера </span>
                            <div class="list-input calc-form form-body-right">
                                <select class="form-body-right js-room">
                                    <option value="0">(выберите номер)</option><?
									foreach ($product['ROOMS'] as $room)
									{
										?>
                                        <option value="<?= $room['ID'] ?>"><?= $room['NAME'] ?></option><?
									}
									?>
                                </select>
                            </div>
                        </div>
                        <div class="number-type">
                            <span>Размещение </span>
                            <div class="list-input calc-form form-body-right">
                                <select class="form-body-right js-place">
                                    <option value="M">На основном месте</option>
                                    <option value="A">На дополнительном месте</option>
                                    <option value="F">Весь номер</option>
                                </select>
                            </div>
                        </div>
                        <div class="number-type first-number-type">
                            <span>Программа </span>
                            <div class="list-input calc-form form-body-right">
                                <select class="form-body-right js-programm">
                                    <option value="0">(выберите программу)</option><?
									foreach ($product['PROGRAMMS'] as $pr)
									{
										?>
                                        <option value="<?= $pr['ID'] ?>"><?= $pr['NAME'] ?></option><?
									}
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="delete-user">
                            <span class="people-delete"><span>Удалить</span><img src="/images/calc/people.png"><img
                                        src="/images/calc/minus.png"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="number-type">
                <img src="/images/calc/people.png">
                <input class="selector" type="number" id="count-people" min="1" max="6" value="1" />
            </div>
        </div>
        <div class="other-persons"></div>
        <div class="form-footer">
            <div class="form-footer-title">
                <small class="js-persons"></small>
                <br>
                <span class="js-sum"></span>
            </div>
            <div class="form-footer-body">
                <input class="selector" placeholder="Введите имя" required />
                <br>
                <input id="numb-phone" class="selector" placeholder="Введите телефон" required />
            </div>
            <div class="confidentiality">
                <label>
                    <input type="checkbox" onclick="$('#sub_form').toggleClass('unchecked')" required />
                </label>Настоящим подтверждаю, что я ознакомлен и согласен с условиями
                <a href="/uploads/conf.doc">политики конфиденциальности</a>
            </div>
            <div class="form-submit">
                <button type="submit">
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
    var prices = <?= json_encode($data) ?>;
    var roomsByAge = <?= json_encode($roomsByAge) ?>;
    var placeByAgeRoom = <?= json_encode($placeByAgeRoom) ?>;
    var programmByAgeRoomPlace = <?= json_encode($programmByAgeRoomPlace) ?>;
</script>
