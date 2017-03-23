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
		'Инфраструктура' => array(
			'bath' => array(
				'CODE' => 'BATH',
				'NAME' => 'Баня',
			),
			'bar' => array(
				'CODE' => 'BAR',
				'NAME' => 'Бар',
			),
		),
		'Дети' => array(
			'children' => array(
				'CODE' => 'CHILDREN',
				'NAME' => 'Отдых с детьми',
			),
			'child0' => array(
				'CODE' => 'CHILD0',
				'NAME' => 'Дети от 0',
			),
			'child4' => array(
				'CODE' => 'CHILD4',
				'NAME' => 'Дети от 4-х лет',
			),
		),
		'Разное' => array(
			'food' => array(
				'CODE' => 'FOOD',
				'NAME' => 'С питанием',
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
