<?php
namespace Barstec\Paypal;

use Illuminate\Support\ServiceProvider;

final class PaypalServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom($this->getConfigPath(), 'paypal');
    }

    private function getRoutesPath(): string
    {
        return realpath(__DIR__ . '/../routes/paypal.php');
    }

    private function getConfigPath(): string
    {
        return realpath(__DIR__ . '/../config/paypal.php');
    }

    private function loadRoutes(): void
    {
        if (config('paypal.route_enabled', true)) {
            $path = $this->getRoutesPath();
            $this->loadRoutesFrom($path);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            $this->getConfigPath() => config_path('paypal.php'),
        ], 'config');
        $this->loadRoutes();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}
