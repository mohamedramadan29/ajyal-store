<?php

namespace App\Providers;

use App\Repositories\cart\CartModelRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('cart',function(){
            return new CartModelRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
