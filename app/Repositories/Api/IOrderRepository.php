<?php

namespace App\Repositories\Api;

interface IOrderRepository
{
    public function getOrderById($id);

    public function getOrdersByBuyerId($buyer_id);

    public function getOrdersByShopId($shop_id);

    public function createOrUpdate($data, $id=null);

    public function addItemToOrder($order_id, $item_id);

    public function addItemsToOrder($order_id, $items_id_array);

    public function removeItemFromOrder($order_id, $item_id);

    public function destroyOrder($id);
}