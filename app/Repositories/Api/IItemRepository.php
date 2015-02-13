<?php

namespace Repositories\Api;

interface IItemRepository
{
    public function getPopularItems();

    public function getNewItems();

    public function getAllItems();

    public function getItemById($id);

    public function getItemsByShopId($id);

    public function createOrUpdate($data, $id = null);

    public function destroy($id);
}