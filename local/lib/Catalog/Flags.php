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
			's-detmi' => array(
				'CODE' => 'CHILDREN',
				'NAME' => 'Отдых с детьми',
			    'PREDL' => 'для отдыха с детьми',
			),
			'ot-1' => array(
				'CODE' => 'CHILD1',
				'NAME' => 'Дети с рождения',
				'PREDL' => 'для отдыха с детьми с рождения',
			),
			'ot-4' => array(
				'CODE' => 'CHILD4',
				'NAME' => 'Дети от 4-х лет',
				'PREDL' => 'для отдыха с детьми от 4-х лет',
			),
			'pensionery' => array(
				'CODE' => 'PENSIONER',
				'NAME' => 'Для пенсионеров',
				'PREDL' => 'для пенсионеров',
			),
			'pozhilye' => array(
				'CODE' => 'OLD',
				'NAME' => 'Для пожилых людей',
				'PREDL' => 'для пожилых людей',
			),
			'vsya-semya' => array(
				'CODE' => 'FAMILY',
				'NAME' => 'Для всей семьи',
				'PREDL' => 'для всей семьи',
			),
			'invalidnost' => array(
				'CODE' => 'INVALID',
				'NAME' => 'Для людей с инвалидностью',
				'PREDL' => 'для людей с инвалидностью',
			),
			'detskie' => array(
				'CODE' => 'CHILDREN_SPECIAL',
				'NAME' => 'Детский санаторий',
				'BASE' => 'Детские санатории',
			),
			'mama-i-ditya' => array(
				'CODE' => 'MOTHER_AND_CHILD',
				'NAME' => 'Для мам и детей',
				'PREDL' => 'для мам и детей',
			),
		),
		'Разное' => array(
			'allinc' => array(
				'CODE' => 'ALL_INCLUSIVE',
				'NAME' => 'Всё включено',
				'PREDL' => '"всё включено"',
			),
			'radon' => array(
				'CODE' => 'RADON',
				'NAME' => 'С радоном',
				'PREDL' => 'с радоном',
			),
			'swedish' => array(
				'CODE' => 'SWEDISH',
				'NAME' => 'Шведский стол',
				'PREDL' => 'с шведским столом',
			),
			'wot' => array(
				'CODE' => 'WITHOUT_TREATMENT',
				'NAME' => 'Без лечения',
				'PREDL' => 'без лечения',
			),
			'rzd' => array(
				'CODE' => 'SPECIAL_RZD',
				'NAME' => 'Санаторий РЖД',
				'BASE' => 'Санатории РЖД',
			),
			'lowprice' => array(
				'CODE' => 'LOW_PRICE',
				'NAME' => 'Дешёвые',
				'BASE' => 'Дешёвые санатории',
			),
		),
		/*'Особое' => array(
			'army' => array(
				'CODE' => 'SPECIAL_ARMY',
				'NAME' => 'Военный санаторий',
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
		),*/
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
