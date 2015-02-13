<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('Repositories\\Api\\IShopRepository', 'Repositories\\ShopRepository');
        $this->app->bind('Repositories\\Api\\IItemRepository', 'Repositories\\ItemRepository');
    }
}