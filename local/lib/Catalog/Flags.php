<?
namespace Local\Catalog;

/**
 * Class Flags Простые свойства санаториев
 */
class Flags
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Flags/';

	private static $all = array(
		'Для кого' => array(
			'children' => array(
				'CODE' => 'CHILDREN',
				'NAME' => 'Отдых с детьми',
			),
			'child1' => array(
				'CODE' => 'CHILD1',
				'NAME' => 'Дети от 1',
			),
			'child4' => array(
				'CODE' => 'CHILD4',
				'NAME' => 'Дети от 4-х лет',
			),
			'pensioner' => array(
				'CODE' => 'PENSIONER',
				'NAME' => 'Для пенсионеров',
			),
			'old' => array(
				'CODE' => 'OLD',
				'NAME' => 'Для пожилых людей',
			),
			'family' => array(
				'CODE' => 'FAMILY',
				'NAME' => 'Для всей семьи',
			),
			'invalid' => array(
				'CODE' => 'INVALID',
				'NAME' => 'Для людей с инвалидностью',
			),
			'childs' => array(
				'CODE' => 'CHILDREN_SPECIAL',
				'NAME' => 'Детский санаторий',
			),
			'mac' => array(
				'CODE' => 'MOTHER_AND_CHILD',
				'NAME' => 'Для мам и детей',
			),
		),
		'Разное' => array(
			'allinc' => array(
				'CODE' => 'ALL_INCLUSIVE',
				'NAME' => 'Всё включено',
			),
			'wot' => array(
				'CODE' => 'WITHOUT_TREATMENT',
				'NAME' => 'Без лечения',
			),
		),
		'Особое' => array(
			'army' => array(
				'CODE' => 'SPECIAL_ARMY',
				'NAME' => 'Военный санаторий',
			),
			'rzd' => array(
				'CODE' => 'SPECIAL_RZD',
				'NAME' => 'Санаторий РЖД',
			),
			'fsb' => array(
				'CODE' => 'SPECIAL_FSB',
				'NAME' => 'Санаторий ФСБ',
			),
			'mvd' => array(
				'CODE' => 'SPECIAL_MVD',
				'NAME' => 'Санаторий МВД',
			),
			'mo' => array(
				'CODE' => 'SPECIAL_MO',
				'NAME' => 'Санаторий Мин.обороны',
			),
		),
	);

	/**
	 * Возвращает все свойства
	 * @return array
	 */
	public static function getAll()
	{
		return self::$all;
	}

	/**
	 * Возвращает свойства в формате для селекта
	 * @return array
	 */
	public static function getForSelect()
	{
		$return = array();
		foreach (self::$all as $props)
		{
			foreach ($props as $prop)
				$return[] = 'PROPERTY_' . $prop['CODE'];
		}
		return $return;
	}

	/**
	 * Возвращает коды свойств
	 * @return array
	 */
	public static function getCodes()
	{
		$return = array();
		foreach (self::$all as $props)
		{
			foreach ($props as $prop)
				$return[] = $prop['CODE'];
		}
		return $return;
	}
}
