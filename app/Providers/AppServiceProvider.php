<?php

namespace App\Providers;


use App\Http\Response\LoginResponse;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/redirect-after-login'; // ✅ Custom role-based redirect route

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
       
    }

    

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->mapWebRoutes();

        $this->mapApiRoutes();
    }

    /**
     * Define the "web" routes for the application.
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     */
    protected function mapApiRoutes():void
    {
        Route::prefix('api')->middleware('api')->group(base_path('routes/api.php'));
    }
}
