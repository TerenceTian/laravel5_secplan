<?php

namespace Repositories\Api;

interface IShopRepository
{
    public function getPopularShops();

    public function getNewShops();

    public function getAllShops();

    public function getShopById($id);

    public function getItemsInShop($id);

    public function createOrUpdate($data, $id = null);

    public function destroy($id);
}