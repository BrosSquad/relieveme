<?php

namespace App\Providers;

use App\Repositories\ExpoRepository;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use ExponentPhpSDK\Expo;
use ExponentPhpSDK\ExpoRegistrar;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use NotificationChannels\ExpoPushNotifications\ExpoChannel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->extend(
            ExpoChannel::class,
            function () {
                return new ExpoChannel(
                    new Expo(new ExpoRegistrar(new ExpoRepository())), $this->app->get(Dispatcher::class)
                );
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
