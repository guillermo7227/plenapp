<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
        setlocale(LC_ALL, 'es_CO.UTF-8');
        \Blade::directive('fecha', function ($expression) {
            return "<?php echo strftime('%e de %B', strtotime(\Carbon\Carbon::make($expression))); ?>";
        });

    }
}
