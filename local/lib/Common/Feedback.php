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
	 * ID инфоблока
	 */
	const CALL_IBLOCK_ID = 18;

	/**
	 * Добавление вопроса
     * @return string (json encoded)
	 */
	public static function add()
	{
		$id = 0;

		$name = trim(htmlspecialchars($_POST['name']));
		$text = trim(htmlspecialchars($_POST['text']));
		$phone = trim(htmlspecialchars($_POST['phone']));
		$email = trim(htmlspecialchars($_POST['email']));
		$call = $_POST['call'] ? 1 : 0;
		$mail = $_POST['mail'] ? 1 : 0;

        $errors = array();

        //check fields
        if(empty($name))
            $errors[] = 'Введите имя';
        if(empty($phone))
            $errors[] = 'Введите номер телефона';
        if(empty($text))
            $errors[] = 'Введите текст сообщения';

		if (empty($errors))
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
            else
                $errors[] = 'Ошибка добавления заявки. Свяжитесь с администрацией';
		}

        $gtm = new \WM\GTMFormSubmit();

        if(empty($errors))
        {
            //u-an intergration
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL => 'https://api.u-on.ru/259if83aN3CxKdHAA6Ow/request/create.json',
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS =>
                    'source=' . urlencode('Добавление вопроса') .
                    '&u_name=' . urlencode($name) .
                    '&u_email=' . urlencode($email) .
                    '&u_phone=' . urlencode($phone) .
                    '&u_note=' . urlencode($text) .
                    '&note=' . urlencode(($call ? 'Просьба перезвонить' . PHP_EOL : '') . ($mail ? 'Просьба ответить по E-mail' . PHP_EOL : ''))
            ));
            curl_exec($curl);
            curl_close($curl);

            return $gtm->getJson(array(
                'gtmObject' => $gtm->setEvent()->setElementClasses('.feedback-form')->setElements(array($name, $email, $phone, $text))->getResult(),
                'id' => $id,
                'success' => true,
            ));
        }

        return $gtm->getJson(array(
            'errors' => $errors,
            'id' => $id,
            'success' => false,
        ));
	}

	/**
	 * Добавление заявки на обратный звонок
     * @return string (json encoded)
	 */
	public static function addCallBack()
	{
		$id = 0;

		$name = trim(htmlspecialchars($_POST['name']));
		$phone = trim(htmlspecialchars($_POST['phone']));
		$managerId = trim(htmlspecialchars($_POST['manager']));

        $errors = array();

        //check fields
        if(empty($name))
            $errors[] = 'Введите имя';
        if(empty($phone))
            $errors[] = 'Введите номер телефона';

        if (empty($errors))
		{
			$managerName = '';
			if ($managerId)
			{
				$manager = Manager::getById($managerId);
				$managerId = intval($manager['ID']);
				$managerName = $manager['NAME'];
			}

			$el = new \CIBlockElement();

			$fields = array(
				'IBLOCK_ID' => self::CALL_IBLOCK_ID,
				'NAME' => $name,
				'PROPERTY_VALUES' => array(
					'PHONE' => $phone,
					'MANAGER' => $managerId,
				),
			);
			$id = $el->Add($fields);
			if ($id)
			{
				$eventFields = array(
					'NAME' => $name,
					'PHONE' => $phone,
					'MANAGER' => $managerName,
				);
				\CEvent::Send('CALLBACK_FORM', 's1', $eventFields);
			}
            else
                $errors[] = 'Ошибка добавления заявки. Свяжитесь с администрацией';
		}
        $gtm = new \WM\GTMFormSubmit();

        if(empty($errors))
        {
            //u-an intergration
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL => 'https://api.u-on.ru/259if83aN3CxKdHAA6Ow/request/create.json',
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS =>
                    'source=' . urlencode('Заказ звонка') .
                    '&u_name=' . urlencode($name) .
                    '&u_phone=' . urlencode($phone)
            ));
            curl_exec($curl);
            curl_close($curl);

            return $gtm->getJson(array(
                'gtmObject' => $gtm->setEvent()->setElementId('callback-form')->setElements(array($name, $phone))->getResult(),
                'id' => $id,
                'success' => true,
            ));
        }

        return $gtm->getJson(array(
            'errors' => $errors,
            'id' => $id,
            'success' => false,
        ));
	}

}

