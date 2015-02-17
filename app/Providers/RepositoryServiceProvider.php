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
        $this->app->bind('App\\Repositories\\Api\\IShopRepository', 'App\\Repositories\\ShopRepository');
        $this->app->bind('App\\Repositories\\Api\\IItemRepository', 'App\\Repositories\\ItemRepository');
        $this->app->bind('App\\Repositories\\Api\\IOrderRepository', 'App\\Repositories\\OrderRepository');
    }
}