<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        
        $keys = ['pusher_app_id', 'pusher_cluster', 'pusher_key', 'pusher_secret'];
        $pusherConf = Setting::whereIn('key', $keys)->pluck('value', 'key');

        config(['broadcasting.connections.pusher.key' => $pusherConf['pusher_key']]);
        config(['broadcasting.connections.pusher.secret' => $pusherConf['pusher_secret']]);
        config(['broadcasting.connections.pusher.app_id' => $pusherConf['pusher_app_id']]);
        config(['broadcasting.connections.pusher.options.cluster' => $pusherConf['pusher_cluster']]);

        /** Share variable at all view */
        View::composer('*', function($view) use ($pusherConf){
            $view->with(['pusherConf' => $pusherConf]);
        });
    }
}
