<?php
namespace App\Repositories;

use App\Repositories\Api\IShopRepository;
use App\Shop;
use Auth;

class ShopRepository implements IShopRepository
{
    public function getPopularShops() {
        $shops = Shop::popular();

        return $shops;
	}

    public function getNewShops() {
        $shops = Shop::recent();

        return $shops;
    }

    public function getAllShops() {
        $shops = Shop::with('user')->get();

        return $shops;
    }

    public function getShopById($id) {
        $shop = Shop::findOrFail($id);

        return $shop;
    }


    public function createOrUpdate($data, Shop $shop=null) {
        if (is_null($shop)) {
            $data['user_id'] = Auth::id();
            return Shop::create($data);
        } else {
            return $shop->update($data);
        }
    }

    public function destroy(Shop $shop) {

        return $shop->delete();
    }

    public function getItemsInShop(Shop $shop) {

        return $shop->items;
    }
}
