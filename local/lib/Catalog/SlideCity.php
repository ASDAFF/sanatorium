<?
namespace Local\Catalog;

use Local\System\ExtCache;

/**
 * Class City Города
 * @package Local\Catalog
 */
class City
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/SlideCity/';

	/**
	 * Возвращает все города
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
                'IBLOCK_ID' => 29,
                'ACTIVE' => 'Y',
            ), false, Array("nTopCount" => 4), array(
                'ID',
                'NAME',
                'IBLOCK_ID',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
            ));
            while ($item = $rsItems->Fetch()) {
                $return[$item['ID']] = array(
                    'ID' => $item['ID'],
                    'NAME' => $item['NAME'],
                    'PREVIEW_PICTURE' => \CFile::GetPath($item['PREVIEW_PICTURE']),
                    'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
                );
            }

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * Возвращает город по ID
	 * @param $id
	 */
	public static function getById($id)
	{
		$all = self::getAll();
		return $all['ITEMS'][$id];
	}

	/**
	 * Возвращает ID города по коду
	 * @param $code
	 */
	public static function getIdByCode($code)
	{
		$all = self::getAll();
		return $all['BY_CODE'][$code];
	}

	/**
	 * Возвращает группу для панели фильтров
	 * @return array
	 */
	public static function getGroup()
	{
		$return = array();

		$all = self::getAll();
		foreach ($all['ITEMS'] as $item)
			$return[$item['CODE']] = array(
				'ID' => $item['ID'],
				'CODE' => 'CITY',
				'NAME' => $item['NAME'],
			);

		return $return;
	}
}