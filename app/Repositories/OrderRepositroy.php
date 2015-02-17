<?php

namespace App\Repositories;

use App\Order;
use App\Repositories\Api\IOrderRepository;

class OrderRepository implements IOrderRepository {

    public function getOrderById($id) {
        $order = Order::findOrFail($id);

        return $order;
    }

    public function getOrdersByBuyerId($buyer_id) {
        $orders = Order::where('buyer_id', $buyer_id);

        return $orders;
    }

    public function getOrdersByShopId($shop_id) {
        $orders = Order::where('shop_id', $shop_id);

        return $orders;
    }

    public function createOrUpdate($data, $id=null) {
        if ( ! is_null($id)) {
            return Order::create($data);
        } else {
            return $this->getOrderById($id)->update($data);
        }
    }

    public function addItemToOrder($order_id, $item_id) {
        $order = $this->getOrderById($order_id);

        $order->items->attach($item_id);

        return $order->items;
    }

    public function addItemsToOrder($order_id, $items_id_array) {
        $order = $this->getOrderById($order_id);

        return $order->items()->sync($items_id_array);
    }

    public function removeItemFromOrder($order_id, $item_id) {
        $order = $this->getOrderById($order_id);

        return $order->items()->detach($item_id);
    }

    public function destroyOrder($id) {
        $order = $this->getOrderById($id);

        return $order->delete();
    }
}