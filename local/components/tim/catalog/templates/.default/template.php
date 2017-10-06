<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var Local\Catalog\TimCatalog $component */

if ($component->tabCode == 'photo')
	include ('photo.php');
elseif ($component->room)
	include ('room.php');
elseif ($component->product)
	include ('detail.php');
elseif ($component->arParams['AJAX'])
	include ('ajax.php');
elseif ($arResult['NOT_FOUND'])
	include ('not_found.php');
else
	include ('full.php');
