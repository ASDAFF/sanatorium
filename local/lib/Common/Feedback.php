<?
namespace Local\Common;


/**
 * Class Feedback Форма "задать вопрос"
 * @package Local\Common
 */
class Feedback
{

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 17;

	/**
	 * Добавление вопроса
	 * @return bool|int
	 */
	public static function add()
	{
		$id = 0;

		$name = htmlspecialchars($_POST['name']);
		$text = htmlspecialchars($_POST['text']);
		$phone = htmlspecialchars($_POST['phone']);
		$email = htmlspecialchars($_POST['email']);
		$call = $_POST['call'] ? 1 : 0;
		$mail = $_POST['mail'] ? 1 : 0;

		if ($name && $text)
		{
			$el = new \CIBlockElement();

			$fields = array(
				'IBLOCK_ID' => self::IBLOCK_ID,
				'NAME' => $name,
				'PREVIEW_TEXT' => $text,
				'PROPERTY_VALUES' => array(
					'PHONE' => $phone,
					'EMAIL' => $email,
					'CALL' => $call,
					'MAIL' => $mail,
				),
			);
			$id = $el->Add($fields);
			if ($id)
			{
				$eventFields = array(
					'NAME' => $name,
					'PHONE' => $phone,
					'EMAIL' => $email,
					'CALL' => $call ? 'да' : 'нет',
					'MAIL' => $mail ? 'да' : 'нет',
					'TEXT' => $text,
				);
				\CEvent::Send('FEEDBACK_FORM', 's1', $eventFields);
			}
		}

		return $id;
	}

}

