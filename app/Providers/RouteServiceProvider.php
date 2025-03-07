<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->mapWebRoutes();
            $this->mapWebAdminRoutes();
            $this->mapWebCustomerRoutes();
            $this->mapWebPropertyRoutes();
            $this->mapWebBookingRoutes();
            $this->mapWebPropertyOwnerRoutes();
            $this->mapWebCallCenterRoutes();
            $this->mapWebReferralUserRoutes();

            $this->mapApiChannelManagerRoutes();
        });
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapWebAdminRoutes()
    {
        Route::middleware(['web', 'role:admin'])
            ->prefix('admin')
            ->namespace($this->namespace . '\Server\Admin')
            ->group(base_path('routes/server/admin.php'));
    }

    protected function mapWebCustomerRoutes()
    {
        Route::middleware(['web', 'role:customer'])
            ->prefix('customer')
            ->namespace($this->namespace . '\Server\Customer')
            ->group(base_path('routes/server/customer.php'));
    }

    protected function mapWebPropertyRoutes()
    {
        Route::middleware(['web'])
            ->prefix('properties')
            ->namespace($this->namespace . '\Server\Property')
            ->group(base_path('routes/server/property.php'));
    }

    protected function mapWebBookingRoutes()
    {
        Route::middleware(['web'])
            ->prefix('booking')
            ->namespace($this->namespace . '\Server\Booking')
            ->group(base_path('routes/server/booking.php'));
    }

    protected function mapWebPropertyOwnerRoutes()
    {
        Route::middleware(['web', 'role:property-owner'])
            ->prefix('property-owner')
            ->namespace($this->namespace . '\Server\PropertyOwner')
            ->group(base_path('routes/server/property-owner.php'));
    }

    protected function mapWebCallCenterRoutes()
    {
        Route::middleware(['web', 'role:call-center'])
            ->prefix('call-center')
            ->namespace($this->namespace . '\Server\CallCenter')
            ->group(base_path('routes/server/call-center.php'));
    }

    protected function mapWebReferralUserRoutes()
    {
        Route::middleware(['web', 'role:referral-user'])
            ->prefix('referral-user')
            ->namespace($this->namespace . '\Server\ReferralUser')
            ->group(base_path('routes/server/referral-user.php'));
    }

    protected function mapApiChannelManagerRoutes()
    {
        Route::prefix('api/channel-manager')
            ->middleware('api')
            ->namespace($this->namespace . '\API\ChannelManager')
            ->group(base_path('routes/api/channel-manager.php'));
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
