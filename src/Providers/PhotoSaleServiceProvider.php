<?php

namespace ConfrariaWeb\PhotoSale\Providers;

use ConfrariaWeb\PhotoSale\Components\Buttons\Socialite;
use ConfrariaWeb\PhotoSale\Components\Components\TemplateLayout;
use ConfrariaWeb\PhotoSale\Services\CheckoutService;
use ConfrariaWeb\PhotoSale\Services\CreditCardService;
use ConfrariaWeb\PhotoSale\Services\OrderService;
use ConfrariaWeb\PhotoSale\Services\PhotoService;
use ConfrariaWeb\PhotoSale\Traits\ProviderTrait;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class PhotoSaleServiceProvider extends ServiceProvider
{

    use ProviderTrait;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale($this->app->getLocale());

        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../databases/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Views', 'photoSale');
        $this->publishes([__DIR__ . '/../../config/cw_photo_sale.php' => config_path('cw_photo_sale.php')], 'config');
        $this->registerSeedsFrom(__DIR__ . '/../../databases/Seeds');

        Blade::component('buttons-socialite', Socialite::class);
        Blade::component('template-layout', TemplateLayout::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CheckoutService', function () {
            return new CheckoutService();
        });

        $this->app->bind('CreditCardService', function () {
            return new CreditCardService();
        });

        $this->app->bind('OrderService', function () {
            return new OrderService();
        });

        $this->app->bind('PhotoService', function ($app) {
            return new PhotoService();
        });
    }

}
