<?

namespace Local\System;
use Local\Catalog\Profiles;
use Local\Catalog\Room;
use Local\Catalog\Sanatorium;
use Local\Sale\Package;
use Local\Sale\Postals;
use Local\Utils\Abandoned;

/**
 * Class Handlers Обработчики событий
 * @package Local\Utils
 */
class Handlers
{
	/**
	 * Добавление обработчиков
	 */
	public static function addEventHandlers() {
		static $added = false;
		if (!$added) {
			$added = true;
			AddEventHandler('iblock', 'OnBeforeIBlockElementDelete',
				array(__NAMESPACE__ . '\Handlers', 'beforeIBlockElementDelete'));
			AddEventHandler('iblock', 'OnBeforeIBlockElementUpdate',
				array(__NAMESPACE__ . '\Handlers', 'beforeIBlockElementUpdate'));
			AddEventHandler('iblock', 'OnIBlockPropertyBuildList',
				array(__NAMESPACE__ . '\Handlers', 'iBlockPropertyBuildList'));
			AddEventHandler('main', 'OnBeforeProlog',
				array(__NAMESPACE__ . '\Handlers', 'beforeProlog'));
			AddEventHandler('iblock', 'OnAfterIBlockElementAdd',
				array(__NAMESPACE__ . '\Handlers', 'elementAdd'));
			AddEventHandler('iblock', 'OnAfterIBlockElementUpdate',
				array(__NAMESPACE__ . '\Handlers', 'elementUpdate'));
			AddEventHandler('iblock', 'OnIBlockElementDelete',
				array(__NAMESPACE__ . '\Handlers', 'elementDelete'));
			AddEventHandler('search', 'BeforeIndex',
				array(__NAMESPACE__ . '\Handlers', 'beforeSearchIndex'));
		}
	}

	/**
	 * Добавление пользовательских свойств
	 * @return array
	 */
	public static function iBlockPropertyBuildList() {
		return UserTypeNYesNo::GetUserTypeDescription();
	}

	/**
	 * Обработчик события перед удалением элемента, с возможностью отмены удаления
	 * @param $id
	 * @return bool
	 */
	public static function beforeIBlockElementDelete($id)
	{
		global $APPLICATION;
		$iblockId = self::getIblockByElementId($id);
		if ($iblockId == Sanatorium::IBLOCK_ID)
		{
			$APPLICATION->throwException("\nНельзя просто так взять и удалить санаторий");
			return false;
		}
		elseif ($iblockId == Room::IBLOCK_ID)
		{
			$APPLICATION->throwException("\nНельзя просто так взять и удалить номер санатория");
			return false;
		}

		return true;
	}

	/**
	 * Обработчик события перед изменением элемента с возможностью отмены изменений
	 * @param $arFields
	 * @return bool
	 */
	public static function beforeIBlockElementUpdate(&$arFields)
	{

		return true;
	}

	/**
	 * вызывается в выполняемой части пролога сайта (после события OnPageStart)
	 */
	public static function beforeProlog()
	{

	}

	/**
	 * Формируем поисковый контент
	 * @param $arFields
	 * @return mixed
	 */
	public static function beforeSearchIndex($arFields)
	{
		if ($arFields['MODULE_ID'] == 'iblock' && $arFields['PARAM2'] == Sanatorium::IBLOCK_ID)
			$arFields = Sanatorium::beforeSearchIndex($arFields);

		return $arFields;
	}

	/**
	 * Добавление элемента
	 * @param $arFields
	 */
	public static function elementAdd($arFields) {
		if ($arFields['IBLOCK_ID'] == Room::IBLOCK_ID)
			Room::onUpdateRoom($arFields['ID']);
	}

	/**
	 * Обновление элемента
	 * @param $arFields
	 */
	public static function elementUpdate($arFields) {
		// нужно обновить цену санатория (вдруг ее вручную кто-то поменял)
		if ($arFields['IBLOCK_ID'] == Sanatorium::IBLOCK_ID)
			Sanatorium::correctPrice($arFields['ID']);
		elseif ($arFields['IBLOCK_ID'] == Room::IBLOCK_ID)
			Room::onUpdateRoom($arFields['ID']);
	}

	/**
	 * Удаление элемента
	 * @param $id
	 */
	public static function elementDelete($id) {
		$iblockId = self::getIblockByElementId($id);
		// нужно обновить цену санатория, если удалили номер
		if ($iblockId == Room::IBLOCK_ID)
			Room::onDeleteRoom($id);
	}

	/**
	 * Находит ID инфоблока по ID элемента
	 * @param $id
	 * @return string
	 */
	private static function getIblockByElementId($id)
	{
		$iblock = 0;
		$iblockElement = new \CIBlockElement();
		$rsItems = $iblockElement->GetList(array(), array(
			'ID' => $id,
		), false, false, array(
			'IBLOCK_ID',
		));
		if ($item = $rsItems->Fetch())
			$iblock = $item['IBLOCK_ID'];

		return $iblock;
	}

}