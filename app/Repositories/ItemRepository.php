<?php

namespace App\Repositories;

use App\Item;
use App\Repositories\Api\IItemRepository;

class ItemRepository implements  IItemRepository
{

    public function getPopularItems() {
        $items = Item::popular();

        return $items;
    }

    public function getNewItems() {
        $items = Item::recent();

        return $items;
    }

    public function getAllItems() {
        $items = Item::with('shop.user')->get();

        return $items;
    }

    public function getItemById($id) {
        $item = Item::findOrFail($id);

        return $item;
    }

    public function createOrUpdate($data, Item $item=null) {
        if (is_null($item)) {
            return Item::create($data);
        } else {
            return $item->update($data);
        }
    }

    public function destroy(Item $item) {
        return $item->delete();
    }

    //public function getItemsByShopId($id) {
    //    $items = Item::where('shop_id', '=', $id)->get();
    //
    //    return $items;
    //}
}