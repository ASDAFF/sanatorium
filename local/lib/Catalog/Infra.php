<?
namespace Local\Catalog;
use Local\System\ExtCache;

/**
 * Class Infra Инфраструктура
 * @package Local\Catalog
 */
class Infra
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Infra/';

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 29;

	/**
	 * Возвращает все элементы инфраструктуры
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
				'ID', 'NAME', 'CODE',
			));
			while ($item = $rsItems->Fetch())
			{
				$return['ITEMS'][$item['ID']] = array(
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
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
	 * Возвращает элемент инфраструктуры по ID элемента
	 * @param $id
	 * @return mixed
	 */
	public static function getById($id) {
		$all = self::getAll();
		return $all['ITEMS'][$id];
	}

    /**
	 * Возвращает ID по коду
	 * @param $code
	 * @return mixed
	 */
	public static function getIdByCode($code) {
		$all = self::getAll();
		return $all['BY_CODE'][$code];
	}

}