<?
/** @var Local\Catalog\TimCatalog $component */

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
		<input type="hidden" name="san" value="<?= $product['ID'] ?>" />
        <div class="first-person" style="padding-top: 10px">
            <div class="form-body float-body">
                <div class="float-block">
                    <div class="who-you-are">
                        <div class="number-type"><span>Возраст </span>
                            <div class="list-input calc-form form-body-right">
                                <select name="age[]" class="form-body-right js-age"><?
									foreach ($ages as $code => $age)
									{
										?>
                                        <option value="<?= $code ?>"><?= $age ?></option><?
									}
									?>
                                </select>
                            </div>
                        </div>
                        <div class="number-type">
                            <span>Размещение </span>
                            <div class="list-input calc-form form-body-right">
                                <select name="place[]" class="form-body-right js-place">
                                    <option value="M">На основном месте</option>
                                    <option value="A">На дополнительном месте</option>
                                    <option value="F">Весь номер</option>
                                </select>
                            </div>
                        </div>
                        <div class="number-type first-number-type">
                            <span>Программа </span>
                            <div class="list-input calc-form form-body-right">
                                <select name="programm[]" class="form-body-right js-programm">
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
        <div class="form-title" style="margin-top:10px;">
            <span class="form-title-first" style="font-size:20px; padding-top:10px;">Введите свои данные</span>
            <span class="form-title-second">чтобы узнать стоимость путевки</span>
        </div>
        <div class="form-body">
            <div class="calendar">
                <div class="left-block">
                    Дата заезда<br>
                    <input name="date_on" type="text" class="data-form-input" placeholder="дд.мм.гг" id="datepicker">
                </div>
                <div class="middle-block">
                    <img src="/images/calc/strelka.png">
                </div>
                <div class="right-block">
                    Дата выезда<br>
                    <input name="date_off" type="text" class="data-form-input" placeholder="дд.мм.гг" id="datepicker2">
                </div>
            </div>
        </div>
        <div class="form-body">
            <div class="number-type"><span>Тип номера </span>
                <div class="list-input calc-form form-body-right">
                    <select name="room[]" class="form-body-right js-room">
                        <option value="0">(выберите номер)</option><?
                        foreach ($product['ROOMS'] as $room)
                        {
                            $selected = ($room['ID'] == $component->room['ID']) ? ' selected="selected"' : '';
                            ?>
                            <option value="<?= $room['ID'] ?>"<?= $selected ?>><?= $room['NAME'] ?></option><?
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="number-type">
                <img src="/images/calc/people.png">
                <input class="selector" type="number" id="count-people" min="1" max="6" value="1" />
            </div>
        </div>
        <div class="other-persons"></div>

		<div class="form-footer"><?

			//
			// Тут показываем результат
			//
			?>
            <div class="form-footer-title">
                <small class="js-persons"></small>
                <br>
                <span class="js-sum"></span>
			</div><?

			?>
            <div class="form-footer-body" style="margin: 5px 0 0;">
                <input name="name" class="selector" placeholder="Введите имя" required />
                <br>
                <input name="phone" id="numb-phone" class="selector" placeholder="Введите телефон" required />
            </div>
            <div class="confidentiality">
                <label>
                    <input type="checkbox" onclick="$('#sub_form').toggleClass('unchecked')" required />
                </label>Настоящим подтверждаю, что я ознакомлен и согласен с условиями
                <a href="<?= P_HREF ?>/upload/conf.docx">политики конфиденциальности</a>
            </div>
            <div class="form-submit">
                <button id="calc-submit" type="submit">
                    <div class="form-submit-text" style="padding:18px 5px 18px 35px;">
                        Узнать цену
                    </div>
                </button>
            </div>
        </div>
		<div id="reserve-results" class="okno" style="display:none;"></div>
    </form>
</div>
<script>
    var prices = <?= json_encode($data) ?>;
    var roomsByAge = <?= json_encode($roomsByAge) ?>;
    var placeByAgeRoom = <?= json_encode($placeByAgeRoom) ?>;
    var programmByAgeRoomPlace = <?= json_encode($programmByAgeRoomPlace) ?>;
</script>
