<?php

namespace App\Repositories\Api;

interface IShopRepository
{
    public function getPopularShops();

    public function getNewShops();

    public function getAllShops();

    public function getShopById($id);

    //public function getUserShopById($id);

    public function getItemsInShop($id);

    public function createOrUpdate($data, $shop_id=null);

    public function destroy($id);
}