<?php

namespace App\Repositories\Api;

use App\Item;

interface IItemRepository
{
    public function getPopularItems();

    public function getNewItems();

    public function getAllItems();

    public function getItemById($id);

    //public function getItemsByShopId($id);

    public function createOrUpdate($data, Item $item=null);

    public function destroy(Item $item);
}