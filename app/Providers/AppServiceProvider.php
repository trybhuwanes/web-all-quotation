<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Services\LarkBaseService;
use App\Services\LarkSyncService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(LarkBaseService::class, function ($app) {
            return new LarkBaseService();
        });
        
        $this->app->singleton(LarkSyncService::class, function ($app) {
            return new LarkSyncService($app->make(LarkBaseService::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // RUPIAH FORMAT
        Blade::directive('idr', function ($amount) {
            return "<?php echo 'Rp ' . number_format($amount, 0, ',', '.'); ?>";
        });

        // NAVBAR / ACTIVE
        Blade::directive('activeIs', function ($expression) {
            return "<?php echo request()->routeIs({$expression}) ? 'active' : ''; ?>";
        });

        // Define the resourceNames function

        Blade::directive('formatNumberDecimal', function ($value) {
            return "<?php echo rtrim(rtrim(number_format($value, 2), '0'), '.'); ?>";
        });
        
    }
    
}
