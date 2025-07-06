<?php
//app\Providers\AppServiceProvider.php
namespace App\Providers;

use App\Http\Middleware\RoleMiddleware;
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
        // Daftarkan alias untuk middleware Role
        $this->app['router']->aliasMiddleware('role', RoleMiddleware::class);
    }
}
