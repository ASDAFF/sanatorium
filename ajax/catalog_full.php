<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

$errors = array();

if(empty($_POST['catalog_full_email']))
    $errors['catalog_full_email'] = 'Укажите e-mail';
$email = trim($_POST['catalog_full_email']);
if(empty($email))
    $errors['catalog_full_email'] = 'Укажите e-mail';
if(!filter_var($email))
    $errors['catalog_full_email'] = 'Неверный формат e-mail';

empty($errors) || exit(json_encode($errors));

//for first run, save file to file table
/*$file = $_SERVER['DOCUMENT_ROOT'] . '/upload/Catalog_2016_(испр2).pdf';
is_file($file) || exit('No such file');
$fileId = CFile::SaveFile(
    array(
        "name" => "Каталог.pdf", // имя файла, как оно будет в письме
        "tmp_name" => $file, // собственно файл
        "old_file" => "0", // ID "старого" файла
        "del" => "N", // удалять прошлый?
        "MODULE_ID" => "", // имя модуля, работает и так
        "description" => "", // описание
    ),
    '',  // относительный путь от upload, где будут храниться файлы
    false,    // ForceMD5
    false     // SkipExt
);*/

$fileId = 6572;

echo json_encode(
    \CEvent::Send('SAN_CATALOG', 's1', array('SEND_TO' => $_POST['catalog_full_email']), 'N', '', array($fileId))
    ? 'Сообщение успешно отправлено'
    : 'Произошла ошибка при отправке сообщения'
);