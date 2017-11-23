<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \WM\Common\Helper,
    \WM\Seo\GTMFormSubmit;

//Is POST data sent ?
empty($_POST) && exit;

//set rules & fields for form
$form = new \WM\Forms\AjaxForm(array(
        array('name', 'required', array('message' => 'Имя обязательно к заполнению')),
        array('phone', 'required', array('message' => 'Телефон обязателен к заполнению')),
        array('phone', 'regex', array('pattern' => '~^\\d{11,}$~', 'message' => 'Телефон должен состоять только из 11 или более цифр')),
    ),
    $_POST
);

//check form fields
if($form->validate())
{
    //add record & send email
    $status = $form->formActionFull(
    //iblock id
        33,
        //iblock add params
        array(
            'NAME' => Helper::enc($form->getField('name')),
            'PREVIEW_TEXT' => Helper::enc($form->getField('phone')),
            'ACTIVE' => 'N',
        ),
        //email event name
        'SANATORIUM_FORM',
        //email send params
        array(
            'NAME' => Helper::enc($form->getField('name')),
            'PHONE' => Helper::enc($form->getField('phone')),
        )
    );

    if($status)
    {
        echo json_encode(array(
            'success' => true,
            'gtmObject' => GTMFormSubmit::get()->setEvent()->setElementClasses('.js-sanatorium-form')->setElements(array(
                $form->getField('name'), $form->getField('phone'),
            ))->getResult()
        ));
        //u-an intergration
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => 'https://api.u-on.ru/259if83aN3CxKdHAA6Ow/lead/create.json',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS =>
                'source=' . urlencode('Заявка на отдых') .
                '&u_name=' . urlencode(Helper::enc($form->getField('name'))) .
                '&u_phone=' . urlencode(Helper::enc($form->getField('phone'))) .
                '&note=' . Helper::enc($form->getField('name') . ' - ' . $form->getField('phone'))
        ));
        curl_exec($curl);
        curl_close($curl);
    }
    else
    {
        echo json_encode(array('errors' => $form->getErrors()));
    }
}
else
    echo json_encode(array('errors' => $form->getErrors()));