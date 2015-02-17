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


    public function createOrUpdate($data, $shop_id=null) {
        if (is_null($shop_id)) {
            $data['user_id'] = Auth::id();
            return Shop::create($data);
        } else {
            return Shop::findOrFail($shop_id)->update($data);
        }
    }

    public function destroy($id) {

        return Shop::find($id)->delete();
    }

    public function getItemsInShop($id) {
        $itemRepo = new ItemRepository();

        return $itemRepo->getItemsByShopId($id);
    }
}
