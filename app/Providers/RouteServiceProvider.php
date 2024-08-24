<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // 加载自定义的 home_routes.php 路由
            Route::middleware('web') // 根据需要设置中间件
            ->group(base_path('routes/home_routes.php'));

            // 加载自定义的 home_routes.php 路由
            Route::middleware('web') // 根据需要设置中间件
            ->group(base_path('routes/msg_routes.php'));

            // 加载自定义的 home_routes.php 路由
            Route::middleware('web') // 根据需要设置中间件
            ->group(base_path('routes/profile_routes.php'));
        });
    }
}
