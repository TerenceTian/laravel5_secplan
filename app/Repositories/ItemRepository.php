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

    public function createOrUpdate($data, $id = null) {
        if (is_null($id)) {
            return Item::create($data);
        } else {
            $item = Item::findOrFail($id);
            return $item->update($data);
        }
    }

    public function destroy($id) {
        $item = Item::findOrFail($id);

        return $item->delete();
    }

    public function getItemsByShopId($id) {
        $items = Item::where('shop_id', '=', $id)->get();

        return $items;
    }
}