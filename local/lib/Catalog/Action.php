<?
namespace Local\Catalog;
use Local\System\ExtCache;


/**
 * Class Action Акции
 * @package Local\Catalog
 */
class Action
{
	/**
	 * Количество отзывов на странице
	 */
	const PAGE_SIZE = 12;

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 9;

	/**
	 * Время кеширования
	 */
	const CACHE_TIME = 864000;

	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Action/';

	/**
	 * Возвращает отзывы
	 * @param $cityId
	 * @param $page
	 * @param $size
	 * @param bool $refreshCache
	 * @return array|mixed
	 */
	public static function getList($cityId, $page, $size = 0, $refreshCache = false)
	{
		$return = array();

		$cityId = intval($cityId);

		$page = intval($page);
		if ($page < 1)
			$page = 1;

		if (!$size)
			$size = self::PAGE_SIZE;

		$extCache = new ExtCache(
			array(
				__FUNCTION__,
				$cityId,
				$page,
				$size,
			),
			static::CACHE_PATH . __FUNCTION__ . '/',
			static::CACHE_TIME
		);
		if(!$refreshCache && $extCache->initCache()) {
			$return = $extCache->getVars();
		} else {
			$extCache->startDataCache();

			$nav = array(
				'nPageSize' => $size,
				'iNumPage' => $page,
			);

			$filter = array(
				'IBLOCK_ID' => self::IBLOCK_ID,
				'ACTIVE' => 'Y',
			);
			if ($cityId)
				$filter['PROPERTY_SANATORIUM_CITY'] = $cityId;

			$iblockElement = new \CIBlockElement();
			$rsItems = $iblockElement->GetList(array(
				'SORT' => 'ASC',
				'ACTIVE_FROM' => 'ASC',
			), $filter, false, $nav, array(
				'ID',
				'NAME',
				'PREVIEW_TEXT',
				'ACTIVE_FROM',
				'ACTIVE_TO',
				'PROPERTY_SANATORIUM',
			));
			while ($item = $rsItems->Fetch())
			{
				$return['ITEMS'][] = array(
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
                    'TEXT' => $item['PREVIEW_TEXT'],
                    'ACTIVE_FROM' => ConvertDateTime($item['ACTIVE_FROM'], 'DD.MM.YYYY'),
                    'ACTIVE_TO' => ConvertDateTime($item['ACTIVE_TO'], 'DD.MM.YYYY'),
                    'SANATORIUM' => $item['PROPERTY_SANATORIUM_VALUE'],
				);
			}
			$return['PAGINATION'] = $rsItems->GetPageNavStringEx($navComponentObject, '', 'reviews');

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * Возвращает акции санатория
	 * @param $sanatoriumId
	 * @param bool $refreshCache
	 * @return array|\CIBlockResult|int|mixed
	 */
	public static function getBySanatorium($sanatoriumId, $refreshCache = false)
	{
		$return = array();

		$sanatoriumId = intval($sanatoriumId);
		if (!$sanatoriumId)
			return $return;

		$extCache = new ExtCache(
			array(
				__FUNCTION__,
				$sanatoriumId,
			),
			static::CACHE_PATH . __FUNCTION__ . '/',
			static::CACHE_TIME
		);
		if(!$refreshCache && $extCache->initCache()) {
			$return = $extCache->getVars();
		} else {
			$extCache->startDataCache();

			$iblockElement = new \CIBlockElement();
			$rsItems = $iblockElement->GetList(array(
				'SORT' => 'ASC',
				'ACTIVE_FROM' => 'ASC',
			), array(
				'IBLOCK_ID' => self::IBLOCK_ID,
				'ACTIVE' => 'Y',
				'PROPERTY_SANATORIUM' => $sanatoriumId,
			), false, false, array(
				'ID',
				'NAME',
				'PREVIEW_TEXT',
				'ACTIVE_FROM',
				'ACTIVE_TO',
				'PROPERTY_SANATORIUM',
			));
			while ($item = $rsItems->Fetch())
			{
				$return[] = array(
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
					'TEXT' => $item['PREVIEW_TEXT'],
					'ACTIVE_FROM' => ConvertDateTime($item['ACTIVE_FROM'], 'DD.MM.YYYY'),
					'ACTIVE_TO' => ConvertDateTime($item['ACTIVE_TO'], 'DD.MM.YYYY'),
				);
			}

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * обработчик изменения элемента - нужно обновить город санатория
	 * @param $id
	 */
	public static function onUpdate($id)
	{
		$iblockElement = new \CIBlockElement();
		$rsItems = $iblockElement->GetList(array('SORT' => 'ASC'), array(
			'IBLOCK_ID' => self::IBLOCK_ID,
			'ID' => $id
		), false, false, array(
			'ID',
			'PROPERTY_SANATORIUM',
			'PROPERTY_SANATORIUM_CITY',
		));
		if ($item = $rsItems->Fetch())
		{
			$sanId = $item['PROPERTY_SANATORIUM_VALUE'];
			$cityId = 0;
			if ($sanId)
			{
				$san = Sanatorium::getSimpleById($sanId);
				$cityId = intval($san['CITY']);
			}

			if ($cityId != $item['PROPERTY_SANATORIUM_CITY_VALUE'])
			{
				$iblockElement->SetPropertyValuesEx($id, self::IBLOCK_ID, array(
					'SANATORIUM_CITY' => $cityId,
				));
			}

		}
	}
}

