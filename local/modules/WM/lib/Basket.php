<?php

namespace WM;

\Bitrix\Main\Loader::includeModule('catalog');
\Bitrix\Main\Loader::includeModule('sale');
\Bitrix\Main\Loader::includeModule('iblock');

class Basket
{
    public static function add($productId, $quantity = 1, $getFormattedBasket = true, $toJson = true, $fUserId = null, $siteId = null)
    {
        $result = [];
        $productId = (int) $productId;
        $quantity = (int) $quantity;
        if($quantity < 1)
            $quantity = 1;
        $fUserId = isset($fUserId) ? (int) $fUserId : \Bitrix\Sale\Fuser::getId();
        $siteId = isset($siteId) ? $siteId : \Bitrix\Main\Context::getCurrent()->getSite();

        $basket = \Bitrix\Sale\Basket::loadItemsForFUser($fUserId, $siteId);

        if ($productId < 1){
            return static::getResult([
                'status' => 'error',
                'message' => 'Неизвестный товар',
            ], $toJson);
        }

        $found = false;
        foreach ($basket as $item)
        {
            if((int) $item->getProductId() === $productId) //existing product
            {
                $found = true;
                $item->setField('QUANTITY', $item->getQuantity() + $quantity);
                break;
            }
        }
        if(!$found)
        {
            $item = $basket->createItem('catalog', $productId);
            $item->setFields(array(
                'QUANTITY' => $quantity,
                'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
                'LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
                'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
            ));
        }

        if ($basket->save())
            $result = [
                'status' => 'ok',
                'message' => 'Товар удачно добавлен в корзину',
            ];

        if($getFormattedBasket)
            $result = static::getFormattedBasket($basket, $result);

        return static::getResult($result, $toJson);
    }

    public static function getFormattedBasket(\Bitrix\Sale\Basket $basket, array $result = array())
    {
        $items = array();

        foreach($basket as $item)
            $items[$item->getProductId()] = $item->getQuantity();

        $ret = '';
        $res = \CIBlockElement::GetList(
            array(),
            array('IBLOCK_ID' => 2, 'ACTIVE' => 'Y', 'ID' => array_keys($items)),
            false,
            false,
            array('ID', 'NAME', 'DETAIL_PAGE_URL', 'CATALOG_GROUP_1')
        );
        while($row = $res->GetNext())
        {
            $ret .= '<li class="clearfix"><a href="' . $row['DETAIL_PAGE_URL'] . '" class="cart_item_title">' . $row['NAME'] . '</a>
					<span class="cart_item_price">' . $items[$row['ID']] . ' x ' . SaleFormatCurrency($row['CATALOG_PRICE_1'], $row['CATALOG_CURRENCY_1']) . '</span>
				</li>';
        }
        $result['products'] = $ret;
        $result['total_sum'] = SaleFormatCurrency($basket->getPrice(), 'RUB');
        $result['quantity'] = array_sum($items);
        return $result;
    }

    public static function getResult(array $result = array(), $toJson = true)
    {
        return $toJson ? json_encode($result) : $result;
    }
}