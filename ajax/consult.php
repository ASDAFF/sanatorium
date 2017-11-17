<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \WM\Common\Helper,
    \WM\Seo\GTMFormSubmit;

//Is POST data sent ?
empty($_POST) && exit;

//set rules & fields for form
$form = new \WM\Forms\AjaxForm(array(
    array('name', 'required', array('message' => 'Имя обязательно к заполнению')),
    //array('email', 'required', array('message' => 'E-mail обязателен к заполнению')),
    array('phone', 'required', array('message' => 'Телефон обязателен к заполнению')),
    array('query', 'required', array('message' => 'Вопрос обязателен к заполнению')),
    array('call_date', 'required', array('message' => 'Дата заявки обязательна к заполнению')),
    array('call_date', 'regex', array('pattern' => '~^\\d{2}.\\d{2}.\\d{4}$~', 'message' => 'Дата должна быть в формате DD.MM.YYYY')),
    array('call_time', 'required', array('message' => 'Время заявки обязательно к заполнению')),
    array('call_time', 'regex', array('pattern' => '~^\\d{2}:\\d{2}$~', 'message' => 'Время должно быть в формате MM:HH')),
    //array('email', 'email', array('message' => 'Неверный формат E-mail')),
    //array('phone', 'phone', array('message' => 'Телефон должен быть в формате +7 (999) 666-33-11')),
    array('phone', 'regex', array('pattern' => '~^\\d{11,}$~', 'message' => 'Телефон должен состоять только из 11 или более цифр')),
),
    $_POST
);

//check form fields
if($form->validate())
{
    //upload file
    $file = '';
    if(!empty($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name']))
    {
        $fileId = \CFile::SaveFile($_FILES['file']);
        if($fileId)
            $file = \CFile::MakeFileArray($fileId);
    }

    //add record & send email
    $status = $form->formActionFull(
    //iblock id
        32,
        //iblock add params
        array(
            'NAME' => Helper::enc($form->getField('name')),
            'PREVIEW_TEXT' => Helper::enc($form->getField('query')),
            'PROPERTY_VALUES' => array(
                'PHONE' => Helper::enc($form->getField('phone')),
                'EMAIL' => Helper::enc($form->getField('email')),
                'DATETIME' => \CDatabase::FormatDate(Helper::enc($form->getField('call_date') . ' ' . $form->getField('call_time'))),
                'FILE' => $file,
            ),
            'ACTIVE' => 'Y',
        ),
        //email event name
        'CONSULT_FORM',
        //email send params
        array(
            'NAME' => Helper::enc($form->getField('name')),
            'TEXT' => Helper::enc($form->getField('query')),
            'EMAIL' => Helper::enc($form->getField('email')),
            'DATETIME' => Helper::enc($form->getField('email')),
            'PHONE' => Helper::enc($form->getField('phone')),
            'FILE_SRC' => (empty($fileId) ? '-' : Helper::getFullUrl(\CFile::GetPath($fileId))),
        )
    );

    //remove uploaded file if not success
    if(!$status && !empty($fileId))
        \CFile::Delete($fileId);

    echo json_encode($status
        ? array(
            'success' => true,
            'gtmObject' => GTMFormSubmit::get()->setEvent()->setElementClasses('.consult-form')->setElements(array(
                $form->getField('name'), $form->getField('query'), $form->getField('email'), $form->getField('phone'),
            ))->getResult()
        )
        : array(
            'errors' => $form->getErrors()
        )
    );
}
else
    echo json_encode(array('errors' => $form->getErrors()));