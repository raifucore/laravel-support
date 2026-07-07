<?php

namespace RaifuCore\Support;

use RaifuCore\Support\Services\Layout\Layout;

class RaifuCoreServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Layout::class, static function () {
            return new Layout;
        });
    }

    public function boot(): void
    {
        $this->_loadLang();
        $this->_loadViews();
    }

    private function _loadLang(): void
    {
        $langPath = __DIR__ . '/../resources/lang';

        // Load
        $this->loadTranslationsFrom($langPath, 'raifucore');

        // Publish
        $this->publishes([
            $langPath => resource_path('lang/vendor/raifucore'),
        ], 'lang');
    }

    private function _loadViews(): void
    {
        $viewsPath = __DIR__ . '/../resources/views';

        // Load
        $this->loadViewsFrom($viewsPath, 'raifucore');

        // Publish
        $this->publishes([
            $viewsPath => resource_path('views/vendor/raifucore'),
        ], 'views');
    }
}
