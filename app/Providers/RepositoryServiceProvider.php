<?php

namespace App\Providers;

use App\Interfaces\ProductCategoryInterface;
use App\Repositories\MongoDB\ProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\ProductInterface;
use App\Repositories\MongoDB\ProductCategoryRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(ProductCategoryInterface::class, ProductCategoryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
