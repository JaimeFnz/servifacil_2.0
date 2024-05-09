<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiter\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RaceLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '';

    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function(){
            Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
        
            Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
        
            Route::middleware(['web', 'auth'])
            ->prefix('admin')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
        
        });
    }
}