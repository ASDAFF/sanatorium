<?
namespace Local\Catalog;
use Local\System\ExtCache;


/**
 * Class Reviews Отзывы
 * @package Local\Catalog
 */
class Reviews
{
	const IBLOCK_ID = 30;
	const CACHE_TIME = 86400;
    const EL_COUNT = 3;
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Reviews/';

	/**
	 * Возвращает все санатории со свойствами, которые нужны для построения панели фильтров
	 * @param bool|false $refreshCache
	 * @return array
	 */

	public static function getAll($page, $refreshCache = false)
	{
	    if ($page == "") {
	        $page = 1;
        }
		$return = array();

		$extCache = new ExtCache(
			array(
				__FUNCTION__,
			),
			static::CACHE_PATH . __FUNCTION__ . '/',
			static::CACHE_TIME
		);
		if(!$refreshCache && $extCache->initCache()) {
			$return = $extCache->getVars();
		} else {
			$extCache->startDataCache();

			$select = array(
				'ID',
				'NAME',
                'PREVIEW_TEXT',
                'PROPERTY_SAN_NAME',
                'PROPERTY_CITY',
                'PROPERTY_MARK',
                'PROPERTY_DATE',
			);
			$flagsSelect = Flags::getForSelect();
			$select = array_merge($select, $flagsSelect);
			$codes = Flags::getCodes();

			$iblockElement = new \CIBlockElement();
            $res_count = $iblockElement->GetList(Array(), Array("IBLOCK_ID"=>self::IBLOCK_ID, "ACTIVE"=>"Y"), Array(), false, Array());
            $page_count = $res_count/self::EL_COUNT;
			$rsItems = $iblockElement->GetList(array(), array(
				'IBLOCK_ID' => self::IBLOCK_ID,
				'ACTIVE' => 'Y',
			), false, array("nPageSize"=>self::EL_COUNT, "iNumPage" => $page), $select);
			while ($item = $rsItems->Fetch())
			{

				$product = array(
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
                    'TEXT' => $item['PREVIEW_TEXT'],
                    'SAN_NAME' => $item['PROPERTY_SAN_NAME_VALUE'],
                    'CITY' => $item['PROPERTY_CITY_VALUE'],
                    'MARK' => $item['PROPERTY_MARK_VALUE'],
                    'DATE' => $item['PROPERTY_DATE_VALUE'],
                    'PAGE' => ceil($page_count),
				);

				$return[$item['ID']] = $product;
			}

			$extCache->endDataCache($return);
		}

		return $return;
	}
}

