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
	const CACHE_PATH = 'Local/Catalog/City/';

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
			86400000,
			false
		);
		if(!$refreshCache && $extCache->initCache()) {
			$return = $extCache->getVars();
		} else {
			$extCache->startDataCache();

			$iblockSection = new \CIBlockSection();
			$rsItems = $iblockSection->GetList(array(
				'SORT' => 'ASC',
				'NAME' => 'ASC',
			), Array(
				'IBLOCK_ID' => Sanatorium::IBLOCK_ID,
			));
			while ($item = $rsItems->Fetch()) {

				$return['ITEMS'][$item['ID']] = array(
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
					'SORT' => $item['SORT'],
					'CODE' => $item['CODE'],
				);
				if ($item['CODE']) {
					$return['BY_CODE'][$item['CODE']] = $item['ID'];
				}

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