<?php

namespace App\Repositories\Api;

use App\Order;

interface IOrderRepository
{
    public function getOrderById($id);

    public function getOrdersByBuyerId($buyer_id);

    public function getOrdersByShopId($shop_id);

    public function createOrUpdate($data, Order $order=null);

    //public function addItemToOrder($order_id, $item_id);

    public function updateItemsToOrder(Order $order, array $items_id_array);

    //public function removeItemFromOrder($order_id, $item_id);

    public function destroyOrder(Order $order);
}