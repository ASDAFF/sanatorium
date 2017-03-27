<?
namespace Local\Catalog;

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

		$iblockElement = new \CIBlockElement();
		$rsItems = $iblockElement->GetList(array('SORT' => 'ASC'), array(
			'IBLOCK_ID' => self::IBLOCK_ID,
			'PROPERTY_SANATORIUM' => $sanatoriumId,
			'ACTIVE' => 'Y',
		), false, false, array(
			'ID',
			'NAME',
			'IBLOCK_ID',
			'PROPERTY_PRICE',
		));
		while ($item = $rsItems->Fetch()) {
			$return[$item['ID']] = array(
				'ID' => $item['ID'],
				'NAME' => $item['NAME'],
				'PRICE' => intval($item['PROPERTY_PRICE_VALUE']),
			);
		}

		return $return;
	}

	/**
	 * обработчик изменения элемента - нужно обновить цену санатория, если изменили номер
	 * @param $id
	 */
	public static function onUpdateRoom($id) {
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
	public static function onDeleteRoom($id) {
		$rsProduct = \CIBlockElement::GetProperty(Room::IBLOCK_ID, $id, array(),
			Array('ID' => self::SANATORIUM_PROP_ID)
		);
		if ($product = $rsProduct->Fetch())
			Sanatorium::correctPrice($product['VALUE'], $id);
	}

}