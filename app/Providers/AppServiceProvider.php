<?php

namespace App\Providers;

use App\Http\Integrations\Planfix\PlanfixConnector;
use App\Http\Integrations\Planfix\Requests\GetBitrixAccount;
use App\Http\Integrations\Planfix\Requests\GetSftpAccount;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Saloon\Http\Senders\GuzzleSender;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GuzzleSender::class, fn () => new GuzzleSender);
        $this->app->singleton(PlanfixConnector::class, fn () => new PlanfixConnector);
        $this->app->bind(GetSftpAccount::class, function ($app, $params) {
            return resolve(PlanfixConnector::class)->send(new GetSftpAccount($params[0]));
        });
        $this->app->bind(GetBitrixAccount::class, function ($app, $params) {
            return resolve(PlanfixConnector::class)->send(new GetBitrixAccount($params[0]));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if ($this->app->environment('production')) {
            $this->app['request']->server->set('HTTPS','on');
            \URL::forceScheme('https');
        }
    }
}
