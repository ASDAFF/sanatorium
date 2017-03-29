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
	 * Выводин номер в карточке санатория
	 * @param $room
	 */
	public static function printRoom($room)
	{
		$file = new \CFile();
		$pic = $file->GetPath($room['PREVIEW_PICTURE']);
		?>
		<div class="el-nomer">
			<div class="item">
				<div class="img">
					<a href="#room<?= $room['ID'] ?>" class="border various">
						<img src="<?= $pic ?>" />
					</a>
				</div>
				<div class="text">
					<a href="#room<?= $room['ID'] ?>" class="title various"><?= $room['NAME'] ?></a><br>
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
								<script>
								$(document).ready(function() {
									$(".popap-slider").owlCarousel({
										navigation: true,
										singleItem: true,
										navigationText: ["<img src='/local/templates/san/images/left.png'>", "<img src='/local/templates/san/images/right.png'>"],
										transitionStyle: "fade"
									});
								});
								</script>
								<div class="popap-slider"><?

									$photos = $room['PHOTO'];
									if ($room['PREVIEW_PICTURE'])
										array_unshift($photos, $room['PREVIEW_PICTURE']);

									foreach ($photos as $id)
									{
										?>
										<div class="item">
											<img src="<?= $file->GetPath($id) ?>"/>
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

}