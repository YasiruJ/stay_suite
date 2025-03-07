<?php

namespace App\Providers;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Model::preventAccessingMissingAttributes();
        // Model::preventSilentlyDiscardingAttributes();

        // Model::preventLazyLoading(! App::environment('production'));

        // DB::whenQueryingForLongerThan(2000, function (Connection $connection, QueryExecuted $event) {
        //     Log::warning("Database queries exceeded 2 seconds on {$connection->getName()}");
        // });

        // if (App::environment('local')) {
        //     DB::listen(function ($query) {
        //         Log::info('sql: ' .  $query->sql);
        //     });
        // }

        Paginator::useBootstrap();
    }
}
