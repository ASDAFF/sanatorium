<?
namespace Local\Common;

use Local\System\ExtCache;

/**
 * Class Banners Баннеры
 * @package Local\Common
 */
class Banners
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Common/Banners/';

	/**
	 * ID инофблока
	 */
	const IBLOCK_ID = 2;

	/**
	 * Возвращает акции
	 * @param bool|false $refreshCache
	 * @return array
	 */
	public static function getAll($refreshCache = false)
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

            $iblockElement = new \CIBlockElement();
            $rsItems = $iblockElement->GetList(array('SORT' => 'ASC'), array(
                'IBLOCK_ID' => self::IBLOCK_ID,
                'ACTIVE' => 'Y',
            ), false, false, array(
                'ID',
                'NAME',
                'PREVIEW_PICTURE',
            ));
            $file = new \CFile();
            while ($item = $rsItems->Fetch()) {
                $return[] = array(
                    'ID' => $item['ID'],
                    'NAME' => $item['NAME'],
                    'PICTURE' => $file->GetPath($item['PREVIEW_PICTURE']),
                );
            }

			$extCache->endDataCache($return);
		}

		return $return;
	}
}