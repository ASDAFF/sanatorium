<?
namespace Local\Catalog;
use Local\System\ExtCache;

/**
 * Class Room Номера санаториев
 * @package Local\Catalog
 */
class Room
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Room/';

	/**
	 * ID инфоблока с номерами
	 */
	const IBLOCK_ID = 26;

	/**
	 * ID инфоблока с заявками
	 */
	const RESERVE_IBLOCK_ID = 20;

	/**
	 * ID свойства с санаторием-родителем
	 */
	const SANATORIUM_PROP_ID = 196;

	/**
	 * Возвращает номера санатория
	 * @param $sanatoriumId
	 * @return array|mixed
	 */
	public static function getBySanatorium($sanatoriumId)
	{
		$return = array();

		$sanatoriumId = intval($sanatoriumId);
		if (!$sanatoriumId)
			return $return;

		$select = array(
			'ID', 'NAME', 'IBLOCK_ID', 'PREVIEW_PICTURE',
			'PROPERTY_MORE_PHOTO',
			'PROPERTY_PRICES',
			'PROPERTY_PRICE',
			'PROPERTY_PRICE_FULL',
			'PROPERTY_PRICE_ADD',
			'PROPERTY_PRICE_ADD_CHILD',
			'PROPERTY_PRICE_CHILD',
			'PROPERTY_ROOM_SIZE',
			'PROPERTY_DOUBLE_BED',
			'PROPERTY_SINGLE_BED',
			'PROPERTY_MAIN_PLACES',
			'PROPERTY_ADD_PLACES',
		);
		$options = self::getOptions();
		foreach ($options as $k => $v)
			$select[] = 'PROPERTY_' . $k;

		$iblockElement = new \CIBlockElement();
		$rsItems = $iblockElement->GetList(array('SORT' => 'ASC'), array(
			'IBLOCK_ID' => self::IBLOCK_ID,
			'PROPERTY_SANATORIUM' => $sanatoriumId,
			'ACTIVE' => 'Y',
		), false, false, $select);
		while ($item = $rsItems->Fetch())
		{
			$opts = array();
			foreach ($options as $k => $v)
				if ($item['PROPERTY_' . $k. '_VALUE'])
					$opts[$k] = $v;
			$return[$item['ID']] = array(
				'ID' => $item['ID'],
				'NAME' => $item['NAME'],
				'PREVIEW_PICTURE' => $item['PREVIEW_PICTURE'],
				'PHOTO' => $item['PROPERTY_MORE_PHOTO_VALUE'],
				'PRICES' => json_decode($item['PROPERTY_PRICES_VALUE']['TEXT'], true),
				'PRICE' => intval($item['PROPERTY_PRICE_VALUE']),
				'PRICE_ADD' => intval($item['PROPERTY_PRICE_ADD_VALUE']),
				'PRICE_CHILD' => intval($item['PROPERTY_PRICE_CHILD_VALUE']),
				'PRICE_ADD_CHILD' => intval($item['PROPERTY_PRICE_ADD_CHILD_VALUE']),
				'PRICE_FULL' => intval($item['PROPERTY_PRICE_FULL_VALUE']),
				'SIZE' => $item['PROPERTY_ROOM_SIZE_VALUE'],
				'DOUBLE_BED' => intval($item['PROPERTY_DOUBLE_BED_VALUE']),
				'SINGLE_BED' => intval($item['PROPERTY_SINGLE_BED_VALUE']),
				'MAIN_PLACES' => intval($item['PROPERTY_MAIN_PLACES_VALUE']),
				'ADD_PLACES' => intval($item['PROPERTY_ADD_PLACES_VALUE']),
			    'OPTIONS' => $opts,
			);
		}

		return $return;
	}

	/**
	 * Возвращает номер по ID
	 * @param $id
	 * @return array
	 */
	public static function getById($id)
	{
		$return = array();

		$iblockElement = new \CIBlockElement();
		$rsItems = $iblockElement->GetList(array(), array(
			'IBLOCK_ID' => self::IBLOCK_ID,
			'ACTIVE' => 'Y',
		    'ID' => $id,
		), false, false, array(
			'ID',
			'NAME',
			'PROPERTY_SANATORIUM',
		));
		if ($item = $rsItems->Fetch())
		{
			$return = array(
				'ID' => $item['ID'],
				'NAME' => $item['NAME'],
				'SANATORIUM' => intval($item['PROPERTY_SANATORIUM_VALUE']),
			);
		}

		return $return;
	}

	/**
	 * обработчик изменения элемента - нужно обновить цену санатория, если изменили номер
	 * @param $id
	 */
	public static function onUpdateRoom($id)
	{
		$rsProduct = \CIBlockElement::GetProperty(Room::IBLOCK_ID, $id, array(),
			Array('ID' => self::SANATORIUM_PROP_ID)
		);
		if ($product = $rsProduct->Fetch())
			Sanatorium::correctPrice($product['VALUE']);
	}

	/**
	 * обработчик удаления элемента - нужно обновить цену санатория, если удалили номер
	 * @param $id
	 */
	public static function onDeleteRoom($id)
	{
		$rsProduct = \CIBlockElement::GetProperty(Room::IBLOCK_ID, $id, array(),
			Array('ID' => self::SANATORIUM_PROP_ID)
		);
		if ($product = $rsProduct->Fetch())
			Sanatorium::correctPrice($product['VALUE'], $id);
	}

	/**
	 * Выводит номер в карточке санатория
	 * @param $room
	 * @param $sanatoriumName
	 */
	public static function printRoom($room, $sanatoriumName)
	{
		$file = new \CFile();
        $arWaterMark = array(
            array(
                'name' => 'watermark',
                'position' => 'center',
                'size' => 'real',
                'file' => $_SERVER['DOCUMENT_ROOT'] . '/images/watermarks/little.png',
            ),
        );
		$img = $file->ResizeImageGet(
			$room['PREVIEW_PICTURE'],
			array(
				'width' => 375,
				'height' => 1000
			),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true,
            $arWaterMark
		);
		$alt = $room['NAME'] . ' ' . $sanatoriumName;
		?>
		<div class="el-nomer">
			<div class="item">
				<div class="img">
					<a href="#room<?= $room['ID'] ?>" class="border various">
						<img src="<?= $img['src'] ?>" alt="<?= $alt ?>" title="<?= $alt ?>" />
					</a>
				</div>
				<div class="text">
					<div class="el-nomer-head"><a href="#room<?= $room['ID'] ?>" class="title various"><?= $room['NAME'] ?></a></div>
					<b>Площадь:</b> <?= $room['SIZE'] ?> м2 <br><br><?

					if ($room['DOUBLE_BED'] || $room['SINGLE_BED'])
					{
						?>
						<b>Кроватей: </b><?
						if ($room['DOUBLE_BED'])
						{
							?>Двуспальных: <?= $room['DOUBLE_BED'] ?><?
						}
						if ($room['SINGLE_BED'])
						{
							if ($room['DOUBLE_BED'])
								echo ', ';
							?>Односпальных: <?= $room['SINGLE_BED'] ?><?
						}
						?>
						<br><br><?
					}

					?>
					<b>В стоимость включено:</b> проживание, питание, лечение.<br><br><?

					?>
				</div>
				<div class="inf">
					<div class="money">
						от <b><?= $room['PRICE'] ?></b> руб
					</div>
					<span>за номер в сутки</span>
					<a href="#room<?= $room['ID'] ?>" class="btn various">Подробнее</a>
				</div><?

				//
				// Попап окно номера
				//
				?>
				<div id="room<?= $room['ID'] ?>" class="okno" style="display:none;">
					<div class="title"><?= $room['NAME'] ?></div>
					<div class="el-nomer-popap">
						<div class="left">
							<div class="slider">
								<div class="popap-slider"><?

									$photos = $room['PHOTO'];
									if ($room['PREVIEW_PICTURE'])
										array_unshift($photos, $room['PREVIEW_PICTURE']);

                                    $arWaterMark = array(
                                        array(
                                            'name' => 'watermark',
                                            'position' => 'center',
                                            'size' => 'real',
                                            'file' => $_SERVER['DOCUMENT_ROOT'] . '/images/watermarks/middle.png',
                                        ),
                                    );

									foreach ($photos as $id)
									{
										$img = $file->ResizeImageGet(
											$id,
											array(
												'width' => 10000,
												'height' => 400
											),
											BX_RESIZE_IMAGE_PROPORTIONAL,
											true,
                                            $arWaterMark
										);
										?>
										<div class="item">
											<img src="<?= $img['src'] ?>" alt="<?= $alt ?>" title="<?= $alt ?>" />
										</div><?
									}

									?>
								</div>
							</div>
							<div style="text-align: center">
								<input id="popup-bron-btn" type="button" data-id="<?= $room['ID'] ?>"
								       class="btn-okno ui-widget ui-controlgroup-item ui-button ui-corner-right"
								       value="ЗАБРОНИРОВАТЬ" role="button">
							</div>
							<div class="info-bottom">
								<div class="right">
									<div class="text">
										<b>Площадь:</b> <?= $room['SIZE'] ?> м2 <br><?

										if ($room['DOUBLE_BED'] || $room['SINGLE_BED'])
										{
											?>
											<b>Кроватей: </b><?
											if ($room['DOUBLE_BED'])
											{
												?>Двуспальных: <?= $room['DOUBLE_BED'] ?><?
											}
											if ($room['SINGLE_BED'])
											{
												if ($room['DOUBLE_BED'])
													echo ', ';
												?>Односпальных: <?= $room['SINGLE_BED'] ?><?
											}
											?>
											<br><br><?
										}
										?>
										<b>В стоимость включено:</b><br>проживание, питание, лечение.<br><br><?

										?>
										<b>Вместимость номера:</b><br>
										<ul>
											<li><span class="first">основных мест - <?= $room['MAIN_PLACES'] ?> шт</span></li><?
											if ($room['ADD_PLACES'])
											{
												?>
												<li><span class="first">дополнительных - <?= $room['ADD_PLACES'] ?> шт</span></li><?
											}
											?>
										</ul><br>
									</div><?

									if ($room['OPTIONS'])
									{
										?>
										<div class="icon">
											<b>Удобства:</b>
											<ul class="con-list"><?
												foreach ($room['OPTIONS'] as $k => $v)
												{
													?>
													<li class="con-item"><span class="icon-boon icon-<?= $k ?>"></span><span><?= $v?></span></li><?
												}
												?>
											</ul>
										</div><?
									}

									?>
								</div>
								<div class="inf">
									<div class="price-start"><span class="txt">Цена за номер в сутки от</span><span
											class="num"><?= $room['PRICE'] ?>р</span></div>
									<i class="price-start-details">(в стоимость проживания входит
										лечение по общетерапевтической путевке)</i>
									<div class="tit">Стоимость основных мест:</div>
									<ul>
										<li>
											<span class="first">основное взрослое (с подселением)</span>
											<span class="second"><?= $room['PRICE'] ?>р</span>
										</li>
										<li>
											<span class="first">детское</span><?
											if ($room['PRICE_CHILD'])
											{
												?>
												<span class="second"><?= $room['PRICE_CHILD'] ?>р</span><?
											}
											?>
										</li>
										<li>
											<span class="first">размещение одним (выкуп номера)</span><?
											if ($room['PRICE_FULL'])
											{
												?>
												<span class="second"><?= $room['PRICE_FULL'] ?>р</span><?
											}
											?>
										</li>
									</ul>
									<div class="tit">Стоимость дополнительных мест:</div>
									<ul>
										<li>
											<span class="first">взрослое</span><?
											if ($room['PRICE_ADD'])
											{
												?>
												<span class="second"><?= $room['PRICE_ADD'] ?>р</span><?
											}
											?>
										</li>
										<li>
											<span class="first">детское</span><?
											if ($room['PRICE_ADD_CHILD'])
											{
												?>
												<span class="second"><?= $room['PRICE_ADD_CHILD'] ?>р</span><?
											}
											?>
										</li>

									</ul>
								</div>


							</div>
						</div>
					</div>
				</div><?

				?>
			</div>
		</div><?
	}

	/**
	 * Возвращает свойства-галочки номера
	 * @param bool $refreshCache
	 * @return array|mixed
	 */
	public static function getOptions($refreshCache = false)
	{
		$return = array();

		$extCache = new ExtCache(
			array(
				__FUNCTION__,
			),
			static::CACHE_PATH . __FUNCTION__ . '/',
			86400000
		);
		if(!$refreshCache && $extCache->initCache()) {
			$return = $extCache->getVars();
		} else {
			$extCache->startDataCache();

			$iblockProperty = new \CIBlockProperty();
			$rsProps = $iblockProperty->GetList(array(), array(
				'IBLOCK_ID' => self::IBLOCK_ID,
			    'USER_TYPE' => 'YesNo',
			));
			while ($item = $rsProps->Fetch())
				$return[$item['CODE']] = $item['NAME'];

			$extCache->endDataCache($return);
		}

		return $return;
	}

    /**
     * @return string (json encoded)
     */
	public static function reserve()
	{
	    $id = 0;

		$name = trim(htmlspecialchars($_POST['name']));
		$phone = trim(htmlspecialchars($_POST['phone']));
		$roomId = intval($_POST['room']);
		$adults = intval($_POST['adults']);
		$child = intval($_POST['child']);
		$date_on = trim(htmlspecialchars($_POST['date_on']));
		$date_off = trim(htmlspecialchars($_POST['date_off']));
		$transfer = $_POST['transfer'] == 'on';

        $errors = array();

        //check fields
        if(empty($name))
            $errors[] = 'Введите имя';
        if(empty($phone))
            $errors[] = 'Введите номер телефона';

        $sanName = $roomName = '';

		if (empty($errors))
		{
			$props = array(
				'PHONE' => $phone,
				'ADULTS' => $adults,
				'CHILD' => $child,
				'FROM' => $date_on,
				'TO' => $date_off,
				'TRANSFER' => $transfer ? 1 : 0,
			);
			$roomName = '';
			$sanName = '';
			if ($roomId)
			{
				$room = self::getById($roomId);
				if ($room)
				{
					$props['ROOM'] = $roomId;
					$props['SANATORIUM'] = $room['SANATORIUM'];
					$san = Sanatorium::getSimpleById($room['SANATORIUM']);
					$sanName = $san['NAME'] . ' [' . $room['SANATORIUM'] . ']';
					$roomName = $room['NAME'] . ' [' . $roomId . ']';
				}
			}

			$el = new \CIBlockElement();
			$fields = array(
				'IBLOCK_ID' => self::RESERVE_IBLOCK_ID,
				'NAME' => $name,
				'PROPERTY_VALUES' => $props,
			);
			$id = $el->Add($fields);
			if ($id)
			{
				$eventFields = array(
					'NAME' => $name,
					'PHONE' => $phone,
					'SANATORIUM' => $sanName,
					'ROOM' => $roomName,
					'ADULTS' => $adults,
					'CHILD' => $child,
					'FROM' => $date_on,
					'TO' => $date_off,
					'TRANSFER' => $transfer ? 'да' : 'нет',
				);
				//\CEvent::Send('ASPRO_SEND_FORM_ADMIN_20', 's1', $eventFields);
				\CEvent::Send('BOOK_ROOM', 's1', $eventFields);
			}
            else
                $errors[] = 'Ошибка добавления заявки. Свяжитесь с администрацией';
		}

        $gtm = new \WM\GTMFormSubmit();

        if(empty($errors))
        {
            //u-an intergration
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL => 'https://api.u-on.ru/259if83aN3CxKdHAA6Ow/lead/create.json',
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS =>
                    'source=' . urlencode('Бронирование номера') .
                    '&date_from=' . urlencode($date_on) .
                    '&date_to=' . urlencode($date_off) .
                    '&u_name=' . urlencode($name) .
                    '&u_phone=' . urlencode($phone) .
                    //'&u_email=' . urlencode('test@email.ru') .
                    '&note=' . sprintf(
                        "Санаторий: %s\nНомер: %s\nКол-во взрослых: %s\nКол-во детей: %s\nБесплатный трансфер: %s",
                        $sanName,
                        $roomName,
                        $adults,
                        $child,
                        ($transfer ? 'да' : 'нет')
                    )
            ));
            curl_exec($curl);
            curl_close($curl);

            return $gtm->getJson(array(
                'gtmObject' => $gtm->setEvent()->setElementId('formx')->setElements(array($name, $phone))->getResult(),
                'id' => $id,
                'message' => 'Спасибо. Мы с Вами свяжемся',
                'success' => true,
            ));
        }

        return $gtm->getJson(array(
            'errors' => $errors,
            'id' => $id,
            'success' => false,
        ));
	}

}