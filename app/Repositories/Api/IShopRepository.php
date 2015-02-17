<?php

namespace App\Repositories\Api;

use App\Shop;

interface IShopRepository
{
    public function getPopularShops();

    public function getNewShops();

    public function getAllShops();

    public function getShopById($id);

    //public function getUserShopById($id);

    public function getItemsInShop(Shop $shop);

    public function createOrUpdate($data, Shop $shop=null);

    public function destroy(Shop $shop);
}